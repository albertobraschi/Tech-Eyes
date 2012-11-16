<?php
/**
 * @category   MagePsycho
 * @package    MagePsycho_Jquerysliderspro
 * @author     magepsycho@gmail.com
 * @website    http://www.magepsycho.com
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class MagePsycho_Jquerysliderspro_Adminhtml_GroupController extends Mage_Adminhtml_Controller_action
{
	protected function _initAction() {
		$this->_title($this->__('Manage Group'))
             ->_title($this->__('jQuery Sliders'));
		$this->loadLayout()
			 ->_setActiveMenu('jquerysliderspro/group')
			 ->_addBreadcrumb(Mage::helper('adminhtml')->__('Manage Group'), Mage::helper('adminhtml')->__('Manage Group'));

		return $this;
	}

	public function indexAction() {
		$this->_initAction()
			 ->renderLayout();
	}

	public function editAction() {
		$helper = Mage::helper('jquerysliderspro');
		$id     = $this->getRequest()->getParam('id');
		$model  = Mage::getModel('jquerysliderspro/group')->load($id);

		if ($model->getId() || $id == 0) {
			$data = Mage::getSingleton('adminhtml/session')->getFormData(true);
			if (!empty($data)) {
				$model->setData($data);
			}

			# Setting Default Slider Settings
			if(empty($data) && !$model->getId()){
				$sliderTypes = Mage::getSingleton('jquerysliderspro/system_config_source_slidertype')->getOptionArray();
				foreach($sliderTypes as $_sliderCode => $_sliderLabel){
					$model->setData($helper->getDefaultSliderSettings($_sliderCode));
				}
			}

			# Tweaking Slider Settings to fit for form field
			$sliderType = $model->getSliderType();
			$dbSettings = $model->getSliderSettings();
			$sliderSettingsAsArray = unserialize($dbSettings);
			if(!empty($sliderSettingsAsArray)){
				$model->addData($sliderSettingsAsArray);
			}

			Mage::register('group_data', $model);

			$this->_initAction();
			$this->_addContent($this->getLayout()->createBlock('jquerysliderspro/adminhtml_group_edit'))
				 ->_addLeft($this->getLayout()->createBlock('jquerysliderspro/adminhtml_group_edit_tabs'));

			$this->renderLayout();
		} else {
			Mage::getSingleton('adminhtml/session')->addError(Mage::helper('jquerysliderspro')->__('Group does not exist.'));
			$this->_redirect('*/*/');
		}
	}

	public function newAction() {
		$this->_forward('edit');
	}

	public function saveAction() {
		$helper = Mage::helper('jquerysliderspro');
		if ($data = $this->getRequest()->getPost('general')) {
			/********************************* IMAGE OPERATION  *********************************/
			$imageData = array();
			if(isset($_FILES['imagefile']['name']) && $_FILES['imagefile']['name'] != '') {
				try {
					$fileName	= str_replace(' ', '', $_FILES['imagefile']['name']);
					$uploader = new Varien_File_Uploader('imagefile');
	           		$uploader->setAllowedExtensions(array('jpg','jpeg','gif','png'));
					$uploader->setAllowRenameFiles(false);
					$uploader->setFilesDispersion(false);
					$path = Mage::getBaseDir('media') . DS . 'jquerysliderspro';
					if(!is_dir($path)){
						mkdir($path, 0777, true);
					}
					$uploader->save($path . DS, $fileName );
					$imageData['imagefile'] = 'jquerysliderspro/' . $fileName;
				} catch (Exception $e) {
					Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
					$this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
					return;
		        }
			}

			if (!empty($imageData['imagefile'])) {
                $data['imagefile'] = $imageData['imagefile'];
            } else {
                if (isset($data['imagefile']['delete']) && $data['imagefile']['delete'] == 1) {
                    if ($data['imagefile']['value'] != '') {
                        $this->removeFile(Mage::getBaseDir('media') . DS . $data['imagefile']['value']);
                    }
                    $data['imagefile'] = '';
                } else {
                    unset($data['imagefile']);
                }
            }
			/********************************* IMAGE OPERATION  *********************************/

			/********************************* SLIDER OPERATION  *********************************/
			$sliderTypes	= Mage::getSingleton('jquerysliderspro/system_config_source_slidertype')->getOptionArray();
			$sliderSettings = array();
			foreach($sliderTypes as $_sliderCode => $_sliderLabel){
				if($_sliderCode == $data['slider_type']){
					foreach($data as $key => $value){
						if(strpos($key, $_sliderCode . '_') !== false){
							$sliderSettings[$key] = $value;
						}
					}
				}
			}
			$data['slider_settings'] = serialize($sliderSettings);
			/********************************* SLIDER OPERATION  *********************************/

			$data['identifier'] = $helper->slugify($data['identifier']);

			$model = Mage::getModel('jquerysliderspro/group');
			$model->setData($data)
				  ->setId($this->getRequest()->getParam('id'));

			try {
				if ($model->getCreatedAt() == NULL || $model->getUpdatedAt() == NULL) {
					$model->setCreatedAt(now())
						  ->setUpdatedAt(now());
				} else {
					$model->setUpdatedAt(now());
				}

				//check if identifier is unique
				if($model->checkIfIdentifierExists($data['identifier'], $this->getRequest()->getParam('id'))){
					throw new Exception('Such Identifier: '.$data['identifier'] . ' already exists.');
				}

				$model->save();
				Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('jquerysliderspro')->__('The Group has been saved.'));
				Mage::getSingleton('adminhtml/session')->setFormData(false);

				if ($this->getRequest()->getParam('back')) {
					$this->_redirect('*/*/edit', array('id' => $model->getId()));
					return;
				}
				$this->_redirect('*/*/');
				return;
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')->setFormData($data);
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                return;
            }
        }
        Mage::getSingleton('adminhtml/session')->addError(Mage::helper('jquerysliderspro')->__('Unable to find Group to save.'));
        $this->_redirect('*/*/');
	}

	public function deleteAction() {
		if( $this->getRequest()->getParam('id') > 0 ) {
			try {
				$model = Mage::getModel('jquerysliderspro/group');

				$model->setId($this->getRequest()->getParam('id'))
					  ->delete();

				Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('The Group has been deleted.'));
				$this->_redirect('*/*/');
			} catch (Exception $e) {
				Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
				$this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
			}
		}
		$this->_redirect('*/*/');
	}

    public function massDeleteAction() {
        $groupIds = $this->getRequest()->getParam('group');
        if(!is_array($groupIds)) {
			Mage::getSingleton('adminhtml/session')->addError(Mage::helper('adminhtml')->__('Please select item(s)'));
        } else {
            try {
                foreach ($groupIds as $groupId) {
                    $group = Mage::getModel('jquerysliderspro/group')->load($groupId);
                    $group->delete();
                }
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('adminhtml')->__(
                        'Total of %d record(s) were deleted.', count($groupIds)
                    )
                );
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
        }
        $this->_redirect('*/*/index');
    }

	public function slidesAction(){
		$this->getLayout();
		$this->getResponse()->setBody(
			$this->getLayout()->createBlock('jquerysliderspro/adminhtml_group_edit_tab_slides')->toHtml()
		);
	}

    public function massStatusAction()
    {
        $groupIds = $this->getRequest()->getParam('group');
        if(!is_array($groupIds)) {
            Mage::getSingleton('adminhtml/session')->addError($this->__('Please select item(s)'));
        } else {
            try {
                foreach ($groupIds as $groupId) {
                    $group = Mage::getSingleton('jquerysliderspro/group')
								->load($groupId)
								->setStatus($this->getRequest()->getParam('status'))
								->setIsMassupdate(true)
								->save();
                }
                $this->_getSession()->addSuccess(
                    $this->__('Total of %d record(s) were updated.', count($groupIds))
                );
            } catch (Exception $e) {
                $this->_getSession()->addError($e->getMessage());
            }
        }
        $this->_redirect('*/*/index');
    }

	protected function removeFile($file) {
        try {
            $io		= new Varien_Io_File();
            $result = $io->rmdir($file, true);
        } catch (Exception $e) {

        }
    }

    public function exportCsvAction()
    {
        $fileName   = 'groups.csv';
        $content    = $this->getLayout()->createBlock('jquerysliderspro/adminhtml_group_grid')->getCsv();
        $this->_sendUploadResponse($fileName, $content);
    }

    public function exportXmlAction()
    {
        $fileName   = 'groups.xml';
        $content    = $this->getLayout()->createBlock('jquerysliderspro/adminhtml_group_grid')->getXml();
        $this->_sendUploadResponse($fileName, $content);
    }

    protected function _sendUploadResponse($fileName, $content, $contentType='application/octet-stream')
    {
        $response = $this->getResponse();
        $response->setHeader('HTTP/1.1 200 OK','');
        $response->setHeader('Pragma', 'public', true);
        $response->setHeader('Cache-Control', 'must-revalidate, post-check=0, pre-check=0', true);
        $response->setHeader('Content-Disposition', 'attachment; filename='.$fileName);
        $response->setHeader('Last-Modified', date('r'));
        $response->setHeader('Accept-Ranges', 'bytes');
        $response->setHeader('Content-Length', strlen($content));
        $response->setHeader('Content-type', $contentType);
        $response->setBody($content);
        $response->sendResponse();
        die;
    }
}