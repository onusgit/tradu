

<?php

/**
 * Copyright 2009-2010, Cake Development Corporation (http://cakedc.com)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright 2009-2010, Cake Development Corporation (http://cakedc.com)
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

/**
 * i18n Helper
 *
 * i18n view helper allowing to easily generate common i18n related controls
 *
 * @package i18n
 * @subpackage i18n.views.helpers
 */
class I18nHelper extends AppHelper {

    /**
     * Helpers
     *
     * @var array $helpers
     */
    public $helpers = array('Html');

    /**
     * Base path for the flags images, with a trailing slash
     * 
     * @var string $basePath
     */
    public $basePath = '/i18n/img/flags/';

    /**
     * Displays a list of flags
     * 
     * @param array $options Options with the following possible keys
     * 	- basePath: Base path for the flag images, with a trailing slash
     * 	- class: Class of the <ul> wrapper
     * 	- id: Id of the wrapper
     *  - appendName: boolean, whether the language name must be appended to the flag or not [default: false]
     * @return void
     */
    public function flagSwitcher($options = array()) {
        $_defaults = array(
            'basePath' => $this->basePath,
            'class' => 'languages',
            'id' => '',
            'appendName' => false);
        $options = array_merge($_defaults, $options);
        $langs = $this->availableLanguages();       

        $out = '';
        if (!empty($langs)) {
            $id = empty($options['id']) ? '' : ' id="' . $options['id'] . '"';
            $valu = Configure::read('Config.language');
            if (empty($valu)) {
                if (isset($this->request->params['named']['lang'])) {
                    $valu = $this->request->params['named']['lang'];
                } else {
                    $valu = "fra";
                }
            }
            if ($valu == "en-us") {
                $valu = "eng";
            }
//            $out.='<div class="btn-group">';
//            $out.='<button type="button" data-toggle="dropdown" class="btn btn-default dropdown-toggle">' . $this->flagImage($valu, $options) . ' &nbsp;<span class="caret"></span></button>';
            $out.='<ul role="menu" class="nav">';
            foreach ($langs as $lang) {
                $class = $lang;
//                if ($lang == Configure::read('Config.language') || $lang == $valu) {
//                    $class .= ' selected';
//                } else {
                    $url = array_merge($this->params['named'], $this->params['pass'], compact('lang'));
                    $lFname = Configure::read('Config.languages_full_name');
                    $language = $lFname[$lang];
                    $out.='<li class="' . $class . '">' . $this->Html->link($this->flagImage($lang, $options).'<span>'.$language.'</span>', $url, array('escape' => false, 'title' => $language, 'class' => 'language-li')) . '</li>';
//                }
            }
            $out.='</ul>';
            
        }                           
                                        
        return $out;
    }

