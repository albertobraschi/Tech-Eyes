<?php
/**
 * @author 		Vladimir Popov
 * @copyright  	Copyright (c) 2013 Vladimir Popov
 */

class VladimirPopov_WebForms_Block_Results
	extends VladimirPopov_WebForms_Block_Webforms
	implements Mage_Widget_Block_Interface
{
	protected function _construct(){
		parent::_construct();
		$this->setData('results',1);
	}
}
  
?>
