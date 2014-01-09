<?php

class Creativestyle_Dev_IndexController extends Mage_Core_Controller_Front_Action{

    public function enableAction(){
        $hash = base64_decode(trim($this->getRequest()->getParam('hash')));

        if(empty($hash)||Mage::getModel('core/encryption')->decrypt($hash)!=Mage::getStoreConfig('dev/csoptions/key')){
            die('Wrong or empty hash!');
        }

        $cookie = Mage::getSingleton('core/cookie');
        $lifetime = 86400 * (int)Mage::getStoreConfig('dev/csoptions/cookie_lifetime');
        $cookie->set(Mage::getStoreConfig('dev/csoptions/cookie_name'), 'enabled', time()+$lifetime, '/');

        $this->_redirect('/');
    }

}