<?php
/**
 * @category   MagePsycho
 * @package    MagePsycho_Jquerysliderspro
 * @author     magepsycho@gmail.com
 * @website    http://www.magepsycho.com
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class MagePsycho_Jquerysliderspro_Adminhtml_SlideController extends Mage_Adminhtml_Controller_action
{
	protected function _initAction() {
		$this->_title($this->__('Manage Slide'))
             ->_title($this->__('jQuery Sliders'));
		$this->loadLayout()
			 ->_setActiveMenu('jquerysliderspro/slide')
			 ->_addBreadcrumb(Mage::helper('adminhtml')->__('Manage Slide'), Mage::helper('adminhtml')->__('Manage Slide'));

		return $this;
	}

	public function indexAction() {
		$this->_initAction()
			 ->renderLayout();
	}

	public function editAction() {
		$id     = $this->getRequest()->getParam('id');
		$model  = Mage::getModel('jquerysliderspro/slide')->load($id);

		if($passedGroupId = $this->getRequest()->getParam('group_id')){
			if($passedGroupId != -1){
				$model->setData('group_id', $this->getRequest()->getParam('group_id'));
			}
		}

		if ($model->getId() || $id == 0) {
			$data = Mage::getSingleton('adminhtml/session')->getFormData(true);
			if (!empty($data)) {
				$model->setData($data);
			}

			Mage::register('slide_data', $model);

			$this->_initAction();

			$this->getLayout()->getBlock('head')->setCanLoadExtJs(true);

			$this->_addContent($this->getLayout()->createBlock('jquerysliderspro/adminhtml_slide_edit'))
				 ->_addLeft($this->getLayout()->createBlock('jquerysliderspro/adminhtml_slide_edit_tabs'));

			$this->renderLayout();
		} else {
			Mage::getSingleton('adminhtml/session')->addError(Mage::helper('jquerysliderspro')->__('Slide does not exist.'));
			$this->_redirect('*/*/');
		}
	}

	public function newAction() {
		$this->_forward('edit');
	}

	public function saveAction() {
		$helper = Mage::helper('jquerysliderspro');
		if ($data = $this->getRequest()->getPost()) {
			/********************************* IMAGE OPERATION  *********************************/
			$imageData = array();
			if(isset($_FILES['imagefile']['name']) && $_FILES['imagefile']['name'] != '') {
				try {
					$fileName	= $helper->slugify($_FILES['imagefile']['name']);
					$uploader = new Varien_File_Uploader('imagefile');
	           		$uploader->setAllowedExtensions(array('jpg','jpeg','gif','png'));
					$uploader->setAllowRenameFiles(true);
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

			$model = Mage::getModel('jquerysliderspro/slide');
			$model->setData($data)
				  ->setId($this->getRequest()->getParam('id'));

			try {
				if ($model->getCreatedAt() == NULL || $model->getUpdatedAt() == NULL) {
					$model->setCreatedAt(now())
						  ->setUpdatedAt(now());
				} else {
					$model->setUpdatedAt(now());
				}

				$model->save();
				Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('jquerysliderspro')->__('The Slide has been saved.'));
				Mage::getSingleton('adminhtml/session')->setFormData(false);

				if ($this->getRequest()->getParam('back')) {
					$this->_redirect('*/*/edit', array('id' => $model->getId(), 'group_id' => $this->getRequest()->getParam('group_id')));
					return;
				}

				if ($this->getRequest()->getParam('continue_tab')) {
					$this->_redirect('*/adminhtml_group/edit', array('id' => $data['group_id'], 'continue_tab' => $this->getRequest()->getParam('continue_tab')));
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
        Mage::getSingleton('adminhtml/session')->addError(Mage::helper('jquerysliderspro')->__('Unable to find Slide to save.'));
        $this->_redirect('*/*/');
	}

	public function deleteAction() {
		if( $this->getRequest()->getParam('id') > 0 ) {
			try {
				$model = Mage::getModel('jquerysliderspro/slide');

				$model->setId($this->getRequest()->getParam('id'))
					  ->delete();

				Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('The Slide has been deleted.'));
				$this->_redirect('*/*/');
			} catch (Exception $e) {
				Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
				$this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
			}
		}
		$this->_redirect('*/*/');
	}

    public function massDeleteAction() {
        $slideIds = $this->getRequest()->getParam('slide');
        if(!is_array($slideIds)) {
			Mage::getSingleton('adminhtml/session')->addError(Mage::helper('adminhtml')->__('Please select item(s)'));
        } else {
            try {
                foreach ($slideIds as $slideId) {
                    $slide = Mage::getModel('jquerysliderspro/slide')->load($slideId);
                    $slide->delete();
                }
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('adminhtml')->__(
                        'Total of %d record(s) were deleted.', count($slideIds)
                    )
                );
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
        }
        $this->_redirect('*/*/index');
    }

    public function massStatusAction()
    {
        $slideIds = $this->getRequest()->getParam('slide');
        if(!is_array($slideIds)) {
            Mage::getSingleton('adminhtml/session')->addError($this->__('Please select item(s)'));
        } else {
            try {
                foreach ($slideIds as $slideId) {
                    $slide = Mage::getSingleton('jquerysliderspro/slide')
								->load($slideId)
								->setStatus($this->getRequest()->getParam('status'))
								->setIsMassupdate(true)
								->save();
                }
                $this->_getSession()->addSuccess(
                    $this->__('Total of %d record(s) were updated.', count($slideIds))
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
        $fileName   = 'slides.csv';
        $content    = $this->getLayout()->createBlock('jquerysliderspro/adminhtml_slide_grid')->getCsv();
        $this->_sendUploadResponse($fileName, $content);
    }

    public function exportXmlAction()
    {
        $fileName   = 'slides.xml';
        $content    = $this->getLayout()->createBlock('jquerysliderspro/adminhtml_slide_grid')->getXml();
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