<?php
/**
 * @category   MagePsycho
 * @package    MagePsycho_Jquerysliderspro
 * @author     magepsycho@gmail.com
 * @website    http://www.magepsycho.com
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class MagePsycho_Jquerysliderspro_Block_Adminhtml_Slide_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
	public function __construct()
	{
		parent::__construct();
		$this->setId('slideGrid');
		$this->setDefaultSort('slide_id');
		$this->setDefaultDir('ASC');
		$this->setSaveParametersInSession(true);
	}

	protected function _prepareCollection()
	{
		$collection = Mage::getModel('jquerysliderspro/slide')->getCollection();
		$this->setCollection($collection);
		return parent::_prepareCollection();
	}

	protected function _prepareColumns()
	{
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

		$this->addColumn('group_id', array(
			'header'    => Mage::helper('jquerysliderspro')->__('Group'),
			'align'     => 'left',
			'width'     => '150px',
			'index'     => 'group_id',
			'type'      => 'options',
			'options'   => Mage::getSingleton('jquerysliderspro/system_config_source_group')->getOptionArray(),
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
						'url'       => array('base'=> '*/*/edit'),
						'field'     => 'id'
					)
				),
				'filter'    => false,
				'sortable'  => false,
				'index'     => 'stores',
				'is_system' => true,
		));

		$this->addExportType('*/*/exportCsv', Mage::helper('jquerysliderspro')->__('CSV'));
		$this->addExportType('*/*/exportXml', Mage::helper('jquerysliderspro')->__('XML'));

		return parent::_prepareColumns();
	}

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('slide_id');
        $this->getMassactionBlock()->setFormFieldName('slide');

        $this->getMassactionBlock()->addItem('delete', array(
             'label'    => Mage::helper('jquerysliderspro')->__('Delete'),
             'url'      => $this->getUrl('*/*/massDelete'),
             'confirm'  => Mage::helper('jquerysliderspro')->__('Are you sure?')
        ));

        $statuses = Mage::getSingleton('jquerysliderspro/system_config_source_status')->getOptionArray();

        array_unshift($statuses, array('label'=>'', 'value'=>''));
        $this->getMassactionBlock()->addItem('status', array(
             'label'=> Mage::helper('jquerysliderspro')->__('Change status'),
             'url'  => $this->getUrl('*/*/massStatus', array('_current'=>true)),
             'additional' => array(
                    'visibility' => array(
                         'name' => 'status',
                         'type' => 'select',
                         'class' => 'required-entry',
                         'label' => Mage::helper('jquerysliderspro')->__('Status'),
                         'values' => $statuses
                     )
             )
        ));
        return $this;
    }

	public function getRowUrl($row)
	{
		return $this->getUrl('*/*/edit', array('id' => $row->getId()));
	}
}