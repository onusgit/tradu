<?php

App::uses('AppController', 'Controller');

class SettingsController extends AppController {

    public $uses = array('Setting');

    public function admin_main_picture() {
        $main_image = $this->Setting->find('first', array('conditions' => array('key_name' => 'main_image')));
        $this->set(compact('main_image'));
        if ($this->request->is('post')):
            if (!empty($this->request->data)):
                if (!empty($this->request->data['Setting']['main_image']['tmp_name'])):
                    $file_name = $this->request->data['Setting']['main_image']['name'];
                    $tmp = explode('.', $file_name);
                    $ext = end($tmp);

                    $whitelist = array("jpg", "jpeg", "gif", "png", "ico");
                    if (!(in_array($ext, $whitelist))):
                        $this->Session->setFlash(__("Media Not Saved, please select an image file"), '', array('class' => 'alert-danger', 'icon' => 'icon-thumbs-down'));
                        exit;
                    endif;
                    $icon_source = $this->request->data['Setting']['main_image']['tmp_name'];
                    $image_path = WWW_ROOT . '/uploads/settings';

                    if (!file_exists($image_path)) {
                        mkdir($image_path, 0777, true);
                    }

                    @unlink($image_path . '/' . $main_image['Setting']['key_value']);

                    $new_file_name = 'main_image' . '.' . $ext;
                    $img_upload = move_uploaded_file($icon_source, $image_path . '/' . $new_file_name);

                    if ($img_upload):
                        $main_image['Setting']['id'] = $main_image['Setting']['id'];
                        $main_image['Setting']['key_name'] = 'main_image';
                        $main_image['Setting']['key_value'] = $new_file_name;
                        $success = $this->Setting->save($main_image);
                    endif;

                    if ($success):
                        $this->Session->setFlash('Main Image Updated Successfully');
                        $this->redirect(Router::url(array('controller' => 'settings', 'action' => 'admin_main_picture')));
                    else:
                        $this->Session->setFlash('Main Image Not Updated Successfully');
                        $this->redirect(Router::url(array('controller' => 'settings', 'action' => 'admin_main_picture')));
                    endif;
                endif;
            endif;
        endif;
    }

    public function admin_add_main_picture() {
        $already_has_main_image = $this->Setting->find('first', array('conditions' => array('key_name' => 'main_image')));
        if (!empty($already_has_main_image)):
            $this->Session->setFlash('Main Image All Ready Added');
            $this->redirect('/admin');
        endif;
        if ($this->request->is('post')):
            if (!empty($this->request->data)):
                if (!empty($this->request->data['Setting']['main_image']['tmp_name'])):
                    $file_name = $this->request->data['Setting']['main_image']['name'];
                    $tmp = explode('.', $file_name);
                    $ext = end($tmp);

                    $whitelist = array("jpg", "jpeg", "gif", "png", "ico");
                    if (!(in_array($ext, $whitelist))):
                        $this->Session->setFlash(__("Media Not Saved, please select an image file"), '', array('class' => 'alert-danger', 'icon' => 'icon-thumbs-down'));
                        exit;
                    endif;
                    $icon_source = $this->request->data['Setting']['main_image']['tmp_name'];
                    $image_path = WWW_ROOT . '/uploads/settings';

                    if (!file_exists($image_path)) {
                        mkdir($image_path, 0777, true);
                    }

                    $new_file_name = 'main_image' . '.' . $ext;
                    $img_upload = move_uploaded_file($icon_source, $image_path . '/' . $new_file_name);

                    if ($img_upload):
                        $main_image['Setting']['key_name'] = 'main_image';
                        $main_image['Setting']['key_value'] = $new_file_name;
                        $success = $this->Setting->save($main_image);
                    endif;

                    if ($success):
                        $this->Session->setFlash('Main Image Added Successfully');
                        $this->redirect(Router::url(array('controller' => 'settings', 'action' => 'admin_main_picture')));
                    else:
                        $this->Session->setFlash('Main Image Not Added Successfully');
                        $this->redirect(Router::url(array('controller' => 'settings', 'action' => 'admin_main_picture')));
                    endif;
                endif;
            endif;
        endif;
    }

