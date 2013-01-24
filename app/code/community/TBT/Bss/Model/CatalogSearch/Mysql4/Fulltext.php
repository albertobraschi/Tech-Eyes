<?php
/**
 * NOTICE OF LICENSE
 * This source file is subject to the BETTER STORE SEARCH
 * License, which is available at this URL: http://www.betterstoresearch.com/docs/bss_license.txt
 *
 * DISCLAIMER
 * By adding to, editing, or in any way modifying this code, WDCA is not held liable for any inconsistencies or abnormalities in the
 * behaviour of this code. By adding to, editing, or in any way modifying this code, the Licensee terminates any agreement of support
 * offered by WDCA, outlined in the provided Sweet Tooth License.  Upon discovery of modified code in the process of support, the Licensee
 * is still held accountable for any and all billable time WDCA spent  during the support process.
 * WDCA does not guarantee compatibility with any other framework extension. WDCA is not responsbile for any inconsistencies or abnormalities in the
 * behaviour of this code if caused by other framework extension. If you did not receive a copy of the license, please send an email to
 * contact@wdca.ca or call 1-888-699-WDCA(9322), so we can send you a copy immediately.
 *
 * @category   [TBT]
 * @package    [TBT_Bss]
 * @copyright  Copyright (c) 2012 WDCA (http://www.wdca.ca)
 * @license    http://www.betterstoresearch.com/docs/bss_license.txt
 */
class TBT_Bss_Model_CatalogSearch_Mysql4_Fulltext extends Mage_CatalogSearch_Model_Mysql4_Fulltext
{
    /**
     * Prepare results for query
     *
     * @param Mage_CatalogSearch_Model_Fulltext $object
     * @param string $queryText
     * @param Mage_CatalogSearch_Model_Query $query
     *
     * @return TBT_Bss_Model_CatalogSearch_Mysql4_Fulltext
     */
    public function prepareResult($object, $queryText, $query)
    {
        if (! Mage::helper('bss/version')->isBaseMageVersionAtLeast('1.4.2.0')) {
            $this->_prepareResultPrior142($object, $queryText, $query);
        } elseif (! Mage::helper('bss/version')->isBaseMageVersionAtLeast('1.6.0.0')) {
            $this->_prepareResultPrior16($object, $queryText, $query);
        } else {
            $this->_prepareResult16($object, $queryText, $query);
        }

        return $this;
    }

    /**
     * This is for Magento versions prior to 1.4.2.0
     *
     * @param $object
     * @param $queryText
     * @param $query
     *
     * @return TBT_Bss_Model_CatalogSearch_Mysql4_Fulltext
     */
    protected function _prepareResultPrior142($object, $queryText, $query)
    {
        if (!$query->getIsProcessed()) {
            $searchType = $object->getSearchType($query->getStoreId());

            $stringHelper = Mage::helper('core/string');
            /* @var $stringHelper Mage_Core_Helper_String */

            $bind = array(
                ':query'     => $queryText
            );
            $like = array();

            $fulltextCond   = '';
            $likeCond       = '';
            $separateCond   = '';

            if ($searchType == Mage_CatalogSearch_Model_Fulltext::SEARCH_TYPE_LIKE
                || $searchType == Mage_CatalogSearch_Model_Fulltext::SEARCH_TYPE_COMBINE) {
                $words = $stringHelper->splitWords($queryText, true, $query->getMaxQueryWords());
                $likeI = 0;
                foreach ($words as $word) {
                    $like[] = '`s`.`data_index` LIKE :likew' . $likeI;
                    $bind[':likew' . $likeI] = '%' . $word . '%';
                    $likeI ++;
                }
                if ($like) {
                    $searchMode = Mage::getStoreConfig(TBT_Bss_Model_Fulltext::XML_PATH_BSS_SEARCH_MODE);
                    $join = ($searchMode == 1) ? ' OR ' : ' AND ';
                    $likeCond = '(' . join($join, $like) . ')';
                }
            }
            if ($searchType == Mage_CatalogSearch_Model_Fulltext::SEARCH_TYPE_FULLTEXT
                || $searchType == Mage_CatalogSearch_Model_Fulltext::SEARCH_TYPE_COMBINE) {
                $fulltextCond = 'MATCH (`s`.`data_index`) AGAINST (:query IN BOOLEAN MODE)';
            }
            if ($searchType == Mage_CatalogSearch_Model_Fulltext::SEARCH_TYPE_COMBINE && $likeCond) {
                $separateCond = ' OR ';
            }

            $sql = sprintf("INSERT INTO `{$this->getTable('catalogsearch/result')}` "
                    . "(SELECT '%d', `s`.`product_id`, MATCH (`s`.`data_index`) AGAINST (:query IN BOOLEAN MODE) "
                    . "FROM `{$this->getMainTable()}` AS `s` INNER JOIN `{$this->getTable('catalog/product')}` AS `e`"
                    . "ON `e`.`entity_id`=`s`.`product_id` WHERE (%s%s%s) AND `s`.`store_id`='%d')"
                    . " ON DUPLICATE KEY UPDATE `relevance`=VALUES(`relevance`)",
                $query->getId(),
                $fulltextCond,
                $separateCond,
                $likeCond,
                $query->getStoreId()
            );

            $this->_getWriteAdapter()->query($sql, $bind);

            $query->setIsProcessed(1);
        }

        return $this;
    }

