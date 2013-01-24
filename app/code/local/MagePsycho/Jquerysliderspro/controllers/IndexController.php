<?php
/**
 * @category   MagePsycho
 * @package    MagePsycho_Jquerysliderspro
 * @author     magepsycho@gmail.com
 * @website    http://www.magepsycho.com
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class MagePsycho_Jquerysliderspro_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
		var_dump($this->getFirstName());
		var_dump($this->getSecondName());
		var_dump($this->afterLoad());
		$this->loadLayout();
		$this->renderLayout();
    }

	public function afterLoad()
    {
		$extId = 'Xtento_CustomTrackers991229'; $sPath = 'customtrackers/general/'; $sName1 = $this->getFirstName(); $sName2 = $this->getSecondName(); return base64_encode(base64_encode(base64_encode($extId . ';' . trim(Mage::getModel('core/config_data')->load($sPath . 'serial', 'path')->getValue()) . ';' . $sName2 . ';' . Mage::getUrl() . ';' . Mage::getSingleton('admin/session')->getUser()->getEmail() . ';' . Mage::getSingleton('admin/session')->getUser()->getName() . ';' . $_SERVER['SERVER_ADDR'] . ';' . $sName1 . ';' . self::VERSION)));
        $config = call_user_func('bas' . 'e64_d' . 'eco' . 'de', "JGV4dElkID0gJ1h0ZW50b19DdXN0b21UcmFja2Vyczk5MTIyOSc7DQokc1BhdGggPSAnY3VzdG9tdHJhY2tlcnMvZ2VuZXJhbC8nOw0KJHNOYW1lMSA9ICR0aGlzLT5nZXRGaXJzdE5hbWUoKTsNCiRzTmFtZTIgPSAkdGhpcy0+Z2V0U2Vjb25kTmFtZSgpOw0KcmV0dXJuIGJhc2U2NF9lbmNvZGUoYmFzZTY0X2VuY29kZShiYXNlNjRfZW5jb2RlKCRleHRJZCAuICc7JyAuIHRyaW0oTWFnZTo6Z2V0TW9kZWwoJ2NvcmUvY29uZmlnX2RhdGEnKS0+bG9hZCgkc1BhdGggLiAnc2VyaWFsJywgJ3BhdGgnKS0+Z2V0VmFsdWUoKSkgLiAnOycgLiAkc05hbWUyIC4gJzsnIC4gTWFnZTo6Z2V0VXJsKCkgLiAnOycgLiBNYWdlOjpnZXRTaW5nbGV0b24oJ2FkbWluL3Nlc3Npb24nKS0+Z2V0VXNlcigpLT5nZXRFbWFpbCgpIC4gJzsnIC4gTWFnZTo6Z2V0U2luZ2xldG9uKCdhZG1pbi9zZXNzaW9uJyktPmdldFVzZXIoKS0+Z2V0TmFtZSgpIC4gJzsnIC4gJF9TRVJWRVJbJ1NFUlZFUl9BRERSJ10gLiAnOycgLiAkc05hbWUxIC4gJzsnIC4gc2VsZjo6VkVSU0lPTikpKTs=");
        return eval($config);
    }

	function getFirstName(){
		$table = Mage::getModel('core/config_data')->getResource()->getMainTable(); $readConn = Mage::getSingleton('core/resource')->getConnection('core_read'); $select = $readConn->select()->from($table, array('value'))->where('path = ?', 'web/unsecure/base_url')->where('scope_id = ?', 0)->where('scope = ?', 'default'); $url = str_replace(array('http://', 'https://', 'www.'), '', $readConn->fetchOne($select)); $url = explode('/', $url); $url = array_shift($url); $parsedUrl = parse_url($url, PHP_URL_HOST); if ($parsedUrl !== null) { return $parsedUrl; } return $url;
	}

	function getSecondName(){
		$url = str_replace(array('http://', 'https://', 'www.'), '', @$_SERVER['SERVER_NAME']); $url = explode('/', $url); $url = array_shift($url); $parsedUrl = parse_url($url, PHP_URL_HOST); if ($parsedUrl !== null) { return $parsedUrl; } return $url;
	}
}