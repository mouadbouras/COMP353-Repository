<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use App\Model\Entity\User;

/**
 * Sections Controller
 *
 * @property \App\Model\Table\SectionsTable $Sections
 */
class SectionsController extends AppController
{
    public function isAuthorized(){
        //index
        //view
        //add
        //edit
        //delete
        return true;
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
        $user = new User($this->Auth->user());

        if($id && ($user->isStudent($id) || $user->isTA($id) || $user->isAdmin())){
            $section = $this->Sections->get($id, [
                'contain' => ['Courses', 'Semesters', 'Users', 'Assignments', 'Students', 'Teams']
            ]);

            $this->set('section', $section);
            $this->set('_serialize', ['section']);
        }else{
            return $this->redirect(['action' => 'index']);
        }
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
