<?php

class Creativestyle_Dev_Block_Adminhtml_Notification extends Mage_Adminhtml_Block_Template
{
    public function isProtected(){
        return Mage::getStoreConfig('dev/csoptions/cookie_protection_enabled',  Mage::app()->getRequest()->getParam('store'));
    }
}