<?php


class Creativestyle_Dev_Block_Adminhtml_Url extends Mage_Adminhtml_Block_Abstract  implements  Varien_Data_Form_Element_Renderer_Interface{

    public function __construct(){
        $this->setTemplate("creativestyle-dev/url.phtml");
    }

    public function render(Varien_Data_Form_Element_Abstract $element){
        return $this->toHtml();
    }

    public function getEnableUrl(){
        $url = Mage::getUrl('creativestyle-dev/index/enable', array('hash'=>base64_encode(Mage::getModel('core/encryption')->encrypt(Mage::getStoreConfig('dev/csoptions/key')))));
        return $url;
    }

}