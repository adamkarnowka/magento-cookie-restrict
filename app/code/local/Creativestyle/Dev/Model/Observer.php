<?php

class Creativestyle_Dev_Model_Observer extends Mage_Core_Model_Observer {
    public function checkCookie(){
        $protectionEnabled = Mage::getStoreConfig('dev/csoptions/cookie_protection_enabled');

        if(!$protectionEnabled || Mage::app()->getStore()->isAdmin()){
            return $this;
        }

        $cookie = Mage::getModel('core/cookie')->get('creativestyle_debug_cookie');
        if($cookie=='enabled'){
             return $this;
        } else {

            die('Restricted area!');
        }

    }


}