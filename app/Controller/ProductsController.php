<?php

App::uses('AppController', 'Controller');
App::import('Component', 'Image');
App::import('Vendor', 'array_column', array('file' => 'array_column.php'));

class ProductsController extends AppController {

    public $helpers = array('Html', 'Form', 'Js');
    public $components = array('Session', 'RequestHandler');
    public $uses = array('Restaurent', 'Category', 'Menu', 'Language', 'MenuLanguage', 'CategoryLanguage');

    public function admin_index($restaurent_id = null) {
        if (!empty($restaurent_id)):
            $restaurent = $this->Restaurent->findById($restaurent_id);
            $restaurent_categories = $this->Category->find('all', array('conditions' => array('restaurent_id' => $restaurent_id)));
            $this->Menu->bindModel(array('belongsTo' => array('Category' => array('recursive' => 2, 'foreignKey' => 'category_id'))));
            $restaurent_products = $this->Menu->find('all', array('conditions' => array('Menu.restaurent_id' => $restaurent_id)));
            $this->set(compact('restaurent', 'restaurent_categories', 'restaurent_id', 'restaurent_products'));
        else:
            $this->Session->setFlash('Something Going wrong');
            $this->redirect(array('controller' => 'Restaurents', 'action' => 'admin_index'));
        endif;
    }

    public function admin_add_category($restaurent_id = null) {
        if (!empty($restaurent_id)):
            $restaurent = $this->Restaurent->findById($restaurent_id);
            $restaurent_languages = explode(',', $restaurent['Restaurent']['restaurent_languages']);
            $category_languages = $this->Language->find('all', array( 'conditions' => array( 'id' => $restaurent_languages )));
            if ($this->request->is(array('post'))):
                $this->Category->create();
                $success = $this->Category->save($this->request->data);
                if ($success):
                    foreach ($this->data['category_name'] as $k => $v):
                        $category['CategoryLanguage']['category_id'] = $this->Category->id;
                        $category['CategoryLanguage']['language_id'] = $k;
                        $category['CategoryLanguage']['restaurent_id'] = $restaurent_id;
                        $category['CategoryLanguage']['name'] = $v;
                        $this->CategoryLanguage->create();
                        $this->CategoryLanguage->set($category);
                        $this->CategoryLanguage->save($category);
                    endforeach;
                    
                    $this->Session->setFlash('Category Added Successfully');
                    $this->redirect(array('controller' => 'products', 'action' => 'admin_index', $restaurent_id));
                else:
                    $this->Session->setFlash('Category Not Added Successfully');
                    $this->redirect(array('controller' => 'products', 'action' => 'admin_index', $restaurent_id));
                endif;
            endif;
            $this->set(compact('restaurent', 'restaurent_id', 'category_languages'));
        else:
            $this->Session->setFlash('Something Going wrong');
            $this->redirect(array('controller' => 'Restaurents', 'action' => 'admin_index'));
        endif;
    }