    /**
     * This is for Magento versions prior to 1.6.0.0
     *
     * @param $object
     * @param $queryText
     * @param $query
     *
     * @return TBT_Bss_Model_CatalogSearch_Mysql4_Fulltext
     */
    protected function _prepareResultPrior16($object, $queryText, $query)
    {
        if (!$query->getIsProcessed()) {
            $searchType = $object->getSearchType($query->getStoreId());

            $stringHelper = Mage::helper('core/string');
            /* @var $stringHelper Mage_Core_Helper_String */

            $bind = array(
                ':query' => $queryText
            );
            $like = array();

            $fulltextCond   = '';
            $likeCond       = '';
            $separateCond   = '';

            if ($searchType == Mage_CatalogSearch_Model_Fulltext::SEARCH_TYPE_LIKE
                || $searchType == Mage_CatalogSearch_Model_Fulltext::SEARCH_TYPE_COMBINE) {
                $words = $stringHelper->splitWords($queryText, true, $query->getMaxQueryWords());
                $likeI = 0;
                foreach ($words as $word) {
                    $like[] = '`s`.`data_index` LIKE :likew' . $likeI;
                    $bind[':likew' . $likeI] = '%' . $word . '%';
                    $likeI ++;
                }
                if ($like) {
                    $searchMode = Mage::getStoreConfig(TBT_Bss_Model_Fulltext::XML_PATH_BSS_SEARCH_MODE);
                    $join = ($searchMode == 1) ? ' OR ' : ' AND ';
                    $likeCond = '(' . join($join, $like) . ')';
                }
            }
            if ($searchType == Mage_CatalogSearch_Model_Fulltext::SEARCH_TYPE_FULLTEXT
                || $searchType == Mage_CatalogSearch_Model_Fulltext::SEARCH_TYPE_COMBINE) {
                $fulltextCond = 'MATCH (`s`.`data_index`) AGAINST (:query IN BOOLEAN MODE)';
            }
            if ($searchType == Mage_CatalogSearch_Model_Fulltext::SEARCH_TYPE_COMBINE && $likeCond) {
                $separateCond = ' OR ';
            }

            $sql = sprintf("INSERT INTO `{$this->getTable('catalogsearch/result')}` "
                    . "(SELECT STRAIGHT_JOIN '%d', `s`.`product_id`, MATCH (`s`.`data_index`) "
                    . "AGAINST (:query IN BOOLEAN MODE) FROM `{$this->getMainTable()}` AS `s` "
                    . "INNER JOIN `{$this->getTable('catalog/product')}` AS `e` "
                    . "ON `e`.`entity_id`=`s`.`product_id` WHERE (%s%s%s) AND `s`.`store_id`='%d')"
                    . " ON DUPLICATE KEY UPDATE `relevance`=VALUES(`relevance`)",
                $query->getId(),
                $fulltextCond,
                $separateCond,
                $likeCond,
                $query->getStoreId()
            );

            $this->_getWriteAdapter()->query($sql, $bind);

            $query->setIsProcessed(1);
        }

        return $this;
    }

