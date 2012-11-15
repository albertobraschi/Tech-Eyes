<?php
/**
 * @category   MagePsycho
 * @package    MagePsycho_Jquerysliderspro
 * @author     magepsycho@gmail.com
 * @website    http://www.magepsycho.com
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class MagePsycho_Jquerysliderspro_Helper_Data extends Mage_Core_Helper_Abstract
{
	public function getConfig($field, $section = 'option', $default = null){
        $value = Mage::getStoreConfig('jquerysliderspro/' .$section .  '/' . $field);
        if(!isset($value) or trim($value) == ''){
            return $default;
        }else{
            return $value;
        }
    }

    public function log($data){
		if(!$this->getConfig('enable_log')){
			return;
		}
        if(is_array($data) || is_object($data)){
            $data = print_r($data, true);
        }
        Mage::log($data, null, 'jquerysliderspro.log');
    }

	public function checkVersion($version, $operator = '>='){
		return version_compare(Mage::getVersion(), $version, $operator);
	}

	function __construct() {
		$field	= base64_decode('ZG9tYWluX3R5cGU=');
		if($this->getConfig($field) == 1){
			$key		= base64_decode('cHJvZF9saWNlbnNl');
			$this->mode	= base64_decode('cHJvZHVjdGlvbg==');
		}else{
			$key		= base64_decode('ZGV2X2xpY2Vuc2U=');
			$this->mode	= base64_decode('ZGV2ZWxvcG1lbnQ=');
		}
        $this->temp = $this->getConfig($key);
    }

	public function getMessage(){
		$message = base64_decode('WW91IGFyZSB1c2luZyB1bmxpY2Vuc2VkIHZlcnNpb24gb2YgJ2pRdWVyeSBTbGlkZXJzIFBybycgRXh0ZW5zaW9uIGZvciBkb21haW46IHt7RE9NQUlOfX0uIFBsZWFzZSBlbnRlciBhIHZhbGlkIExpY2Vuc2UgS2V5IGZyb20gU3lzdGVtICZyYXF1bzsgQ29uZmlndXJhdGlvbiAmcmFxdW87IE1hZ2VQc3ljaG8gRXh0ZW5zaW9ucyAmcmFxdW87IGpRdWVyeSBTbGlkZXJzIFBybyAmcmFxdW87IExpY2Vuc2UgS2V5LiBJZiB5b3UgZG9uJ3QgaGF2ZSBvbmUsIHBsZWFzZSBwdXJjaGFzZSBhIHZhbGlkIGxpY2Vuc2UgZnJvbSA8YSBocmVmPSJodHRwOi8vd3d3Lm1hZ2Vwc3ljaG8uY29tIiB0YXJnZXQ9Il9ibGFuayI+d3d3Lm1hZ2Vwc3ljaG8uY29tPC9hPiBvciB5b3UgY2FuIGRpcmVjdGx5IGVtYWlsIHRvIDxhIGhyZWY9Im1haWx0bzppbmZvQG1hZ2Vwc3ljaG8uY29tIj5pbmZvQG1hZ2Vwc3ljaG8uY29tPC9hPg==');
		$message = str_replace('{{DOMAIN}}', $this->getDomain(), $message);
		return $message;
	}

	public function getDomain() {
        $domain		= Mage::getBaseUrl();
        $baseDomain = Mage::helper('jquerysliderspro/url')->getBaseDomain($domain);
		return $baseDomain;
    }

    public function checkEntry($domain, $serial){
        $salt = sha1(base64_decode('anF1ZXJ5c2xpZGVyc3Bybw=='));
        if(sha1($salt . $domain . $this->mode) == $serial) {
            return true;
        }
        return false;
    }

    public function isValid(){
        $temp = $this->temp;
        if(!$this->checkEntry($this->getDomain(), $temp)) {
            return false;
        }
        return true;
    }

	public function isActive(){
		return (bool) $this->getConfig('active');
	}

	public function getResizedUrl($imageUrl, $x, $y = null){
		$imgPath			= $this->splitImageValue($imageUrl, "path");
		$imgName			= $this->splitImageValue($imageUrl, "name");
		$imgPath			= str_replace("/", DS, $imgPath);
		$imgPathFull		= Mage::getBaseDir("media") . DS . $imgPath . DS . $imgName;

		$width				= $x;
		$height				= $y ? $y : $x;
		$resizedFolder		= $width . "X" . $height;
		$imageResizedPath	= Mage::getBaseDir("media") . DS . $imgPath . DS . $resizedFolder . DS . $imgName;

		if (!file_exists($imageResizedPath) && file_exists($imgPathFull)){
			$imageObj = new Varien_Image($imgPathFull);
			$imageObj->constrainOnly(true);
			$imageObj->keepAspectRatio(true);
			$imageObj->keepFrame(false);
			$imageObj->keepTransparency(true);
			$imageObj->setImageBackgroundColor(false);
			$imageObj->backgroundColor(false);
			$imageObj->quality(100);
			$imageObj->resize($width,$height);
			$imageObj->save($imageResizedPath);
		}

		$imageUrl			= str_replace(DS , "/", $imgPath);
		return Mage::getBaseUrl("media") . $imageUrl . "/" . $resizedFolder . "/" . $imgName;
	}

	public function splitImageValue($imageValue, $attr = "name"){
		$imageArray		= explode("/", $imageValue);
		$name			= $imageArray[count($imageArray) - 1];
		$path			= implode("/", array_diff($imageArray, array($name)));
		if($attr == "path"){
			return $path;
		}else{
			return $name;
		}
	}

	public function getFolders($dir){
		$dirs = array();
		if($dh = opendir($dir)){
			while(false !== ($file = readdir($dh))){
				// Ignore hidden files
				if(!preg_match("/^\./", $file)){
					if(is_dir($dir . '/' . $file)){
						$dirs[$file] = ($file);
					}
				}
			}
		}
		closedir($dh);
		return $dirs;
	}

	public function getDefaultSliderSettings($sliderCode){
		$sliderConfig		= Mage::getConfig()->getNode('default/jquerysliderspro/'.$sliderCode);
		$sliderConfigArray	= (array)$sliderConfig;
		return $sliderConfigArray;
	}

	public function getSystemSliderSettings($sliderCode){
		$sliderConfig		= Mage::getStoreConfig('jquerysliderspro/'.$sliderCode);
		$sliderConfigArray	= (array)$sliderConfig;
		return $sliderConfigArray;
	}

	public function slugify($str, $exclude = '.', $separator = 'dash'){
		if ($separator == 'dash'){
			$search		= '_';
			$replace	= '-';
		}else{
			$search		= '-';
			$replace	= '_';
		}

		$trans = array(
						$search								=> $replace,
						"\s+"								=> $replace,
						"[^a-z".$exclude."0-9".$replace."]"				=> '',
						$replace."+"						=> $replace,
						$replace."$"						=> '',
						"^".$replace						=> ''
					   );

		$str = strip_tags(strtolower($str));

		foreach ($trans as $key => $val){
			$str = preg_replace("#".$key."#", $val, $str);
		}

		return trim(stripslashes($str));
	}

	public function getSliderDir($dir = null){
		return Mage::getBaseDir('base') . DS . 'js' . DS . 'jquerysliderspro' . DS . $dir;
	}


	public function getSliderUrl($path = null){
		if(!empty($path)){
			$path .= '/' . $path;
		}
        return Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_JS) . 'jquerysliderspro' . $path;
    }

	public function getLinkUrl($url){
		if(strpos($url, '{{base_url}}') !== false){ //Internal
			$url = trim( str_replace('{{base_url}}', rtrim(Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_WEB), '/'), $url), '/');
		} else { //External
			$url = trim($url, '/');
		}
		return $url;
	}
}