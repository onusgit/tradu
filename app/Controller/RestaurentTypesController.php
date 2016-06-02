<?php

App::uses('AppController', 'Controller');

class RestaurentTypesController extends AppController {

    public $uses = array('RestaurentType');

    public function admin_index() {
        $restaurent_types = $this->RestaurentType->find('all');
        $this->set(compact('restaurent_types'));
    }

    public function admin_add() {
        if ($this->request->is(array('post'))):
            $this->RestaurentType->set($this->request->data);
            $success = $this->RestaurentType->save();
            if ($success):
                $this->Session->setFlash('Restaurent Type Added Successfully');
                $this->redirect(Router::url(array('controller' => 'restaurent_types', 'action' => 'index')));
            else:
                $this->Session->setFlash('Restaurent Type Not Added Successfully');
                $this->redirect(Router::url(array('controller' => 'restaurent_types', 'action' => 'index')));
            endif;
        endif;
    }

    public function admin_edit($type_id = null) {
        if (!empty($type_id)):
            if ($this->request->is(array('post', 'put'))):
                $this->RestaurentType->set($this->request->data);
                $success = $this->RestaurentType->save();
                if ($success):
                    $this->Session->setFlash('Restaurent Type Updated Successfully');
                    $this->redirect(Router::url(array('controller' => 'restaurent_types', 'action' => 'index')));
                else:
                    $this->Session->setFlash('Restaurent Type Not Updated Successfully');
                    $this->redirect(Router::url(array('controller' => 'restaurent_types', 'action' => 'index')));
                endif;
            else:
                $restaurent_type = $this->RestaurentType->findById($type_id);
                $this->request->data = $restaurent_type;
                $this->set(compact('restaurent_type'));
            endif;
        else:
            $this->Session->setFlash('Something Went Wrong');
            $this->redirect(Router::url(array('controller' => 'restaurent_types', 'action' => 'index')));
        endif;
    }

    public function admin_delete($type_id = null) {
        if (!empty($type_id)):
            $success = $this->RestaurentType->delete($type_id);
            if ($success):
                $this->Session->setFlash('Restaurent Type Deleted Successfully');
                $this->redirect(Router::url(array('controller' => 'restaurent_types', 'action' => 'index')));
            else:
                $this->Session->setFlash('Restaurent Type Not Deleted Successfully');
                $this->redirect(Router::url(array('controller' => 'restaurent_types', 'action' => 'index')));
            endif;
        else:
            $this->Session->setFlash('Something Went Wrong');
            $this->redirect(Router::url(array('controller' => 'restaurent_types', 'action' => 'index')));
        endif;
    }

}
