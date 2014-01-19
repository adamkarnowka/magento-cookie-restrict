<?php
class Creativestyle_Dev_Block_Adminhtml_Url extends Mage_Adminhtml_Block_Abstract  implements  Varien_Data_Form_Element_Renderer_Interface{

    public function __construct(){
        $this->setTemplate("creativestyle-dev/url.phtml");
    }

    /**Retuens HTML code for this element
     * @param Varien_Data_Form_Element_Abstract $element
     * @return mixed
     */

    public function render(Varien_Data_Form_Element_Abstract $element){
        return $this->toHtml();
    }

    /** Returns URL for personal guestpass which enables access to the site
     *  @return string URL for personal guestpass
     */

    public function getEnableUrl(){
        $storeCode = Mage::app()->getRequest()->getParam('store');

        $url = Mage::app()->getStore($storeCode)->getUrl('creativestyle-dev/index/enable', array('hash'=>base64_encode(Mage::getModel('core/encryption')->encrypt(Mage::getStoreConfig('dev/csoptions/key', $storeCode)))));
        return $url;
    }
}