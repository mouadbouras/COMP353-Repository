<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\I18n\Time;
use App\Model\Entity\User;
use finfo; 
/**
 * Assignments Controller
 *
 * @property \App\Model\Table\AssignmentsTable $Assignments
 */
class AssignmentsController extends AppController
{
    public function isAuthorized($user = null){
        $user = new User($user);
        $action = $this->request->params['action'];
        $pass = $this->request->params['pass'];
        switch ($action) {
            case 'view': 
            case 'assignment':
            case 'download':
            case 'checkUploadFile':
            case 'saveUploadFile':
                return true;
                break;
            case 'index':
            case 'add':
            case 'edit':
            case 'delete':
                //can see - for section if TA for section
                //can see all - if admin?
                if($pass){
                    return $user->isTA($pass[0]);
                }else{
                    return $user->isAdmin();
                }
                break;
        }
        return false;
    }
   
    public function initialize()
    {
        parent::initialize();
        $this->loadModel('Files');
        $this->loadModel('Submissions');
        $this->loadModel('Sections');
    }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index($sectionid = null)
    {
        //$this->taOnly();
        $this->paginate = [
            'contain' => ['Sections']
        ];
        $assignments = $this->paginate($this->Assignments);
        if($sectionid){
            $assignments = $this->paginate(
                $this->Assignments->find()
                    ->where(['section_id' => $sectionid])
            );
        }

        $this->set(compact('assignments'));
        $this->set('_serialize', ['assignments']);

        $section = $this->Sections->get($sectionid, [
            'contain' => ['Courses', 'Semesters', 'Users', 'Assignments', 'Students', 'Teams']
        ]);
        $this->set('section', $section);
    }

