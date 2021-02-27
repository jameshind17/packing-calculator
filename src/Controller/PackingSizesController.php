<?php
declare(strict_types=1);

namespace App\Controller;

class PackingSizesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index(){}

    /**
     * Calculator method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function calculator() {
        if ($this->request->is('ajax')) {
            $this->loadModel('PackingSizes');
            $this->loadComponent('PackingCalculator');

            $qty = (int) $this->request->getData('qty');

            $sizesBelow = $this->PackingSizes->find('belowSizes', ['qty' => $qty]);
            $sizesAbove = $this->PackingSizes->find('aboveSizes', ['qty' => $qty]);

            $packingResults = $this->PackingCalculator->getTotalPacks($sizesAbove, $sizesBelow, $qty);

            $this->set(compact('packingResults'));
        }
    }
}
