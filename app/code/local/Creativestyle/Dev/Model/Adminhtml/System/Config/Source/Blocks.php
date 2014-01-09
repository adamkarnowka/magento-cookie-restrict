<?php
    class Creativestyle_Dev_Model_Adminhtml_System_Config_Source_Blocks
{
    protected $_options;

    public function toOptionArray()
    {
        if (!$this->_options) {
            $this->_options = Mage::getResourceModel('cms/block_collection')
            ->load()->toOptionArray();
        }
        return $this->_options;
}

}