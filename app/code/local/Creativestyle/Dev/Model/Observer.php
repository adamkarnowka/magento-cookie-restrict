<?php
class Creativestyle_Dev_Model_Observer extends Mage_Core_Model_Observer {

    /** Function which checks whether resitriction is enabled and verifies cookie presence
     *  @return $this
     */
    public function checkCookie(){
        $module = Mage::app()->getRequest()->getModuleName();
        $controller = Mage::app()->getRequest()->getControllerName();
        $action = Mage::app()->getRequest()->getActionName();
        $route = Mage::app()->getRequest()->getRouteName();

        if($module=='creativestyle-dev'&&$controller=='index'&&$action=='enable'){
            return $this;
        }

        $protectionEnabled = Mage::getStoreConfig('dev/csoptions/cookie_protection_enabled');

        if(!$protectionEnabled || Mage::app()->getStore()->isAdmin()){
            return $this;
        }

        $whiteListedIps = Mage::getStoreConfig('dev/csoptions/whitelist');
        try{
            if($whiteListedIps&&!empty($whiteListedIps)){
                $whiteListedIps = unserialize($whiteListedIps);
            }
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
            $blockId = Mage::getStoreConfig('dev/csoptions/blockid');
            if(!empty($blockId)){
                echo Mage::app()->getLayout()->createBlock('cms/block')->setBlockId($blockId)->toHtml();
            } else {
                die('Store is currently offline.');
            }
           die();
        }
    }
}