    public function admin_edit_main_picture() {
        $main_image = $this->Setting->find('first', array('conditions' => array('key_name' => 'main_image')));
        if (!empty($main_image)):
            if ($this->request->is('post')):
                if (!empty($this->request->data)):
                    if (!empty($this->request->data['Setting']['main_image']['tmp_name'])):
                        $file_name = $this->request->data['Setting']['main_image']['name'];
                        $tmp = explode('.', $file_name);
                        $ext = end($tmp);

                        $whitelist = array("jpg", "jpeg", "gif", "png", "ico");
                        if (!(in_array($ext, $whitelist))):
                            $this->Session->setFlash(__("Media Not Saved, please select an image file"), '', array('class' => 'alert-danger', 'icon' => 'icon-thumbs-down'));
                            exit;
                        endif;
                        $icon_source = $this->request->data['Setting']['main_image']['tmp_name'];
                        $image_path = WWW_ROOT . '/uploads/settings';

                        if (!file_exists($image_path)) {
                            mkdir($image_path, 0777, true);
                        }

                        @unlink($image_path . '/' . $main_image['Setting']['key_value']);

                        $new_file_name = 'main_image' . '.' . $ext;
                        $img_upload = move_uploaded_file($icon_source, $image_path . '/' . $new_file_name);

                        if ($img_upload):
                            $main_image['Setting']['id'] = $main_image['Setting']['id'];
                            $main_image['Setting']['key_name'] = 'main_image';
                            $main_image['Setting']['key_value'] = $new_file_name;
                            $success = $this->Setting->save($main_image);
                        endif;

                        if ($success):
                            $this->Session->setFlash('Main Image Updated Successfully');
                            $this->redirect(Router::url(array('controller' => 'settings', 'action' => 'admin_main_picture')));
                        else:
                            $this->Session->setFlash('Main Image Not Updated Successfully');
                            $this->redirect(Router::url(array('controller' => 'settings', 'action' => 'admin_main_picture')));
                        endif;
                    endif;
                endif;
            endif;
        else:
            $this->Session->setFlash('Main Image Not Set Yet. Plese Set Main Image First');
            $this->redirect(Router::url(array('controller' => 'settings', 'action' => 'admin_main_picture')));
        endif;
        $this->set(compact('main_image'));
    }

    public function admin_delete_main_picture() {
        $main_image = $this->Setting->find('first', array('conditions' => array('key_name' => 'main_image')));

        $image_path = WWW_ROOT . '/uploads/settings';

        @unlink($image_path . '/' . $main_image['Setting']['key_value']);

        $success = $this->Setting->delete($main_image['Setting']['id']);
        if ($success):
            $this->Session->setFlash('Main Image Deleted Successfully');
            $this->redirect(Router::url(array('controller' => 'settings', 'action' => 'admin_main_picture')));
        else:
            $this->Session->setFlash('Main Image Not Deleted Successfully');
            $this->redirect(Router::url(array('controller' => 'settings', 'action' => 'admin_main_picture')));
        endif;
    }

    public function admin_featured_picture() {
        $featured_image = $this->Setting->find('first', array('conditions' => array('key_name' => 'featured_image')));
        $this->set(compact('featured_image'));
        if ($this->request->is('post')):
            if (!empty($this->request->data)):
                if (!empty($this->request->data['Setting']['featured_image']['tmp_name'])):
                    $file_name = $this->request->data['Setting']['featured_image']['name'];
                    $tmp = explode('.', $file_name);
                    $ext = end($tmp);

                    $whitelist = array("jpg", "jpeg", "gif", "png", "ico");
                    if (!(in_array($ext, $whitelist))):
                        $this->Session->setFlash(__("Media Not Saved, please select an image file"), '', array('class' => 'alert-danger', 'icon' => 'icon-thumbs-down'));
                        exit;
                    endif;
                    $icon_source = $this->request->data['Setting']['featured_image']['tmp_name'];
                    $image_path = WWW_ROOT . '/uploads/settings';

                    if (!file_exists($image_path)) {
                        mkdir($image_path, 0777, true);
                    }

                    @unlink($image_path . '/' . $featured_image['Setting']['key_value']);

                    $new_file_name = 'featured_image' . '.' . $ext;
                    $img_upload = move_uploaded_file($icon_source, $image_path . '/' . $new_file_name);

                    if ($img_upload):
                        $featured_image['Setting']['id'] = $featured_image['Setting']['id'];
                        $featured_image['Setting']['key_name'] = 'featured_image';
                        $featured_image['Setting']['key_value'] = $new_file_name;
                        $success = $this->Setting->save($featured_image);
                    endif;

                    if ($success):
                        $this->Session->setFlash('Featured Image Updated Successfully');
                        $this->redirect(Router::url(array('controller' => 'settings', 'action' => 'admin_featured_picture')));
                    else:
                        $this->Session->setFlash('Featured Image Not Updated Successfully');
                        $this->redirect(Router::url(array('controller' => 'settings', 'action' => 'admin_featured_picture')));
                    endif;
                endif;
            endif;
        endif;
    }

