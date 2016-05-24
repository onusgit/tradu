<?php

class AppHelper extends Helper {

    public function url($url = null, $full = false) {
        if (is_array($url) && !array_key_exists('lang', $url)) {
            $url['lang'] = Configure::read('Config.language');
        }
        return parent::url($url, $full);
    }

}

?>