<?php
declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * PackingSizes Controller
 *
 * @property \App\Model\Table\PackingSizesTable $PackingSizes
 * @method \App\Model\Entity\PackingSize[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PackingSizesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $packingSizes = $this->paginate($this->PackingSizes);

        $this->set(compact('packingSizes'));
    }

    /**
     * View method
     *
     * @param string|null $id Packing Size id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $packingSize = $this->PackingSizes->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('packingSize'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $packingSize = $this->PackingSizes->newEmptyEntity();
        if ($this->request->is('post')) {
            $packingSize = $this->PackingSizes->patchEntity($packingSize, $this->request->getData());
            if ($this->PackingSizes->save($packingSize)) {
                $this->Flash->success(__('The packing size has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The packing size could not be saved. Please, try again.'));
        }
        $this->set(compact('packingSize'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Packing Size id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $packingSize = $this->PackingSizes->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $packingSize = $this->PackingSizes->patchEntity($packingSize, $this->request->getData());
            if ($this->PackingSizes->save($packingSize)) {
                $this->Flash->success(__('The packing size has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The packing size could not be saved. Please, try again.'));
        }
        $this->set(compact('packingSize'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Packing Size id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $packingSize = $this->PackingSizes->get($id);
        if ($this->PackingSizes->delete($packingSize)) {
            $this->Flash->success(__('The packing size has been deleted.'));
        } else {
            $this->Flash->error(__('The packing size could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
