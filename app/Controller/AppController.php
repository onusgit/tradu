<?php

/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

    var $helpers = array('Form', 'Html', 'Session', 'Js', 'Usermgmt.UserAuth', 'I18n.I18n');
    public $components = array('DebugKit.Toolbar', 'Session', 'Cookie', 'RequestHandler', 'Usermgmt.UserAuth');
    public $uses = array();

    function beforeFilter() {
        $this->userAuth();
        $user = $this->UserAuth->getUser();
        if (isset($this->params['admin']) && $this->params['admin']) {
            if (empty($user) || !in_array($user['User']['user_group_id'], array('1'))):
                $this->Session->setFlash(__('You must be logged in for that action.'), 'custom_flash_message', array('class' => 'alert-danger', 'icon' => 'icon-thumbs-down'));
                $this->redirect('/login');
            endif;
            // change layout
            $this->layout = 'admin';
        }
        
        if (isset($this->request->params['named']['lang'])) {
            $lang = $this->request->params['named']['lang'];
            if (in_array($lang, Configure::read('Config.languages'))) {
                $this->Session->write('Config.language', $lang);
            } else if ($lang == 'fr-fr') {
                $this->Session->write('Config.language', 'fra');
            } else {
                $this->Session->write('Config.language', DEFAULT_LANGUAGE);
            }
            Configure::write('Config.language', $this->Session->read('Config.language'));
        } else {
            $default_lang = $this->Session->read('Config.language');
            if (isset($default_lang) && $default_lang != ''):
                Configure::write('Config.language', $this->Session->read('Config.language'));
            else:
                Configure::write('Config.language', 'fra');
                $this->Session->write('Config.language', 'fra');
            endif;
        }
        
        setlocale("LC_ALL", "fre_FR.utf8");
    }

    private function userAuth() {
        $this->UserAuth->beforeFilter($this);
    }

}
