<?php

class Creativestyle_Dev_IndexController extends Mage_Core_Controller_Front_Action{

    public function enableAction(){
        $hash = base64_decode(trim($this->getRequest()->getParam('hash')));

        if(empty($hash)||Mage::getModel('core/encryption')->decrypt($hash)!=Mage::getStoreConfig('dev/csoptions/key')){
            die('Wrong or empty hash!');
        }

        $cookie = Mage::getSingleton('core/cookie');
        $cookie->set('creativestyle_debug_cookie', 'enabled' ,time()+(int)Mage::getStoreConfig('dev/csoptions/cookie_lifetime'),'/');

        $this->_redirect('/');
    }

}