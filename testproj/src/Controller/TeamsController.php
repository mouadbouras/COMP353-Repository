<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Model\Entity\User;
use Cake\I18n\Time;

/**
 * Teams Controller
 *
 * @property \App\Model\Table\TeamsTable $Teams
 */
class TeamsController extends AppController
{
    public function isAuthorized($user = null){
        $user = new User($user);
        $action = $this->request->params['action'];
        $pass = $this->request->params['pass'];
        switch ($action) {
            case 'add':
            case 'delete':
            case 'edit':
                return ($user->isInstructor($pass[0]) || $user->isAdmin());
                break;
            case 'index':
                if(!$user->isAdmin() && ($group = $user->getGroup($pass[0]))){
                    return $this->redirect(['action' => 'view', $group->id]);
                }
                return $user->isInstructor($pass[0]) || 
                        $user->isAdmin() ;
            case 'view':
                if($this->Teams->exists(
                        ['id' => $pass[0]])){
                    $section = $this->Teams->get($pass[0])->section_id;
                    return 
                        $user->getGroup($section) == $pass[0] || 
                        $user->isTA($section) || 
                        $user->isInstructor($section) || 
                        $user->isAdmin();
                }
                break;
        }
        return false;
    }

    public function initialize()
    {
        parent::initialize();
        $this->loadModel('Students');
        $this->loadModel('Users');
        $this->loadModel('Sections');
        $this->loadModel('Submissions');
        $this->loadModel('Files');

    }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index($id = null)
    {
        $teams = $this->Teams->find('all',
                    ['contain' => ['Users', 'Sections']])
                    ->where(['section_id' => $id]);
        $this->set(compact('teams'));
        $this->set('_serialize', ['teams']);

        $section = $this->Sections->get($id, [
                'contain' => ['Courses', 'Semesters', 'Users', 'Assignments', 'Students', 'Teams']
            ]);
        $this->set('section', $section);
        $this->set('_serialize', ['section']);

        $user = new User($this->Auth->user());
        $this->set('editable', $user->isInstructor($id) || $user->isAdmin());

        $semesterEnd = $section->semester->end_date;
        if($semesterEnd  <= Time::now()->subHours(4)){
            $this->set('canArchive', 1);
        }else{
            $this->set('canArchive', 0);
        } 
    }

    /**
     * View method
     *
     * @param string|null $id Team id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = new User($this->Auth->user());

        $team = $this->Teams->get($id, 
            ['contain' => 
                ['Sections', 
                'Sections.Semesters', 
                'Sections.Courses']]);
        $this->set('team', $team);
        $this->set('_serialize', ['team']);

        $students = $this->Students->find('all', [
                'conditions' => ['team_id' => $team->id , 
                                 'section_id' => $team->section_id]
                ,'contain' => ['Users']
                ]);
        $this->set(compact('students' , 'users'));
        $this->set('_serialize', ['students']);

        $section = $team->section;
        $this->set('section', $section);
        $this->set('_serialize', ['section']);
    
        $totalTeamSubmissions = $this->Submissions->find('all', [
        'conditions' => [
                            'team_id' => $id 
                        ]
        ])-> count();
        $this->set('totalTeamSubmissions', $totalTeamSubmissions);


        $contributions = array();

        foreach($students as $r)
        {
            $count = $this->Submissions->find('all', [
                'conditions' => [
                                    'user_id' => $r->user_id ,
                                    'team_id' => $id 
                                ],
                'contain' => ['Files'],
                ])->count();
            $contributions[$r->user_id] = $count ;
        }
        
        $this->set('contributions', $contributions);

        $canEdit = $user->isInstructor($team->section_id) || $user->isAdmin();
        $this->set('canEdit', $canEdit);

        $isInGroup = $user->getGroup($team->section_id) == $id;
        $this->set('isInGroup', $isInGroup);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add($sectionid=null)
    {
        if($sectionid!=null)
        {
            $team = $this->Teams->newEntity();
            if ($this->request->is('post')) {
                $team->section_id = $sectionid;
                $team->leader_user_id = null;
                $team = $this->Teams->patchEntity($team, $this->request->data);
                if ($this->Teams->save($team)) {
                    $this->Flash->success(__('The team has been saved.'));

                    return $this->redirect(['action' => 'index' , $sectionid]);
                } else {
                    $this->Flash->error(__('The team could not be saved. Please, try again.'));
                }
            }
            
            $section = $this->Sections->get($sectionid, [
            'contain' => ['Courses', 'Semesters', 'Users', 'Assignments', 'Students', 'Teams']
            ]);
            $this->set('section', $section);
            $this->set(compact('team', 'users', 'section'));
            $this->set('_serialize', ['team']);
        
            $this->set(compact('students'));
        }

    }

    /**
     * Edit method
     *
     * @param string|null $id Team id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $team = $this->Teams->get($id, [
            'contain' => ['Sections',
                          'Sections.Courses',
                          'Sections.Semesters']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $team = $this->Teams->patchEntity($team, $this->request->data);
            if ($this->Teams->save($team)) {
                $this->Flash->success(__('The team has been saved.'));

                return $this->redirect(['action' => 'view', $id]);
            } else {
                $this->Flash->error(__('The team could not be saved. Please, try again.'));
            }
        }
        
        $users = $this->Students->find('list', 
                ['limit' => 200, 
                'keyField' => 'user_id', 
                'valueField' => 'user_id'])
            ->where(['team_id' => $id]);

        $sections = $this->Teams->Sections->find('list', ['limit' => 200]);

        $this->set(compact('team', 'users', 'sections'));
        $this->set('_serialize', ['team']);

        $this->set('section', $team->section);
    }

    /**
     * Delete method
     *
     * @param string|null $id Team id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $team = $this->Teams->get($id);
        if ($this->Teams->delete($team)) {
            $this->Flash->success(__('The team has been deleted.'));
        } else {
            $this->Flash->error(__('The team could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