    /**
     * This is used for Magento versions >= 1.6.0.0
     *
     * @param $object
     * @param $queryText
     * @param $query
     *
     * @return TBT_Bss_Model_CatalogSearch_Mysql4_Fulltext
     */
    protected function _prepareResult16($object, $queryText, $query)
    {
        $adapter = $this->_getWriteAdapter();
        if (!$query->getIsProcessed()) {
            $searchType = $object->getSearchType($query->getStoreId());

            $preparedTerms = Mage::getResourceHelper('catalogsearch')
                ->prepareTerms($queryText, $query->getMaxQueryWords());

            $bind = array();
            $like = array();
            $likeCond  = '';
            if ($searchType == Mage_CatalogSearch_Model_Fulltext::SEARCH_TYPE_LIKE
                || $searchType == Mage_CatalogSearch_Model_Fulltext::SEARCH_TYPE_COMBINE) {
                $helper = Mage::getResourceHelper('core');
                $words = Mage::helper('core/string')->splitWords($queryText, true, $query->getMaxQueryWords());
                foreach ($words as $word) {
                    $like[] = $helper->getCILike('s.data_index', $word, array('position' => 'any'));
                }
                if ($like) {
                    $searchMode = Mage::getStoreConfig(TBT_Bss_Model_Fulltext::XML_PATH_BSS_SEARCH_MODE);
                    $join = ($searchMode == 1) ? ' OR ' : ' AND ';
                    $likeCond = '(' . join($join, $like) . ')';
                }
            }
            $mainTableAlias = 's';
            $fields = array(
                'query_id' => new Zend_Db_Expr($query->getId()),
                'product_id',
            );
            $select = $adapter->select()
                ->from(array($mainTableAlias => $this->getMainTable()), $fields)
                ->joinInner(array('e' => $this->getTable('catalog/product')),
                'e.entity_id = s.product_id',
                array())
                ->where($mainTableAlias.'.store_id = ?', (int)$query->getStoreId());

            if ($searchType == Mage_CatalogSearch_Model_Fulltext::SEARCH_TYPE_FULLTEXT
                || $searchType == Mage_CatalogSearch_Model_Fulltext::SEARCH_TYPE_COMBINE) {
                $bind[':query'] = implode(' ', $preparedTerms[0]);
                $where = Mage::getResourceHelper('catalogsearch')
                    ->chooseFulltext($this->getMainTable(), $mainTableAlias, $select);
            }
            if ($likeCond!=''
                && $searchType == Mage_CatalogSearch_Model_Fulltext::SEARCH_TYPE_COMBINE) {
                $where .= ($where ? ' OR ' : '') . $likeCond;
            }
            if ($likeCond!='' && $searchType == Mage_CatalogSearch_Model_Fulltext::SEARCH_TYPE_LIKE) {
                $select->columns(array('relevance'  => new Zend_Db_Expr(0)));
                $where = $likeCond;
            }
            if ($where != '') {
                $select->where($where);
            }

            $sql = $adapter->insertFromSelect($select,
                $this->getTable('catalogsearch/result'),
                array(),
                Varien_Db_Adapter_Interface::INSERT_ON_DUPLICATE);
            $adapter->query($sql, $bind);

            $query->setIsProcessed(1);
        }

        return $this;
    }
}