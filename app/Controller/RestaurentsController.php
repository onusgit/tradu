<?php

App::uses('AppController', 'Controller');

class RestaurentsController extends AppController {

    public $uses = array('Restaurent', 'Category', 'Menu', 'Language', 'MenuLanguage', 'Country', 'CategoryLanguage', 'RestaurentType');

    public function admin_index() {
        $restaurents = $this->Restaurent->find('all');
        $this->set(compact('restaurents'));
    }

    public function admin_add() {
        $countries = $this->Country->find('list', array('fields' => array('id', 'country_name')));
        $languages = $this->Language->find('list', array('fields' => array('id', 'name')));
        $restaurent_types = $this->RestaurentType->find('list', array('fields' => array('id', 'name')));
        $this->set(compact('countries', 'languages', 'restaurent_types'));
        if ($this->request->is('post')):
            if (!empty($this->request->data)):
                $this->Restaurent->set($this->request->data);
//                if ($this->Restaurent->validates()):
                $l_string = implode(',', $this->request->data['Restaurent']['languages']);
                $this->request->data['Restaurent']['restaurent_languages'] = $l_string;

                $type_string = implode(',', $this->request->data['Restaurent']['types']);
                $this->request->data['Restaurent']['restaurent_types'] = $type_string;

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
                    $this->Session->setFlash('Restaurent Added Successfully');
                    $this->redirect(array('controller' => 'Restaurents', 'action' => 'admin_index'));
                else:
                    $this->Session->setFlash('Restaurent Not Added Successfully');
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
        $conditions = [];
        $latitude = 48.858385;
        $longitude = 2.350088;
        $rest_name = '';
        $rest_address = '';
        $rest_type = '';
        $order = array('name ASC');
        if ($this->request->is(array('post', 'get', 'ajax'))):
            if (!empty($this->request->data['Rest']['name'])):
                $rest_name = $this->request->data['Rest']['name'];
                $conditions[] = array('Restaurent.name LIKE' => '%' . $rest_name . '%');
            endif;

            if (!empty($this->request->data['Rest']['type'])):
                $rest_type = implode(',', $this->request->data['Rest']['type']);
            endif;

            if (!empty($this->request->data['Rest']['rest_type'])):
                $rest_type = $this->request->data['Rest']['rest_type'];
            endif;

            if (!empty($this->request->data['Rest']['lat'])):
                $latitude = $this->request->data['Rest']['lat'];
                $longitude = $this->request->data['Rest']['lng'];
                $this->Restaurent->virtualFields = array(
                    'distance' => "(((acos(sin(($latitude*pi()/180)) 
                                                          * sin((Restaurent.latitude*pi()/180))
                                                          + cos(($latitude*pi()/180)) * cos((Restaurent.latitude*pi()/180))
                                                          * cos((($longitude - Restaurent.longitude)*pi()/180))))*180/pi())*60*1.1515*1.609344)",
                );
                $rest_address = $this->request->data['Rest']['address'];
                //$conditions[] = array('Restaurent.distance' => '< 20');
                $order = array('distance ASC');
            endif;
        endif;
        $restaurents = $this->Restaurent->find('all', array('conditions' => $conditions, 'order' => $order));

        $restaurent_types = $this->RestaurentType->find('all', array('fields' => array('id', 'name')));
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
            $data[$k]['rest_types'] = explode(",", $r['Restaurent']['restaurent_types']);
        endforeach;

        if (!empty($this->request->data['Rest']['type']) || !empty($this->request->data['Rest']['rest_type'])):
            $r_types = explode(',', $rest_type);
            $data1 = [];
            foreach ($data as $key => $d):                
                if (array_intersect($r_types, $d['rest_types'])):
                    $data1[] = $d;
                endif;
            endforeach;
            $data = $data1;            
        endif;
        
        if (!empty($data)):
            $status = 1;
        else:
            $status = 0;
        endif;
        //pr($data1);
        $this->set(compact('restaurents', 'data', 'status', 'rest_name', 'latitude', 'longitude', 'restaurent_types', 'rest_address', 'rest_type', 'conditions'));
        $this->set('_serialize', array('data', 'status', 'conditions'));
    }

    public function admin_edit($restaurent_id = null) {
        if (!empty($restaurent_id)):
            $restaurent = $this->Restaurent->find('first', array('conditions' => array('Restaurent.id' => $restaurent_id)));
            if (!empty($restaurent)):
                //pr($restaurent);die;               
                $countries = $this->Country->find('list', array('fields' => array('id', 'country_name')));
                $languages = $this->Language->find('list', array('fields' => array('id', 'name')));
                $restaurent_types = $this->RestaurentType->find('list', array('fields' => array('id', 'name')));
                $restaurent_languages = explode(',', $restaurent['Restaurent']['restaurent_types']);
                $rest_type = explode(',', $restaurent['Restaurent']['restaurent_types']);

                $this->set(compact('countries', 'languages', 'restaurent_languages', 'restaurent_types', 'rest_type'));
                if ($this->request->is(array('post', 'put'))):
                    if (!empty($this->request->data)):
                        $this->Restaurent->set($this->request->data['Restaurent']);
//                        if ($this->Restaurent->RestaurentValidate()):
                        $l_string = implode(',', $this->request->data['Restaurent']['languages']);
                        $this->request->data['Restaurent']['restaurent_languages'] = $l_string;

                        $type_string = implode(',', $this->request->data['Restaurent']['types']);
                        $this->request->data['Restaurent']['restaurent_types'] = $type_string;

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
        if (!empty($restaurent_id)):

            $this->Restaurent->bindModel(array('hasMany' => array('Category' => array('foriegnKey' => 'restaurent_id')), 'belongsTo' => array('Country' => array('foriegnKey' => 'country_id'))));
            $restaurent = $this->Restaurent->find('first', array('conditions' => array('Restaurent.id' => $restaurent_id)));
            $this->Category->bindModel(array('hasMany' => array('CategoryLanguage' => array('foriegnKey' => 'id'))));
            $restaurent_categories = $this->Category->find('all', array('recursive' => 2, 'conditions' => array('restaurent_id' => $restaurent_id)));

            $this->Menu->bindModel(array('belongsTo' => array('Category' => array('foriegnKey' => 'category_id'))));
            $restaurent_menu = $this->Menu->find('all', array('conditions' => array('Menu.restaurent_id' => $restaurent_id), 'ORDER' => 'Category.id'));
            $restaurent_languages = explode(',', $restaurent['Restaurent']['restaurent_languages']);
            $languages = $this->Language->find('all', array('conditions' => array('Language.id' => $restaurent_languages)));
            if (!empty($restaurent_categories)):
                foreach ($restaurent_categories as $k => $v):
                    $data[$k]['product_categry'] = $v;
                    $this->Category->bindModel(array('hasMany' => array('CategoryLanguage' => array('foriegnKey' => 'id'))));
                    $this->Menu->bindModel(array('belongsTo' => array('Category' => array('foriegnKey' => 'category_id')), 'hasMany' => array('MenuLanguage' => array('foriegnKey' => 'id'))));
                    $restaurent_menu = $this->Menu->find('all', array('recursive' => 2, 'conditions' => array('Menu.restaurent_id' => $restaurent_id, 'Menu.category_id' => $v['Category']['id']), 'ORDER' => 'Category.id'));
                    $data[$k]['products'] = $restaurent_menu;
                endforeach;
            endif;
            $default_lang = 2;
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
