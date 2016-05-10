<?php

App::uses('AppController', 'Controller');
App::import('Component', 'Image');
App::import('Vendor', 'array_column', array('file' => 'array_column.php'));

class ProductsController extends AppController {

    public $helpers = array('Html', 'Form', 'Js');
    public $components = array('Session', 'RequestHandler');
    public $uses = array('Restaurent', 'Category', 'Menu');

    public function admin_index($restaurent_id = null) {
        if (!empty($restaurent_id)):
            $restaurent = $this->Restaurent->findById($restaurent_id);
            $restaurent_categories = $this->Category->find('all', array('conditions' => array('restaurent_id' => $restaurent_id)));
            $restaurent_products = $this->Menu->find('all', array('conditions' => array('restaurent_id' => $restaurent_id)));
            $this->set(compact('restaurent', 'restaurent_categories', 'restaurent_id', 'restaurent_products'));
        else:
            $this->Session->setFlash('Something Going wrong');
            $this->redirect(array('controller' => 'Restaurents', 'action' => 'admin_index'));
        endif;
    }

    public function admin_add_category($restaurent_id = null) {
        if (!empty($restaurent_id)):
            $restaurent = $this->Restaurent->findById($restaurent_id);
            if ($this->request->is(array('post'))):
                $this->Category->create();
                $success = $this->Category->save($this->request->data);
                if ($success):
                    $this->Session->setFlash('Category Added Successfully');
                    $this->redirect(array('controller' => 'products', 'action' => 'admin_index', $restaurent_id));
                else:
                    $this->Session->setFlash('Category Not Added Successfully');
                    $this->redirect(array('controller' => 'products', 'action' => 'admin_index', $restaurent_id));
                endif;
            endif;
            $this->set(compact('restaurent', 'restaurent_id'));
        else:
            $this->Session->setFlash('Something Going wrong');
            $this->redirect(array('controller' => 'Restaurents', 'action' => 'admin_index'));
        endif;
    }

    public function admin_edit_category($category_id = null, $restaurent_id = null) {
        if (!empty($category_id) && !empty($restaurent_id)):
            $category = $this->Category->findById($category_id);
            if ($this->request->is(array('post', 'put'))):
                $this->Category->id = $category_id;
                $success = $this->Category->save($this->request->data);
                if ($success):
                    $this->Session->setFlash('Category Updated Successfully');
                    $this->redirect(array('controller' => 'products', 'action' => 'admin_index', $restaurent_id));
                else:
                    $this->Session->setFlash('Category Not Updated Successfully');
                    $this->redirect(array('controller' => 'products', 'action' => 'admin_index', $restaurent_id));
                endif;
            else:
                $this->request->data = $category;
            endif;
            $this->set(compact('category', 'restaurent_id'));
        else:
            $this->Session->setFlash('Something Going wrong');
            $this->redirect(array('controller' => 'Restaurents', 'action' => 'admin_index'));
        endif;
    }

    public function admin_delete_category($category_id = null, $restaurent_id = null) {
        if (!empty($category_id) && !empty($restaurent_id)):
            $success = $this->Category->delete($category_id);
            if ($success):
                $this->Session->setFlash('Category Deleted Successfully');
                $this->redirect(array('controller' => 'products', 'action' => 'admin_index', $restaurent_id));
            else:
                $this->Session->setFlash('Category Not Deleted Successfully');
                $this->redirect(array('controller' => 'products', 'action' => 'admin_index', $restaurent_id));
            endif;
            $this->set(compact('category', 'restaurent_id'));
        else:
            $this->Session->setFlash('Something Going wrong');
            $this->redirect(array('controller' => 'Restaurents', 'action' => 'admin_index'));
        endif;
    }

}
