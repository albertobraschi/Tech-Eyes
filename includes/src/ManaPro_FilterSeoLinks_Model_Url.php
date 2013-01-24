<?php
/**
 * @category    Mana
 * @package     ManaPro_FilterSeoLinks
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

/**
 * Rewrite of Mage_Core_Model_Url which makes product list pager, store view switcher and layered navigation links
 * SEO firendly.
 * @author Mana Team
 *
 */
class ManaPro_FilterSeoLinks_Model_Url extends Mage_Core_Model_Url {
    public function getUrl($routePath=null, $routeParams=null) {
		return $this->encodeUrl($routePath, parent::getUrl($routePath, $routeParams));
		
    }
    public function encodeUrl($routePath, $result) {
		$request = Mage::app()->getRequest();
		$routePath = explode('/', $routePath);
		if (isset($routePath[0]) && $routePath[0] == '*') $routePath[0] = $request->getRouteName();
		if (isset($routePath[1]) && $routePath[1] == '*') $routePath[1] = $request->getControllerName();
		if (isset($routePath[2]) && $routePath[2] == '*') $routePath[2] = $request->getActionName();
		$routePath = $routePath[0].(isset($routePath[1]) ? '/'.$routePath[1] : '').(isset($routePath[2]) ? '/'.$routePath[2] : '');
		$currentPath = $request->getRouteName().'/'.$request->getControllerName().'/'.$request->getActionName();
		if ($routePath == 'catalog/category/view' || $routePath == 'manapro_filterajax/category/view') {
		    $this->_encodeUrl($routePath, $result);
		}
		elseif ($routePath == 'cms/index/index' || $routePath == 'manapro_filterajax/index/index') {
		    $this->_encodeUrl($routePath, $result, array(
		        'handleCategorySuffix' => false,
		    ));
		}
        elseif ($routePath == 'cms/page/view' || $routePath == 'manapro_filterajax/page/view') {
            $this->_encodeUrl($routePath, $result, array(
		        'handleCategorySuffix' => false,
		    ));
        }
		return $result;
    }
    protected function _encodeUrl($routePath, &$result, $options = array()) {
        $options = array_merge(array(
            'handleCategorySuffix' => true,
        ), $options);

        $parts = parse_url(str_replace('&amp;', '&', $result));

        /* @var $core Mana_Core_Helper_Data */ $core = Mage::helper(strtolower('Mana_Core'));
        /* @var $resource ManaPro_FilterSeoLinks_Resource_Rewrite */ $resource = Mage::getResourceSingleton('manapro_filterseolinks/rewrite');
        $conditionalWord = $core->getStoreConfig('mana_filters/seo/conditional_word');
        $categorySuffix = $options['handleCategorySuffix'] ? Mage::helper('catalog/category')->getCategoryUrlSuffix() : '';
        $showAllSuffix = $core->getStoreConfig('mana_filters/seo/show_all_suffix');
        if ($showAllSuffix) $showAllSeoSuffix = $showAllSuffix;
        $vars = Mage::helper('manapro_filterseolinks')->getUrlVars();

        $path = $parts['scheme'].'://'.$parts['host'].(isset($parts['port']) ? ':'.$parts['port'] : '').$parts['path'];
        $result = '';
        foreach (Mage::app()->getStores() as /* @var $store Mage_Core_Model_Store */ $store) {
            $baseUrl = $store->getBaseUrl(Mage_Core_Model_Store::URL_TYPE_LINK, strtolower($parts['scheme']) == 'https');
            if ($core->startsWith($path, $baseUrl)) {
                $result = $baseUrl;
                break;
            }
        }
        if (!$result) throw new Exception('Not implemented');
        $path = substr($path, strlen($result));

        if ($categorySuffix) {
            if ($core->endsWith($path, $categorySuffix)) {
                $path = substr($path, 0, strlen($path) - strlen($categorySuffix));
                $categorySuffixSubtracted = true;
            }
            else {
                $categorySuffixSubtracted = false;
            }
        }
        $result .= $path;
        $leftQuery = '';
        if (isset($parts['query'])) {
            $query = array();
            parse_str($parts['query'], $query);
            $seoQuery = '';
            foreach ($query as $key => $value) {
                if ($showAllSuffix && strrpos($key, $showAllSuffix) === strlen($key) - strlen($showAllSuffix)) {
                    if ($value == 1) {
                        $filterCode = $core->hyphenCased(substr($key, 0, strlen($key) - strlen($showAllSuffix)));
                        if ($filterCode == 'cat') {
                            $filterCode = 'category';
                        }
                        $seoQuery .= '/'.$filterCode.$showAllSeoSuffix;
                    }
                }
                else {
                    if ($key == 'cat') {
                        $seoQuery .= '/category/';
                        $valueLabel = array();
                        foreach (explode('_', $value) as $valueFragment) {
                            $valueLabel[] = $resource->getCategoryLabel($valueFragment);
                        }
                        $seoQuery .= implode('_', $valueLabel);
                    }
                    elseif(isset($vars[$key])) {
                        $seoQuery .= '/'.$vars[$key].'/'.$value;
                    }
                    elseif ($resource->isFilterName($key)) {
                        $seoQuery .= '/'.$core->hyphenCased($key).'/';
                        $valueLabel = array();
                        foreach (explode('_', $value) as $valueFragment) {
                            $valueLabel[] = $resource->getFilterValueLabel($key, $valueFragment);
                        }
                        $seoQuery .= implode('_', $valueLabel);
                    }
                    else {
                        if ($leftQuery) $leftQuery .= '&';//'&amp;';
                        $leftQuery .= $key . '=' . $value;
                    }
                }
            }
            if ($seoQuery) {
                if (!$core->endsWith($result, '/')) {
                    $result .= '/';
                }
                $result .= $conditionalWord.$seoQuery;
            }
        }
        if ($categorySuffix) $result .= $categorySuffix;
        if ($leftQuery) $result .= '?' . $leftQuery;
    }
}