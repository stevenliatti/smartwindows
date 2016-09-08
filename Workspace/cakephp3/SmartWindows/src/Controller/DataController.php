<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Data Controller
 *
 * @property \App\Model\Table\DataTable $Data
 */
class DataController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $data = $this->paginate($this->Data);

        $this->set(compact('data'));
        $this->set('_serialize', ['data']);
    }

    /**
     * View method
     *
     * @param string|null $id Data id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $data = $this->Data->get($id, [
            'contain' => []
        ]);

        $this->set('data', $data);
        $this->set('_serialize', ['data']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $data = $this->Data->newEntity();
        if ($this->request->is('post')) {
            $data = $this->Data->patchEntity($data, $this->request->data);
            if ($this->Data->save($data)) {
                $this->Flash->success(__('The data has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The data could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('data'));
        $this->set('_serialize', ['data']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Data id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $data = $this->Data->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->Data->patchEntity($data, $this->request->data);
            if ($this->Data->save($data)) {
                $this->Flash->success(__('The data has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The data could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('data'));
        $this->set('_serialize', ['data']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Data id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $data = $this->Data->get($id);
        if ($this->Data->delete($data)) {
            $this->Flash->success(__('The data has been deleted.'));
        } else {
            $this->Flash->error(__('The data could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
