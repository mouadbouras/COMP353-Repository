<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Model\Entity\User;
use App\Model\Entity\Student;

/**
 * Students Controller
 *
 * @property \App\Model\Table\StudentsTable $Students
 */
class StudentsController extends AppController
{

    public function isAuthorized($user = null){
        $user = new User($user);
        $action = $this->request->params['action'];
        $pass = $this->request->params['pass'];
        switch ($action) {
            case 'memberSelect':
            case 'setTeam':
                $section = $this->Teams->get($pass[0])->section_id;
                return $user->isInstructor($section) || $user->isAdmin();
                break;
            case 'clearTeam':
                $section = $pass[1];
                return $user->isInstructor($section) || $user->isAdmin();
                break;
        }
        return false;
    }

    public function initialize()
    {
        parent::initialize();
        $this->loadModel('Teams');
    }

    public function memberSelect($team){
        $team = $this->Teams->get($team, [
            'contain' => ['Sections',
                          'Sections.Semesters',
                          'Sections.Courses']
            ]);

        $students = $this->Students->find('all', 
                ['contain' => ['Users']])
            ->where(['team_id IS ' => null, 
                    'section_id' => $team->section->id]);

        $this->set('students', $students);
        $this->set('section', $team->section);
        $this->set('team', $team);
    }

    public function setTeam($team_id, $student_id){
        //put validation
        $team = $this->Teams->get($team_id);

        $student = $this->Students->find('all')
                     ->where(['user_id' => $student_id, 
                             'section_id' => $team->section_id])->first();
        $student->team_id = $team_id;
        $this->Students->save($student);
        return $this->redirect(['controller' => 'Teams', 'action' => 'view', $team_id]);
    }

    public function clearTeam($student_id, $section_id){
        //put validation

        $student = $this->Students->find('all')
                     ->where(['user_id' => $student_id, 
                             'section_id' => $section_id])->first();
        $oldteam = $student->team_id;
        $student->team_id = null;
        $this->Students->save($student);
        return $this->redirect(['controller' => 'Teams',
                                'action' => 'view',
                                $oldteam]);
    }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'Sections', 'Teams']
        ];
        $students = $this->paginate($this->Students);

        $this->set(compact('students'));
        $this->set('_serialize', ['students']);
    }

    /**
     * View method
     *
     * @param string|null $id Student id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $student = $this->Students->get($id, [
            'contain' => ['Users', 'Sections', 'Teams']
        ]);

        $this->set('student', $student);
        $this->set('_serialize', ['student']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $student = $this->Students->newEntity();
        if ($this->request->is('post')) {
            $student = $this->Students->patchEntity($student, $this->request->data);
            if ($this->Students->save($student)) {
                $this->Flash->success(__('The student has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The student could not be saved. Please, try again.'));
            }
        }
        $users = $this->Students->Users->find('list', ['limit' => 200]);
        $sections = $this->Students->Sections->find('list', ['limit' => 200]);
        $teams = $this->Students->Teams->find('list', ['limit' => 200]);
        $this->set(compact('student', 'users', 'sections', 'teams'));
        $this->set('_serialize', ['student']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Student id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $student = $this->Students->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $student = $this->Students->patchEntity($student, $this->request->data);
            if ($this->Students->save($student)) {
                $this->Flash->success(__('The student has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The student could not be saved. Please, try again.'));
            }
        }
        $users = $this->Students->Users->find('list', ['limit' => 200]);
        $sections = $this->Students->Sections->find('list', ['limit' => 200]);
        $teams = $this->Students->Teams->find('list', ['limit' => 200]);
        $this->set(compact('student', 'users', 'sections', 'teams'));
        $this->set('_serialize', ['student']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Student id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $student = $this->Students->get($id);
        if ($this->Students->delete($student)) {
            $this->Flash->success(__('The student has been deleted.'));
        } else {
            $this->Flash->error(__('The student could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
