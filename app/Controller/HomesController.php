<?php

App::uses('AppController', 'Controller');

class HomesController extends AppController {

    public $uses = array('Restaurent', 'Category', 'Menu', 'RestaurentType', 'Setting');

    public function index() {
        $restaurents = $this->Restaurent->find('all', array('limit' => 4, 'order' => 'created DESC'));
        $this->Category->bindModel(array('hasMany' => array('Menu' => array('foriegnKey' => 'category_id'))));
        $this->Restaurent->bindModel(array('hasMany' => array('Category' => array('foriegnKey' => 'restaurent_id'))));
        $popular_restaurents = $this->Restaurent->find('all', array('recursive' => 2, 'limit' => 4, 'order' => 'created DESC'));
        $restaurent_types = $this->RestaurentType->find('all', array('fields' => array( 'id', 'name' )));
        $main_image = $this->Setting->find('first', array('conditions' => array('key_name' => 'main_image')));
        $featured_image = $this->Setting->find('first', array('conditions' => array('key_name' => 'featured_image')));
        $this->set(compact('restaurents', 'popular_restaurents', 'restaurent_types', 'main_image', 'featured_image'));
    }    

}
