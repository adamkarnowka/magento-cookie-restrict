<?php

class Creativestyle_Dev_Model_Observer extends Mage_Core_Model_Observer {
    public function checkCookie(){
        $protectionEnabled = Mage::getStoreConfig('dev/csoptions/cookie_protection_enabled');

        if(!$protectionEnabled || Mage::app()->getStore()->isAdmin()){
            return $this;
        }

        $whiteListedIps = Mage::getStoreConfig('dev/csoptions/whitelist');
        try{
            $whiteListedIps = unserialize($whiteListedIps);
        } catch (Exception $e){
            // Be quiet :)
        }

        foreach($whiteListedIps as $ip){
            if($ip['ip']==$_SERVER['REMOTE_ADDR']){
                // When current remote-addr exists in whitelist, we allow traffic
                // TODO: Add checking of ranges, like 200.100.10.*
                return $this;
            }
        }

        $cookie = Mage::getModel('core/cookie')->get(Mage::getStoreConfig('dev/csoptions/cookie_name'));
        if($cookie=='enabled'){
             return $this;
        } else {
            echo $_SERVER['REMOTE_ADDR'];
            die('Restricted area!');
        }
    }
}