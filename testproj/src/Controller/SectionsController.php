<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use App\Model\Entity\User;
use App\Model\Entity\ArchiveFile;
use App\Model\Entity\ArchiveSubmission;
use ZipArchive;

/**
 * Sections Controller
 *
 * @property \App\Model\Table\SectionsTable $Sections
 */
class SectionsController extends AppController
{
    public function isAuthorized($user = null){
        $user = new User($user);
        $action = $this->request->params['action'];
        $pass = $this->request->params['pass'];
        switch ($action) {
            case 'index':
            case 'add':
            case 'edit':
            case 'delete':
            case 'archiveFiles':
                return $user->isAdmin();
                break;
            case 'view':
                $section = $pass[0];
                return ($user->isStudent($section) || 
                        $user->isTA($section) ||
                        $user->isInstructor($section) ||
                        $user->isAdmin());
                break;
        }
    }

    public function initialize()
    {
        parent::initialize();
        $this->loadModel('Users');
        $this->loadModel('Assignments'); 
        $this->loadModel('Submissions'); 
        $this->loadModel('Courses');
        $this->loadModel('Sections');
        $this->loadModel('Students');
        $this->loadModel('Teams');
    }

    public function archiveFiles($id){
        $section = $this->Sections->get($id, 
            ['contain' => 
                ['Assignments', 
                'Assignments.Submissions', 
                'Assignments.Submissions.Files', 
                'Assignments.Submissions.Teams']]);

        //path to file uploads
        $filespath = WWW_ROOT.'file_uploads\\';

        //initialize zip file
        ob_flush();
        ob_end_flush();
        $zip = new ZipArchive();
        $tmp_file = tempnam(TMP,'');
        $zip->open($tmp_file, ZipArchive::CREATE);

        //empty zips are invalid
        if(empty($section->assignments)){
            $zip->addFromString('/no submissions','');
        }
        foreach ($section->assignments as $asg) {
            if(empty($asg->submissions)){
                $zip->addFromString($asg->name.'/no submissions','');
            }
            //add all files to zip
            foreach($asg->submissions as $submission){
                $filePath = $filespath.$submission->file->file_name;
                $zipPath = $asg->name.'/Team '.$submission->team->id.'/'.$submission->file->name.'.'.pathinfo($filePath, PATHINFO_EXTENSION);

                $download_file = file_get_contents($filePath);
                $zip->addFromString($zipPath,$download_file);
            }
        }
        $zip->close();

        header('Content-disposition: attachment; filename=section '.$section->id.'.zip');
        header('Content-type: application/zip');
        readfile($tmp_file);
    }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Courses', 'Semesters', 'Users']
        ];
        $sections = $this->paginate($this->Sections);

        $this->set(compact('sections'));
        $this->set('_serialize', ['sections']);
    }

    /**
     * View method
     *
     * @param string|null $id Section id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {   
        $section = $this->Sections->get($id, [
            'contain' => ['Courses', 'Semesters','Assignments']
        ]);
        
        $this->set(compact('section', 'courses', 'Semesters', 'Assignments'));
        $this->set('_serialize', ['section']);

        $student = $this->Students->find('all', [
                'conditions' => ['user_id' => $this->Auth->user('id'),'section_id' => $id],
                'contain' => ['Users', 'Sections']
        ])->first();


        $members = null;
        if($student!= null && $student->team_id != null){
            $members = $this->Students->find('all', [
                    'conditions' => ['team_id' => $student->team_id,
                                     'Sections.id' => $id
                                        ],
                    'contain' => ['Users', 'Sections','Teams']
            ]);
            //adding teaminfo to student
            $student = $this->Students->find('all', [
                    'conditions' => ['user_id' => $this->Auth->user('id'), 'Sections.id' => $id],
                    'contain' => ['Users', 'Sections', 'Teams']
            ])->first();
        }

        $this->set(compact('members', 'users', 'sections', 'teams'));
        $this->set('_serialize', ['members']);
        

        $this->set(compact('student', 'sections'));
        $this->set('_serialize', ['student']);        // print_r($section->Courses);

        // $sections = $this->Sections->find('all', [
        //     'conditions' => [
        //                         'sections.id' => $id 
        //                     ],
        //     'contain' => ['Courses']
        //     ])->first();

        // $this->set(compact('sections' , 'courses'));
        // $this->set('_serialize', ['sections']);
        // print_r($sections->course->name);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $section = $this->Sections->newEntity();
        if ($this->request->is('post')) {
            $section = $this->Sections->patchEntity($section, $this->request->data);
            if ($this->Sections->save($section)) {
                $this->Flash->success(__('The section has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The section could not be saved. Please, try again.'));
            }
        }
        $courses = $this->Sections->Courses->find('list', ['limit' => 200]);
        $semesters = $this->Sections->Semesters->find('list', ['limit' => 200]);
        $users = $this->Sections->Users->find('list', ['limit' => 200]);
        $this->set(compact('section', 'courses', 'semesters', 'users'));
        $this->set('_serialize', ['section']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Section id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $section = $this->Sections->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $section = $this->Sections->patchEntity($section, $this->request->data);
            if ($this->Sections->save($section)) {
                $this->Flash->success(__('The section has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The section could not be saved. Please, try again.'));
            }
        }
        $courses = $this->Sections->Courses->find('list', ['limit' => 200]);
        $semesters = $this->Sections->Semesters->find('list', ['limit' => 200]);
        $users = $this->Sections->Users->find('list', ['limit' => 200]);
        $this->set(compact('section', 'courses', 'semesters', 'users'));
        $this->set('_serialize', ['section']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Section id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $section = $this->Sections->get($id);
        if ($this->Sections->delete($section)) {
            $this->Flash->success(__('The section has been deleted.'));
        } else {
            $this->Flash->error(__('The section could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