    public function admin_add_featured_picture() {
        $already_has_features_image = $this->Setting->find('first', array('conditions' => array('key_name' => 'featured_image')));
        if (!empty($already_has_features_image)):
            $this->Session->setFlash('Main Image All Ready Added');
            $this->redirect('/admin');
        endif;
        if ($this->request->is('post')):
            if (!empty($this->request->data)):
                if (!empty($this->request->data['Setting']['featured_image']['tmp_name'])):
                    $file_name = $this->request->data['Setting']['featured_image']['name'];
                    $tmp = explode('.', $file_name);
                    $ext = end($tmp);

                    $whitelist = array("jpg", "jpeg", "gif", "png", "ico");
                    if (!(in_array($ext, $whitelist))):
                        $this->Session->setFlash(__("Media Not Saved, please select an image file"), '', array('class' => 'alert-danger', 'icon' => 'icon-thumbs-down'));
                        exit;
                    endif;
                    $icon_source = $this->request->data['Setting']['featured_image']['tmp_name'];
                    $image_path = WWW_ROOT . '/uploads/settings';

                    if (!file_exists($image_path)) {
                        mkdir($image_path, 0777, true);
                    }

                    $new_file_name = 'featured_image' . '.' . $ext;
                    $img_upload = move_uploaded_file($icon_source, $image_path . '/' . $new_file_name);

                    if ($img_upload):
                        $featured_image['Setting']['key_name'] = 'featured_image';
                        $featured_image['Setting']['key_value'] = $new_file_name;
                        $success = $this->Setting->save($featured_image);
                    endif;

                    if ($success):
                        $this->Session->setFlash('Featured Image Added Successfully');
                        $this->redirect(Router::url(array('controller' => 'settings', 'action' => 'admin_featured_picture')));
                    else:
                        $this->Session->setFlash('Featured Image Not Added Successfully');
                        $this->redirect(Router::url(array('controller' => 'settings', 'action' => 'admin_featured_picture')));
                    endif;
                endif;
            endif;
        endif;
    }

    public function admin_edit_featured_picture() {
        $featured_image = $this->Setting->find('first', array('conditions' => array('key_name' => 'featured_image')));
        if (!empty($featured_image)):
            if ($this->request->is('post')):
                if (!empty($this->request->data)):
                    if (!empty($this->request->data['Setting']['featured_image']['tmp_name'])):
                        $file_name = $this->request->data['Setting']['featured_image']['name'];
                        $tmp = explode('.', $file_name);
                        $ext = end($tmp);

                        $whitelist = array("jpg", "jpeg", "gif", "png", "ico");
                        if (!(in_array($ext, $whitelist))):
                            $this->Session->setFlash(__("Media Not Saved, please select an image file"), '', array('class' => 'alert-danger', 'icon' => 'icon-thumbs-down'));
                            exit;
                        endif;
                        $icon_source = $this->request->data['Setting']['featured_image']['tmp_name'];
                        $image_path = WWW_ROOT . '/uploads/settings';

                        if (!file_exists($image_path)) {
                            mkdir($image_path, 0777, true);
                        }

                        @unlink($image_path . '/' . $featured_image['Setting']['key_value']);

                        $new_file_name = 'featured_image' . '.' . $ext;
                        $img_upload = move_uploaded_file($icon_source, $image_path . '/' . $new_file_name);

                        if ($img_upload):
                            $featured_image['Setting']['id'] = $featured_image['Setting']['id'];
                            $featured_image['Setting']['key_name'] = 'featured_image';
                            $featured_image['Setting']['key_value'] = $new_file_name;
                            $success = $this->Setting->save($featured_image);
                        endif;

                        if ($success):
                            $this->Session->setFlash('Featured Image Updated Successfully');
                            $this->redirect(Router::url(array('controller' => 'settings', 'action' => 'admin_featured_picture')));
                        else:
                            $this->Session->setFlash('Featured Image Not Updated Successfully');
                            $this->redirect(Router::url(array('controller' => 'settings', 'action' => 'admin_featured_picture')));
                        endif;
                    endif;
                endif;
            endif;
        else:
            $this->Session->setFlash('Featured Image Not Set Yet. Plese Set Main Image First');
            $this->redirect(Router::url(array('controller' => 'settings', 'action' => 'admin_featured_picture')));
        endif;
        $this->set(compact('featured_image'));
    }

    public function admin_delete_featured_picture() {
        $featured_image = $this->Setting->find('first', array('conditions' => array('key_name' => 'featured_image')));

        $image_path = WWW_ROOT . '/uploads/settings';

        @unlink($image_path . '/' . $featured_image['Setting']['key_value']);

        $success = $this->Setting->delete($featured_image['Setting']['id']);
        if ($success):
            $this->Session->setFlash('Featured Image Deleted Successfully');
            $this->redirect(Router::url(array('controller' => 'settings', 'action' => 'admin_featured_picture')));
        else:
            $this->Session->setFlash('Featured Image Not Deleted Successfully');
            $this->redirect(Router::url(array('controller' => 'settings', 'action' => 'admin_featured_picture')));
        endif;
    }

}