    public function admin_edit_category($category_id = null, $restaurent_id = null) {
        if (!empty($category_id) && !empty($restaurent_id)):
            $category = $this->Category->findById($category_id);
            $restaurent = $this->Restaurent->findById($restaurent_id);
            $restaurent_languages = explode(',', $restaurent['Restaurent']['restaurent_languages']);
            
            $this->Language->bindModel(array('hasOne' => array('CategoryLanguage' => array('recursive' => 2, 'foreignKey' => 'language_id', 'conditions' => array('CategoryLanguage.category_id' => $category_id)))));
            $category_languages = $this->Language->find('all', array( 'conditions' => array( 'Language.id' => $restaurent_languages )));
            if ($this->request->is(array('post', 'put'))):
                $this->Category->id = $category_id;
                $success = $this->Category->save($this->request->data);
                if ($success):
                    
                    foreach ($this->data['category_name'] as $k => $v):
                        $category = array();
                        $exist_menu = $this->CategoryLanguage->find('first', array( 'conditions' => array( 'category_id' => $category_id, 'language_id' => $k )));
                        if(!empty($exist_menu)):
                            $category['CategoryLanguage']['language_id'] = $k;
                            $category['CategoryLanguage']['name'] = $v;
                            $category['CategoryLanguage']['restaurent_id'] = $restaurent_id;
                            $this->CategoryLanguage->id = $exist_menu['CategoryLanguage']['id'];
                            $this->CategoryLanguage->set($category);
                            $this->CategoryLanguage->save($category);
                        else:
                            $category['CategoryLanguage']['language_id'] = $k;
                            $category['CategoryLanguage']['name'] = $v;
                            $category['CategoryLanguage']['restaurent_id'] = $restaurent_id;
                            $category['CategoryLanguage']['category_id'] = $category_id;
                            $this->CategoryLanguage->create();
                            $this->CategoryLanguage->set($category);
                            $this->CategoryLanguage->save($category);
                        endif;                        
                    endforeach;
                    
                    $this->Session->setFlash('Category Updated Successfully');
                    $this->redirect(array('controller' => 'products', 'action' => 'admin_index', $restaurent_id));
                else:
                    $this->Session->setFlash('Category Not Updated Successfully');
                    $this->redirect(array('controller' => 'products', 'action' => 'admin_index', $restaurent_id));
                endif;
            else:
                $this->request->data = $category;
            endif;
            $this->set(compact('category', 'restaurent_id', 'restaurent', 'category_languages'));
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

    public function admin_add_product($restaurent_id = null) {
        $userid = $this->Session->read('UserAuth.User.id');
        $user_temp_info = $this->Session->read('UserAuth.User');
        if (!empty($restaurent_id)) :
            $restaurent_categories = $this->Category->find('list', array('fields' => 'id, name', 'conditions' => array('restaurent_id' => $restaurent_id)));
            
            $restaurent_data = $this->Restaurent->findById($restaurent_id);
            $restaurent_languages = explode(',', $restaurent_data['Restaurent']['restaurent_languages']);
            $menu_languages = $this->Language->find('all', array( 'conditions' => array( 'id' => $restaurent_languages )));
            $this->set(compact('restaurent_categories', 'restaurent_id', 'menu_languages'));

            if ($this->request->is('post')) :
                $this->Menu->set($this->data['Menu']);
                $success = $this->Menu->save();

                if ($success):
                    foreach ($this->data['product_name'] as $k => $v):
                        $product['MenuLanguage']['menu_id'] = $this->Menu->id;
                        $product['MenuLanguage']['language_id'] = $k;
                        $product['MenuLanguage']['restaurent_id'] = $restaurent_id;
                        $product['MenuLanguage']['name'] = $v;
                        $this->MenuLanguage->create();
                        $this->MenuLanguage->set($product);
                        $this->MenuLanguage->save($product);
                    endforeach;

                    $this->Session->setFlash('Menu Item Added Successfully');
                    $this->redirect(array('controller' => 'products', 'action' => 'admin_index', $restaurent_id));
                else:
                    $this->Session->setFlash('Menu Item Not Added Successfully');
                    $this->redirect(array('controller' => 'products', 'action' => 'admin_index', $restaurent_id));
                endif;

            endif;
        else :
            $this->Session->setFlash(__('Something went wrong!!'));
            $this->redirect($this->referer());
        endif;
    }

    public function admin_edit_product($menu_id = null, $restaurent_id = null) {
        $userid = $this->Session->read('UserAuth.User.id');
        $user_temp_info = $this->Session->read('UserAuth.User');
        if (!empty($menu_id) && !empty($restaurent_id)) :
            $menu_item = $this->Menu->findById($menu_id);
            $restaurent_categories = $this->Category->find('list', array('fields' => 'id, name', 'conditions' => array('restaurent_id' => $restaurent_id)));
            $this->MenuLanguage->bindModel(array('belongsTo' => array('Language' => array('recursive' => 2, 'foreignKey' => 'language_id'))));
            $menu_item_languages = $this->MenuLanguage->find('all', array('conditions' => array('MenuLanguage.menu_id' => $menu_id)));
            
            $restaurent_data = $this->Restaurent->findById($restaurent_id);
            $restaurent_languages = explode(',', $restaurent_data['Restaurent']['restaurent_languages']);
            
            $this->Language->bindModel(array('hasOne' => array('MenuLanguage' => array('recursive' => 2, 'foreignKey' => 'language_id', 'conditions' => array('MenuLanguage.menu_id' => $menu_id)))));
            $menu_languages = $this->Language->find('all', array( 'conditions' => array( 'Language.id' => $restaurent_languages )));
            
            $this->set(compact('restaurent_categories', 'restaurent_id', 'menu_item', 'menu_item_languages', 'menu_id', 'menu_languages'));
            if ($this->request->is(array('post', 'put'))) :

                $this->Menu->set($this->data['Menu']);
                $this->Menu->id = $menu_id;
                $success = $this->Menu->save();

                if ($success):      
                    foreach ($this->data['product_name'] as $k => $v):
                        $product = array();
                        $exist_menu = $this->MenuLanguage->find('first', array( 'conditions' => array( 'menu_id' => $menu_id, 'language_id' => $k )));
                        if(!empty($exist_menu)):
                            $product['MenuLanguage']['language_id'] = $k;
                            $product['MenuLanguage']['name'] = $v;
                            $product['MenuLanguage']['restaurent_id'] = $restaurent_id;
                            $this->MenuLanguage->id = $exist_menu['MenuLanguage']['id'];
                            $this->MenuLanguage->set($product);
                            $this->MenuLanguage->save($product);
                        else:
                            $product['MenuLanguage']['language_id'] = $k;
                            $product['MenuLanguage']['name'] = $v;
                            $product['MenuLanguage']['restaurent_id'] = $restaurent_id;
                            $product['MenuLanguage']['menu_id'] = $menu_id;
                            $this->MenuLanguage->create();
                            $this->MenuLanguage->set($product);
                            $this->MenuLanguage->save($product);
                        endif;                        
                    endforeach;
                    $this->Session->setFlash('Menu Item Updated Successfully');
                    $this->redirect(array('controller' => 'products', 'action' => 'admin_index', $restaurent_id));
                else:
                    $this->Session->setFlash('Menu Item Not Updated Successfully');
                    $this->redirect(array('controller' => 'products', 'action' => 'admin_index', $restaurent_id));
                endif;
            else:
                $this->data = $menu_item;
            endif;
        else :
            $this->Session->setFlash(__('Something went wrong!!'));
            $this->redirect($this->referer());
        endif;
    }

    public function admin_delete_product($menu_id = null, $restaurent_id = null) {
        $userid = $this->Session->read('UserAuth.User.id');
        $user_temp_info = $this->Session->read('UserAuth.User');
        if (!empty($menu_id) && !empty($restaurent_id)) :
            $success = $this->Menu->delete($menu_id);
            if ($success):           
                $this->Session->setFlash('Menu Item Deleted Successfully');
                $this->redirect(array('controller' => 'products', 'action' => 'admin_index', $restaurent_id));
            else:
                $this->Session->setFlash('Menu Item Not Deleted Successfully');
                $this->redirect(array('controller' => 'products', 'action' => 'admin_index', $restaurent_id));
            endif;
        else :
            $this->Session->setFlash(__('Something went wrong!!'));
            $this->redirect($this->referer());
        endif;
    }    

}
