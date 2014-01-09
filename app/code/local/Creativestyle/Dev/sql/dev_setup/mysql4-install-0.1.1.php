<?php

$installer = $this;
$installer->startSetup();


Mage::app()->setCurrentStore(Mage_Core_Model_App::ADMIN_STORE_ID);

$html = '<div style="width: 800px; height: 230px; padding: 30px; text-align: center; font-size: 45px; font-family: Helvetica, Arial; margin: auto; margin-top: 100px; padding-top: 120px; background-color: #fff9e9; border: 1px solid #eee2be;">Sorry, this project is still in developement, please come back later!</div>';
$staticBlock = array(
    'title' => 'Access restricted [EN]',
    'identifier' => 'access-restricted',
    'content' => $html,
    'is_active' => 1,
    'stores' => array(0)
);

Mage::getModel('cms/block')->setData($staticBlock)->save();

$installer->endSetup();