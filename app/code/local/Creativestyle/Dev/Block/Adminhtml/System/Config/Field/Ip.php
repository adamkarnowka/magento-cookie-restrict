<?php

class Creativestyle_Dev_Block_Adminhtml_System_Config_Field_Ip extends Mage_Adminhtml_Block_System_Config_Form_Field_Array_Abstract
{
    protected $magentoAttributes;


    public function __construct()
    {
        $this->addColumn('ip', array(
            'label' => Mage::helper('adminhtml')->__('IP Address'),
            'size'  => 3,
        ));

        $this->addColumn('comment', array(
            'label' => Mage::helper('adminhtml')->__('Comment (optional)'),
            'size'  => 3,
        ));

        $this->_addAfter = false;
        $this->_addButtonLabel = Mage::helper('adminhtml')->__('Add new IP');

        parent::__construct();
        $this->setTemplate('creativestyle-dev/ip_select.phtml');
    }

    protected function _renderCellTemplate($columnName)
    {
        if (empty($this->_columns[$columnName])) {
            throw new Exception('Wrong column name specified.');
        }
        $column     = $this->_columns[$columnName];
        $inputName  = $this->getElement()->getName() . '[#{_id}][' . $columnName . ']';



        if($columnName == 'ip')
        {
            $rendered = '<input name="'.$inputName.'" type="input" />';

        }
        else if($columnName == 'comment')
        {
            $rendered = '<input name="'.$inputName.'" type="input" />';

        }
        else {
            $rendered = '';
        }


        return $rendered;
    }
}
?>