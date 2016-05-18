<?php

App::uses('AppModel', 'Model');

class Restaurents extends AppModel {
    var $validate = array(
        'name' => array(
                'notEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'test',
                ),
            ),
    );
    function RestaurentValidate() {
        $validate1 = array(
            'name' => array(
                'notEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => __('Restaurent name must not be empty.'),
                ),
            ),
            'address' => array(
                'notEmpty' => array(
                    'rule' => 'notEmpty',
                'message' => __('Restaurent address must not be empty.'),
                ),
            ),
//            'zipcode' => array(
//                'required' => true,
//                'message' => __('Restaurent zipcode must not be empty.'),
//            ),
//            'country' => array(
//                'required' => true,
//                'message' => __('Restaurent country must be selected.'),
//            ),
//            'phone' => array(
//                'required' => true,
//                'message' => __('Restaurent phone must not be empty.'),
//            ),
//            'email' => array(
//                'required' => true,
//                'message' => __('Restaurent email must not be empty.'),
//            ),
        );
        $this->validate = $validate1;
        return $this->validates();
    }

}
