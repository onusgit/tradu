<?php

App::uses('AppController', 'Controller');

class RestaurentsController extends AppController {

    public $uses = array('Restaurent', 'Menu', 'Country');

    public function admin_index() {
        $restaurents = $this->Restaurent->find('all');
        $this->set(compact('restaurents'));
    }

    public function admin_add() {
        $countries = $this->Country->find('all');
        $this->set(compact('countries'));
        if ($this->request->is('post')):
            if (!empty($this->request->data)):
                $this->Store->save($this->request->data['Restaurent']);
            endif;
        endif;
    }

    public function index() {
        
    }

}
