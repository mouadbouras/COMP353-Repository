<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Submissions Controller
 *
 * @property \App\Model\Table\SubmissionsTable $Submissions
 */
class SubmissionsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Assignments', 'Teams', 'Files']
        ];
        $submissions = $this->paginate($this->Submissions);

        $this->set(compact('submissions'));
        $this->set('_serialize', ['submissions']);
    }

    /**
     * View method
     *
     * @param string|null $id Submission id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $submission = $this->Submissions->get($id, [
            'contain' => ['Assignments', 'Teams', 'Files']
        ]);

        $this->set('submission', $submission);
        $this->set('_serialize', ['submission']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $submission = $this->Submissions->newEntity();
        if ($this->request->is('post')) {
            $submission = $this->Submissions->patchEntity($submission, $this->request->data);
            if ($this->Submissions->save($submission)) {
                $this->Flash->success(__('The submission has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The submission could not be saved. Please, try again.'));
            }
        }
        $assignments = $this->Submissions->Assignments->find('list', ['limit' => 200]);
        $teams = $this->Submissions->Teams->find('list', ['limit' => 200]);
        $files = $this->Submissions->Files->find('list', ['limit' => 200]);
        $this->set(compact('submission', 'assignments', 'teams', 'files'));
        $this->set('_serialize', ['submission']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Submission id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $submission = $this->Submissions->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $submission = $this->Submissions->patchEntity($submission, $this->request->data);
            if ($this->Submissions->save($submission)) {
                $this->Flash->success(__('The submission has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The submission could not be saved. Please, try again.'));
            }
        }
        $assignments = $this->Submissions->Assignments->find('list', ['limit' => 200]);
        $teams = $this->Submissions->Teams->find('list', ['limit' => 200]);
        $files = $this->Submissions->Files->find('list', ['limit' => 200]);
        $this->set(compact('submission', 'assignments', 'teams', 'files'));
        $this->set('_serialize', ['submission']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Submission id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $submission = $this->Submissions->get($id);
        if ($this->Submissions->delete($submission)) {
            $this->Flash->success(__('The submission has been deleted.'));
        } else {
            $this->Flash->error(__('The submission could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
