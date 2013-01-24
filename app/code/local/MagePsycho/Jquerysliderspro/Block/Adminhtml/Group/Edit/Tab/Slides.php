<?php
/**
 * @category   MagePsycho
 * @package    MagePsycho_Jquerysliderspro
 * @author     magepsycho@gmail.com
 * @website    http://www.magepsycho.com
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class MagePsycho_Jquerysliderspro_Block_Adminhtml_Group_Edit_Tab_Slides extends Mage_Adminhtml_Block_Widget_Grid {
    public function __construct() {
        parent::__construct();
		$this->setId('slideTabGrid');
		$this->setDefaultSort('sort_order');
		$this->setDefaultDir('ASC');
		$this->setSaveParametersInSession(true);
		$this->setUseAjax(true);
    }

    protected function _prepareCollection() {
		$collection = Mage::getModel('jquerysliderspro/slide')->getCollection();
		if($this->getRequest()->getParam('id')) {
            $collection->addSliderGroupFilter($this->getRequest()->getParam('id'));
        } else {
            $collection->addSliderGroupFilter(-1);
        }
		$this->setCollection($collection);
		return parent::_prepareCollection();
    }

	protected function _prepareColumns() {
		$this->addColumn('slide_id', array(
			'header'    => Mage::helper('jquerysliderspro')->__('ID'),
			'align'     =>'right',
			'width'     => '50px',
			'index'     => 'slide_id',
		));

		$this->addColumn('imagefile', array(
			'header'    => Mage::helper('jquerysliderspro')->__('Image'),
			'align'	    => 'center',
			'filter'	=> false,
			'index'	    => 'imagefile',
			'width'     => '150px',
			'renderer'  => 'jquerysliderspro/adminhtml_slide_grid_renderer_image'
		));

		$this->addColumn('title', array(
			'header'    => Mage::helper('jquerysliderspro')->__('Title'),
			'align'     =>'left',
			'index'     => 'title',
		));

		$this->addColumn('content_type', array(
			'header'    => Mage::helper('jquerysliderspro')->__('Content Type'),
			'align'     => 'left',
			'width'     => '150px',
			'index'     => 'content_type',
			'type'      => 'options',
			'options'   => Mage::getSingleton('jquerysliderspro/system_config_source_slidecontent')->getOptionArray(),
		));

		$this->addColumn('sort_order', array(
			'header'    => Mage::helper('jquerysliderspro')->__('Sort Order'),
			'align'     =>'left',
			'width'     => '100px',
			'index'     => 'sort_order',
		));

		$this->addColumn('status', array(
			'header'    => Mage::helper('jquerysliderspro')->__('Status'),
			'align'     => 'left',
			'width'     => '100px',
			'index'     => 'status',
			'type'      => 'options',
			'options'   => Mage::getSingleton('jquerysliderspro/system_config_source_status')->getOptionArray(),
		));

		$this->addColumn('action',
			array(
				'header'    =>  Mage::helper('jquerysliderspro')->__('Action'),
				'width'     => '100',
				'type'      => 'action',
				'getter'    => 'getId',
				'actions'   => array(
					array(
						'caption'   => Mage::helper('jquerysliderspro')->__('Edit'),
						'url'       => array('base'=> '*/adminhtml_slide/edit', 'params' => array('group_id' => '-1')),
						'field'     => 'id'
					)
				),
				'filter'    => false,
				'sortable'  => false,
				'index'     => 'stores',
				'is_system' => true,
		));

        return parent::_prepareColumns();
    }

    public function getGridUrl() {
		return $this->getUrl('*/*/slides', array('_current'=>true));
    }

    public function getRowUrl($row)
	{
		return $this->getUrl('*/adminhtml_slide/edit', array('id' => $row->getId(), 'group_id' => $row->getGroupId()));
	}
}