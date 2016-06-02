<?php

App::uses('AppController', 'Controller');

class ProController extends AppController {

    public $uses = array('Offer');

    public function index() {
        $offers = $this->Offer->find('all');
        $this->set(compact('offers'));
    }    

}
