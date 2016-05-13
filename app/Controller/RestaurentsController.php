<?php

App::uses('AppController', 'Controller');

class RestaurentsController extends AppController {

    public $uses = array('Restaurent', 'Category', 'Menu', 'Language', 'MenuLanguage', 'Country');

    public function admin_index() {
        $restaurents = $this->Restaurent->find('all');
        $this->set(compact('restaurents'));
    }

    public function admin_add() {
        $countries = $this->Country->find('list', array('fields' => array('id', 'country_name')));
        $this->set(compact('countries'));
        if ($this->request->is('post')):
            if (!empty($this->request->data)):
                $this->Restaurent->set($this->request->data);
//                if ($this->Restaurent->validates()):

                $success = $this->Restaurent->save($this->request->data['Restaurent']);
                if (!empty($this->request->data['Restaurent']['image']['tmp_name'])):
                    $file_name = $this->request->data['Restaurent']['image']['name'];
                    $tmp = explode('.', $file_name);
                    $ext = end($tmp);
                    $whitelist = array("jpg", "jpeg", "gif", "png", "ico");
                    if (!(in_array($ext, $whitelist))):
                        $this->Session->setFlash(__("Media Not Saved, please select an image file"), '', array('class' => 'alert-danger', 'icon' => 'icon-thumbs-down'));
                        exit;
                    endif;
                    $icon_source = $this->request->data['Restaurent']['image']['tmp_name'];
                    $image_path = WWW_ROOT . 'uploads/restaurents/' . $this->Restaurent->id;
                    if (!file_exists($image_path)) {
                        mkdir($image_path, 0777, true);
                    }
                    $img_upload = move_uploaded_file($icon_source, $image_path . '/' . $file_name);
                    if ($img_upload):
                        $this->Restaurent->saveField('resturent_image', $file_name);
                    endif;
                endif;
                if ($success):
                    $this->Session->setFlash('Store Added Successfully');
                    $this->redirect(array('controller' => 'Restaurents', 'action' => 'admin_index'));
                else:
                    $this->Session->setFlash('Store Not Added Successfully');
                    $this->redirect(array('controller' => 'Restaurents', 'action' => 'admin_index'));
                endif;
//                else:
//                    $this->Session->setFlash('Validation Error');
//                    $this->redirect(array('controller' => 'Restaurents', 'action' => 'admin_index'));
//                endif;
            endif;
        endif;
    }

    public function admin_edit($restaurent_id = null) {
        if (!empty($restaurent_id)):
            $restaurent = $this->Restaurent->find('first', array('conditions' => array('Restaurent.id' => $restaurent_id)));
            if (!empty($restaurent)):
                $countries = $this->Country->find('list', array('fields' => array('id', 'country_name')));
                $this->set(compact('countries'));
                if ($this->request->is(array('post', 'put'))):
                    if (!empty($this->request->data)):
                        $this->Restaurent->set($this->request->data['Restaurent']);
//                        if ($this->Restaurent->RestaurentValidate()):
                        $this->Restaurent->id = $restaurent_id;
                        $success = $this->Restaurent->save($this->request->data['Restaurent']);

                        if (!empty($this->request->data['Restaurent']['image']['tmp_name'])):
                            $file_name = $this->request->data['Restaurent']['image']['name'];
                            $tmp = explode('.', $file_name);
                            $ext = end($tmp);
                            $whitelist = array("jpg", "jpeg", "gif", "png", "ico");
                            if (!(in_array($ext, $whitelist))):
                                $this->Session->setFlash(__("Media Not Saved, please select an image file"), '', array('class' => 'alert-danger', 'icon' => 'icon-thumbs-down'));
                                exit;
                            endif;
                            $icon_source = $this->request->data['Restaurent']['image']['tmp_name'];
                            $image_path = WWW_ROOT . 'uploads/restaurents/' . $this->Restaurent->id;
                            if (!file_exists($image_path)) {
                                mkdir($image_path, 0777, true);
                            }
                            $img_upload = move_uploaded_file($icon_source, $image_path . '/' . $file_name);
                            if ($img_upload):
                                @unlink($image_path . '/' . $restaurent['Restaurent']['resturent_image']);
                                $this->Restaurent->saveField('resturent_image', $file_name);
                            endif;
                        endif;


                        if ($success):
                            $this->Session->setFlash('Restaurent Updated Successfully');
                            $this->redirect(array('controller' => 'Restaurents', 'action' => 'admin_index'));
                        else:
                            $this->Session->setFlash('Restaurent Not Updates Successfully');
                            $this->redirect(array('controller' => 'Restaurents', 'action' => 'admin_index'));
                        endif;
//                        else:
//                            $this->Session->setFlash('Validation Error');
//                        $this->redirect(array('controller' => 'Restaurents', 'action' => 'admin_index'));
//                        endif;
                    endif;
                else:
                    $this->set(compact('restaurent'));
                    $this->request->data = $restaurent;
                endif;

            else:
                $this->Session->setFlash('No Restaurent Found');
                $this->redirect(array('controller' => 'Restaurents', 'action' => 'admin_index'));
            endif;

        else:
            $this->Session->setFlash('Something Going wrong');
            $this->redirect(array('controller' => 'Restaurents', 'action' => 'admin_index'));
        endif;
    }

    public function admin_delete($restaurent_id = null) {
        if (!empty($restaurent_id)):
            $restaurent_data = $this->Restaurent->find('first', array('conditions' => array('id' => $restaurent_id)));
            $success = $this->Restaurent->delete($restaurent_id);
            if ($success):
                $path_to_image = WWW_ROOT . 'uploads/restaurents/' . $restaurent_id;
                @unlink($path_to_image . '/' . $restaurent_data['Restaurent']['resturent_image']);
                @rmdir($path_to_image);
                $this->Session->setFlash('Restaurent deleted successfully.');
            else:
                $this->Session->setFlash('Restaurent not deleted successfully.');
            endif;
        else:
            $this->Session->setFlash('Something Going wrong');
        endif;
        $this->redirect(array('controller' => 'Restaurents', 'action' => 'admin_index'));
    }

    public function admin_restaurent_status_change() {
        $this->layout = 'ajax';
        if (($this->request->is('post')) || ($this->request->is('put'))):
            $this->Restaurent->id = $this->request->data['pk'];
            $store_val = $this->request->data['value'];
            $this->Restaurent->saveField('status', $this->request->data['value']);
        endif;
        exit();
    }

    public function menu($restaurent_id = null) {
        $restaurent_categories = $this->Category->find('all', array('conditions' => array('restaurent_id' => $restaurent_id)));
        $this->Menu->bindModel(array('belongsTo' => array('Category' => array('foriegnKey' => 'category_id'))));
        $restaurent_menu = $this->Menu->find('all', array('conditions' => array('Menu.restaurent_id' => $restaurent_id), 'ORDER' => 'Category.id'));
        if (!empty($restaurent_categories)):            
            foreach ($restaurent_categories as $k => $v):
            $data[$k]['product_categry'] = $v;
                $this->Menu->bindModel(array('belongsTo' => array('Category' => array('foriegnKey' => 'category_id'))));
                $restaurent_menu = $this->Menu->find('all', array('conditions' => array('Menu.restaurent_id' => $restaurent_id, 'Menu.category_id' => $v['Category']['id']), 'ORDER' => 'Category.id'));
            $data[$k]['products'] = $restaurent_menu;    
            endforeach;
        endif;
        $this->set(compact('restaurent_categories', 'restaurent_menu', 'data'));
    }

}
