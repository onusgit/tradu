<?php

App::uses('AppController', 'Controller');

class RestaurentsController extends AppController {

    public $uses = array('Restaurent', 'Category', 'Menu', 'Language', 'MenuLanguage', 'Country', 'CategoryLanguage');

    public function admin_index() {
        $restaurents = $this->Restaurent->find('all');
        $this->set(compact('restaurents'));
    }

    public function admin_add() {
        $countries = $this->Country->find('list', array('fields' => array('id', 'country_name')));
        $languages = $this->Language->find('list', array('fields' => array('id', 'name')));
        $this->set(compact('countries', 'languages'));
        if ($this->request->is('post')):
            if (!empty($this->request->data)):
                $this->Restaurent->set($this->request->data);
//                if ($this->Restaurent->validates()):
                $l_string = implode(',', $this->request->data['Restaurent']['language']);
                $this->request->data['Restaurent']['restaurent_languages'] = $l_string;
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
                    $image_path = WWW_ROOT . '/uploads/restaurents/' . $this->Restaurent->id;
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

    public function index() {
        $restaurents = $this->Restaurent->find('all');
        foreach ($restaurents as $k => $r):
            $data[$k]['id'] = $r['Restaurent']['id'];
            $data[$k]['color'] = '#000';
            $data[$k]['price'] = '10';
            $data[$k]['url'] = Router::url(array('controller' => 'restaurents', 'action' => 'menu', $r['Restaurent']['id']));
            $data[$k]['type_icon'] = FULL_BASE_URL . '/app/webroot/img/icons/restaurant/restaurant.png';
            $data[$k]['type'] = 'restaurent';
            $data[$k]['img'] = FULL_BASE_URL . '/app/webroot/uploads/restaurents/' . $r['Restaurent']['id'] . '/' . $r['Restaurent']['resturent_image'];
            $data[$k]['title'] = $r['Restaurent']['name'];
            $data[$k]['location'] = $r['Restaurent']['address'];
            $data[$k]['latitude'] = $r['Restaurent']['latitude'];
            $data[$k]['longitude'] = $r['Restaurent']['longitude'];
        endforeach;
        if (!empty($data)):
            $status = 1;
        else:
            $status = 0;
        endif;
        $this->set(compact('restaurents', 'data', 'status'));
        $this->set('_serialize', array('data', 'status'));
    }

    public function admin_edit($restaurent_id = null) {
        if (!empty($restaurent_id)):
            $restaurent = $this->Restaurent->find('first', array('conditions' => array('Restaurent.id' => $restaurent_id)));
            if (!empty($restaurent)):
                //pr($restaurent);die;               
                $countries = $this->Country->find('list', array('fields' => array('id', 'country_name')));
                $languages = $this->Language->find('list', array('fields' => array('id', 'name')));
                $restaurent_languages = explode(',', $restaurent['Restaurent']['restaurent_languages']);
                $this->set(compact('countries', 'languages', 'restaurent_languages'));
                if ($this->request->is(array('post', 'put'))):
                    if (!empty($this->request->data)):
                        $this->Restaurent->set($this->request->data['Restaurent']);
//                        if ($this->Restaurent->RestaurentValidate()):
                        $l_string = implode(',', $this->request->data['Restaurent']['language']);
                        $this->request->data['Restaurent']['restaurent_languages'] = $l_string;
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

    public function view($restaurent_id = null) {
        if (!empty($restaurent_id)):
            $this->Restaurent->bindModel( array( 'hasMany' => array( 'Category' => array( 'foriegnKey' => 'restaurent_id' ) ) ) );
            $restaurent = $this->Restaurent->find('first', array('conditions' => array( 'Restaurent.id' => $restaurent_id ) ) );
        else:
            $this->Session->setFlash('No Data Found.');
            $this->redirect(FULL_BASE_URL);
        endif;
        $this->set(compact('restaurent'));
    }

    public function menu($restaurent_id = null) {
//        $this->Category->bindModel(array( 'hasMany' => array( 'CategoryLanguage' => array('foriegnKey' => 'id') ) ));
//        $a = $this->Category->findById(9);
//        pr($a);
//        die;
        if(!empty($restaurent_id)):
        
        $this->Restaurent->bindModel( array( 'hasMany' => array( 'Category' => array( 'foriegnKey' => 'restaurent_id' ) ), 'belongsTo' => array( 'Country' => array( 'foriegnKey' => 'country_id' ) ) ) );
        $restaurent = $this->Restaurent->find('first', array('conditions' => array( 'Restaurent.id' => $restaurent_id ) ) );
        $restaurent_categories = $this->Category->find('all', array('conditions' => array('restaurent_id' => $restaurent_id)));
        $this->Menu->bindModel(array('belongsTo' => array('Category' => array('foriegnKey' => 'category_id'))));
        $restaurent_menu = $this->Menu->find('all', array('conditions' => array('Menu.restaurent_id' => $restaurent_id), 'ORDER' => 'Category.id'));
        $restaurent_languages = explode(',', $restaurent['Restaurent']['restaurent_languages']);
        $languages = $this->Language->find('all', array( 'conditions' => array( 'Language.id' => $restaurent_languages ) ));
        if (!empty($restaurent_categories)):
            foreach ($restaurent_categories as $k => $v):
                $data[$k]['product_categry'] = $v;
                $this->Category->bindModel(array( 'hasMany' => array( 'CategoryLanguage' => array('foriegnKey' => 'id') ) ));
                $this->Menu->bindModel(array('belongsTo' => array('Category' => array('foriegnKey' => 'category_id')), 'hasMany' => array('MenuLanguage' => array('foriegnKey' => 'id'))));
                $restaurent_menu = $this->Menu->find('all', array('recursive' => 2, 'conditions' => array('Menu.restaurent_id' => $restaurent_id, 'Menu.category_id' => $v['Category']['id']), 'ORDER' => 'Category.id'));
                $data[$k]['products'] = $restaurent_menu;
            endforeach;
        endif;
        $default_lang = 1;
          else:
            $this->Session->setFlash('No Data Found.');
            $this->redirect(FULL_BASE_URL);
        endif;
      
        $this->set(compact('restaurent_categories', 'restaurent_menu', 'data', 'languages', 'default_lang', 'restaurent'));
    }

    public function quick_view() {
        $restaurent_id = $this->data['id'];
        if (!empty($restaurent_id)):
            $this->Category->bindModel(array('hasMany' => array('Menu' => array('foriegnKey' => 'category_id'))));
            $this->Restaurent->bindModel(array('hasMany' => array('Category' => array('foriegnKey' => 'restaurent_id'))));
            $restaurent = $this->Restaurent->find('first', array('recursive' => 2, 'conditions' => array('Restaurent.id' => $restaurent_id)));
        else:
            $this->Session->setFlash('No Data Found.');
        endif;
        $this->set(compact('restaurent'));
    }

}
