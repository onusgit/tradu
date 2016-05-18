
<?php

App::uses('AppController', 'Controller');

class LanguagesController extends AppController {

    public $uses = array('Language', 'MenuLanguage');

    public function admin_index() {
        $languages = $this->Language->find('all');
        $this->set(compact('languages'));
    }

    public function admin_add() {
        if ($this->request->is(array('post'))):
            $this->Language->create();
            $this->Language->set($this->request->data);
            $success = $this->Language->save($this->request->data['Language']);
            if ($success):
                if (!empty($this->request->data['Language']['image']['tmp_name'])):
                    $file_name = $this->request->data['Language']['image']['name'];
                    $tmp = explode('.', $file_name);
                    $ext = end($tmp);
                    $whitelist = array("jpg", "jpeg", "gif", "png", "ico");
                    if (!(in_array($ext, $whitelist))):
                        $this->Session->setFlash(__("Media Not Saved, please select an image file"), '', array('class' => 'alert-danger', 'icon' => 'icon-thumbs-down'));
                        exit;
                    endif;
                    $icon_source = $this->request->data['Language']['image']['tmp_name'];
                    $image_path = WWW_ROOT . 'uploads/languages/' . $this->Language->id;
                    if (!file_exists($image_path)) {
                        mkdir($image_path, 0777, true);
                    }
                    $img_upload = move_uploaded_file($icon_source, $image_path . '/' . $file_name);
                    if ($img_upload):
                        $this->Language->saveField('language_image', $file_name);
                    endif;
                    $this->Session->setFlash('Language Added Successfully');
                    $this->redirect(array('controller' => 'languages', 'action' => 'admin_index'));
                endif;
            else:
                $this->Session->setFlash('Language Not Added Successfully');
                $this->redirect(array('controller' => 'languages', 'action' => 'admin_index'));
            endif;
        endif;
    }

    public function admin_edit($language_id = null) {
        if (!empty($language_id)):
            $language = $this->Language->find('first', array('conditions' => array('Language.id' => $language_id)));
            if (!empty($language)):
                if ($this->request->is(array('post', 'put'))):
                    if (!empty($this->request->data)):
                        $this->Language->set($this->request->data['Language']);
                        $this->Language->id = $language_id;
                        $success = $this->Language->save($this->request->data['Language']);

                        if (!empty($this->request->data['Language']['image']['tmp_name'])):
                            $file_name = $this->request->data['Language']['image']['name'];
                            $tmp = explode('.', $file_name);
                            $ext = end($tmp);
                            $whitelist = array("jpg", "jpeg", "gif", "png", "ico");
                            if (!(in_array($ext, $whitelist))):
                                $this->Session->setFlash(__("Media Not Saved, please select an image file"), '', array('class' => 'alert-danger', 'icon' => 'icon-thumbs-down'));
                                exit;
                            endif;
                            $icon_source = $this->request->data['Language']['image']['tmp_name'];
                            $image_path = WWW_ROOT . 'uploads/languages/' . $this->Language->id;
                            if (!file_exists($image_path)) {
                                mkdir($image_path, 0777, true);
                            }
                            $img_upload = move_uploaded_file($icon_source, $image_path . '/' . $file_name);
                            if ($img_upload):
                                @unlink($image_path . '/' . $language['Language']['language_image']);
                                $this->Language->saveField('language_image', $file_name);
                            endif;
                        endif;


                        if ($success):
                            $this->Session->setFlash('Language Updated Successfully');
                            $this->redirect(array('controller' => 'languages', 'action' => 'admin_index'));
                        else:
                            $this->Session->setFlash('Language Not Updates Successfully');
                            $this->redirect(array('controller' => 'languages', 'action' => 'admin_index'));
                        endif;                    
                    endif;
                else:
                    $this->set(compact('language'));
                    $this->request->data = $language;
                endif;

            else:
                $this->Session->setFlash('No Language Found');
                $this->redirect(array('controller' => 'languages', 'action' => 'admin_index'));
            endif;

        else:
            $this->Session->setFlash('Something Going wrong');
            $this->redirect(array('controller' => 'languages', 'action' => 'admin_index'));
        endif;
    }
    
    public function admin_delete($language_id = null) {
        if (!empty($language_id)):
            $language_data = $this->Language->find('first', array('conditions' => array('id' => $language_id)));
            $success = $this->Language->delete($language_id);
            if ($success):
                $this->MenuLanguage->deleteAll(array('language_id' => $language_id));
                $path_to_image = WWW_ROOT . 'uploads/languages/' . $language_id;
                @unlink($path_to_image . '/' . $language_data['Language']['language_image']);
                @rmdir($path_to_image);
                $this->Session->setFlash('Language deleted successfully.');
            else:
                $this->Session->setFlash('Language not deleted successfully.');
            endif;
        else:
            $this->Session->setFlash('Something Going wrong');
        endif;
        $this->redirect(array('controller' => 'languages', 'action' => 'admin_index'));
    }


}