    /**
     * Displays a list of flags
     * 
     * @param array $options Options with the following possible keys
     * 	- basePath: Base path for the flag images, with a trailing slash
     * 	- class: Class of the <ul> wrapper
     * 	- id: Id of the wrapper
     *  - appendName: boolean, whether the language name must be appended to the flag or not [default: false]
     * @return void
     */
    public function frontFlagSwitcher1($options = array()) {
        $_defaults = array(
            'basePath' => $this->basePath,
            'class' => 'languages',
            'id' => '',
            'appendName' => false);
        $options = array_merge($_defaults, $options);
        $langs = $this->availableLanguages();        
        $out = '';
        if (!empty($langs)) {
            $id = empty($options['id']) ? '' : ' id="' . $options['id'] . '"';
            $valu = Configure::read('Config.language');
            $lang_title = '';
            if (empty($valu)) {
                if (isset($this->request->params['named']['lang'])) {
                    $valu = $this->request->params['named']['lang'];
                } else {
                    $valu = "fra";
                }
            }
            if ($valu == "en-us") {
                $valu = "eng";
            }
            if ($valu == 'eng'):
                $lang_title = __('English');
            elseif ($valu == 'rus'):
                $lang_title = __('Russian');
            elseif ($valu == 'spa'):
                $lang_title = __('Spanish');
            else:
                $lang_title = __('French');
            endif;

            $out.='<div class="btn-group">';
            $out.='<button type="button" data-toggle="dropdown" class="btn btn-default dropdown-toggle footer-lang-btn">' . $lang_title . ' &nbsp;<span class="caret"></span></button>';
            $out.='<ul role="menu" class="' . $options['class'] . ' dropdown-menu pull-right"' . $id . ' role="menu">';
            foreach ($langs as $lang) {
                $class = $lang;
                if ($lang == Configure::read('Config.language') || $lang == $valu) {
                    $class .= ' selected';
                } else {
                    $url = array_merge($this->params['named'], $this->params['pass'], compact('lang'));
                    if($this->request->controller == 'stores' && $this->request->action == 'store_view'):
                        $url = FULL_BASE_URL.'/magasin/'.$this->request->params['city'].'/'.$this->request->params['cat'].'/'.$this->request->params['slug'].'/lang:'.$lang;
                    elseif($this->request->controller == 'posts' && $this->request->action == 'view'):
                        $url = FULL_BASE_URL.'/actualites/'.$this->request->params['cat'].'/'.$this->request->params['slug'].'/lang:'.$lang;
                    elseif($this->request->controller == 'challenges' && $this->request->action == 'contest_view'):
                        $url = FULL_BASE_URL.'/challenge/'.$this->request->params['slug'].'/lang:'.$lang;
                    elseif($this->request->controller == 'merchant_associate' && $this->request->action == 'view'):
                        $url = FULL_BASE_URL.'/association-commercants/'.$this->request->params['city'].'/'.$this->request->params['slug'].'/lang:'.$lang;
                    endif;                    
                    $lFname = Configure::read('Config.languages_full_name');
                    $language = $lFname[$lang];
                    $out.='<li class="' . $class . '">' . $this->Html->link($language, $url, array('escape' => false, 'title' => $language, 'class' => 'text-center')) . '</li>';
                }
            }
            $out.='</ul>';
            $out.='</div>';
        }
        return $out;
    }

    /**
     * Returns the correct image from the language code
     * 
     * @param string $lang Long language code
     * @param array $options Options with the following possible keys
     * 	- basePath: Base path for the flag images, with a trailing slash
     *  - appendName: boolean, whether the language name must be appended to the flag or not [default: false]
     * @return string Image markup
     */
    public function flagImage($lang, $options = array()) {
        $L10n = $this->_getCatalog();
        $_defaults = array('basePath' => $this->basePath, 'appendName' => false);
        $options = array_merge($_defaults, $options);

        if (strlen($lang) == 3) {
            $flag = $L10n->map($lang);
        } else {
            $flag = $lang;
        }

        if ($flag === false) {
            $flag = $lang;
        }
        if (strpos($lang, '-') !== false) {
            $arr = explode('-', $lang);
            $flag = array_pop($arr);
        }
        /* addded by sangeeta */
        $lFname = Configure::read('Config.languages_full_name');
        if ($lang):
            if ($lang == 'en'):
                $lang = 'eng';
            else:
                $lang = 'fra';
            endif;
        endif;
        $language = $lFname[$lang];

        $result = $this->Html->image($options['basePath'] . $flag . '.png', array('class' => 'icon', 'title' => $language));

        if ($options['appendName'] === true) {
            $result .= $this->Html->tag('span', $this->getName($lang));
        }

        return $result;
    }

    /**
     * Returns all the available languages on the website
     * 
     * @param boolean $includeCurrent Whether or not the current language must be included in the result
     * @return array List of available language codes 
     */
    public function availableLanguages($includeCurrent = true, $realNames = false) {
        $languages = Configure::read('Config.languages');
        if (defined('DEFAULT_LANGUAGE') && false === array_search(DEFAULT_LANGUAGE, $languages)) {
            array_unshift($languages, DEFAULT_LANGUAGE);
        }

        if (!$includeCurrent && in_array(Configure::read('Config.language'), $languages)) {
            unset($languages[array_search(Configure::read('Config.language'), $languages)]);
        }

        if ($realNames) {
            $langs = $languages;
            $languages = array();
            foreach ($langs as $l) {
                $languages[] = $this->getName($l);
            }
        }
        return $languages;
    }

    /**
     * Returns the readable name of a language code
     *
     * @param string $code language three letters code
     * @return string language name
     */
    public function getName($code) {
        $langData = $this->_getCatalog()->catalog($code);
        return $langData['language'];
    }

    /**
     * Returns a L10n instance
     *
     * @return L10n instance
     */
    protected function _getCatalog() {
        if (empty($this->L10n)) {
            App::import('I18n', 'L10n');
            $this->L10n = new L10n();
        }
        return $this->L10n;
    }

}
