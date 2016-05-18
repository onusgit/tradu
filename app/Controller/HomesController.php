<?php

App::uses('AppController', 'Controller');

class HomesController extends AppController {

    public $uses = array('Restaurent', 'Category', 'Menu');

    public function index() {
        $restaurents = $this->Restaurent->find('all', array('limit' => 4, 'order' => 'created DESC'));
        $this->Category->bindModel(array('hasMany' => array('Menu' => array('foriegnKey' => 'category_id'))));
        $this->Restaurent->bindModel(array('hasMany' => array('Category' => array('foriegnKey' => 'restaurent_id'))));
        $popular_restaurents = $this->Restaurent->find('all', array('recursive' => 2, 'limit' => 4, 'order' => 'created DESC'));
        $this->set(compact('restaurents', 'popular_restaurents'));
    }    

}