    /**
     * View method
     *
     * @param string|null $id Assignment id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $assignments = $this->Assignments->find('all', [
                'conditions' => ['section_id' => $this->request->session()->read('current_student')['section_id']]
                ]);

        $this->paginate = [
            'contain' => ['Sections']
        ];
        $assignments = $this->paginate( $assignments );

       // print_r(compact('assignments'));

        $this->set(compact('assignments'));
        $this->set('_serialize', ['assignments']);
    }


    public function assignment($id = null, $file = null)
    {
        $session = $this->request->session();
        if($id != null)
        {
            $file = $this->Files->newEntity();
            $submission = $this->Submissions->newEntity();

            if ($this->request->is('post'))
            {

                //file submission form post action.
                if($this->checkUploadFile($this->request->data['submission_file'])){
                    
                    $file->name = $this->request->data['name'] ;
                    $file->version_number = $this->request->data['version_number'] . " " ;
                    $file->user_id =$session->read('current_student')['user_id'];
                    $file->upload_date = Time::now();

                    if ($this->Files->save($file)) {

                        $submission->assignment_id = $id;
                        $submission->team_id = $session->read('current_student')['team_id'];
                        $submission->file_id = $file->id;



                        if ($this->Submissions->save($submission)) {     

                            $file_name = time() . $session->read('current_student')['user_id'] . $session->id();
                            //moving uploaded file.
                            $ext = $this->saveUploadFile($this->request->data['submission_file'], $file_name); 
                            //updating filename
                            $file->file_name = $file_name . "." . $ext;
                            
                            $this->Files->save($file);             
                            $this->Flash->success(__('Your Submission has been saved.'));
                        }
                        else
                        {
                           $this->Flash->error(__('The Submission could not be saved. Please, try again.')); 
                            return $this->redirect(['action' => 'assignment', $id ]);

                        }
                        $this->Flash->success(__('Your File has been saved.'));
                        return $this->redirect(['action' => 'assignment', $id ]);
                    } else {
                        $this->Flash->error(__('The File could not be saved. Please, try again.'));
                    }
                }


            }
             $assignment = $this->Assignments->get($id, [
                'contain' => []
             ]);


             $submissions = $this->Submissions->find('all', [
                'conditions' => [
                                    'assignment_id' => $id ,
                                    'team_id' => $session->read('current_student')['team_id'] ,
                                ],
                'contain' => ['Files']
                ]);

             //print_r(compact('submissions'));
             $files = $this->Assignments->Submissions->find('list', ['limit' => 200]);
         
            $this->set(compact('assignment'));
            $this->set('_serialize', ['assignment']);
            
            $this->set(compact('submissions' , 'files'));
            $this->set('_serialize', ['submissions']);

            $this->set(compact('file'));
            $this->set('_serialize', ['user']);

        }

    }


    public function download($fileName,$submissionName) {
        $path = WWW_ROOT . '/file_uploads//' . $fileName;
        $this->response->file($path, array(
            'download' => true,
            'name' => $submissionName,
        ));
        return $this->response;
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        //$this->taOnly();
        $assignment = $this->Assignments->newEntity();
        if ($this->request->is('post')) {
            $assignment = $this->Assignments->patchEntity($assignment, $this->request->data);
            if ($this->Assignments->save($assignment)) {
                $this->Flash->success(__('The assignment has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The assignment could not be saved. Please, try again.'));
            }
        }
        $sections = $this->Assignments->Sections->find('list', ['limit' => 200]);
        $this->set(compact('assignment', 'sections'));
        $this->set('_serialize', ['assignment']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Assignment id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        //$this->taOnly();
        $assignment = $this->Assignments->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $assignment = $this->Assignments->patchEntity($assignment, $this->request->data);
            if ($this->Assignments->save($assignment)) {
                $this->Flash->success(__('The assignment has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The assignment could not be saved. Please, try again.'));
            }
        }
        $sections = $this->Assignments->Sections->find('list', ['limit' => 200]);
        $this->set(compact('assignment', 'sections'));
        $this->set('_serialize', ['assignment']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Assignment id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        //$this->taOnly();
        $this->request->allowMethod(['post', 'delete']);
        $assignment = $this->Assignments->get($id);
        if ($this->Assignments->delete($assignment)) {
            $this->Flash->success(__('The assignment has been deleted.'));
        } else {
            $this->Flash->error(__('The assignment could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }


    public function checkUploadFile($file){
        
            // Undefined | Multiple Files | $_FILES Corruption Attack
            // If this request falls under any of them, treat it invalid.
            if (
                !isset($file['error']) ||
                is_array($file['error'])
            ) {
                $this->Flash->error(__('Invalid parameters.')); 
                return false;
            }

            // Check $_FILES['upfile']['error'] value.
            switch ($file['error']) {
                case UPLOAD_ERR_OK:
                    break;
                case UPLOAD_ERR_NO_FILE:
                    $this->Flash->error(__('No file selected.')); 
                    return false;
                case UPLOAD_ERR_INI_SIZE:
                case UPLOAD_ERR_FORM_SIZE:
                    $this->Flash->error(__('File is too big.')); 
                    return false;
                default:
                    $this->Flash->error(__('Unknown errors.')); 
                    return false;
            }

            // You should also check filesize here. 
            if ($file['size'] > 500000000) {
                $this->Flash->error(__('File is too big.' )); 
                return false;
            }

            // DO NOT TRUST $_FILES['upfile']['mime'] VALUE !!
            // Check MIME Type by yourself.

            $finfo = new finfo(FILEINFO_MIME_TYPE);
            if (false === $ext = array_search(
                $finfo->file($file['tmp_name']),
                array(
                    'pdf' => 'application/pdf',
                    'doc' => 'application/msword',
                    'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                ),
                true
            )) {
                $this->Flash->error(__('Invalid file format.')); 
                return false;
            }

            return true;
    }

    public function saveUploadFile($file, $file_name){


            $finfo = new finfo(FILEINFO_MIME_TYPE);
            $ext = array_search($finfo->file($file['tmp_name']),
                array(
                    'pdf' => 'application/pdf',
                    'doc' => 'application/msword',
                    'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                ),
                true
            );

            // You should name it uniquely.
            // DO NOT USE $_FILES['upfile']['name'] WITHOUT ANY VALIDATION !!
            // On this example, obtain safe unique name from its binary data.
            if (!move_uploaded_file(
                $file['tmp_name'],
                sprintf(WWW_ROOT . '/file_uploads/%s.%s',
                    $file_name,
                    $ext
                )
            )) {
                $this->Flash->error(__('Failed to move uploaded file.')); 
                return false;
            }

            return $ext;
    }

    public function taOnly(){
        if (!(new User($this->Auth->user()))->isTa()) {
            $this->redirect(['action' => 'view']);
        }
        return;
    }

}
