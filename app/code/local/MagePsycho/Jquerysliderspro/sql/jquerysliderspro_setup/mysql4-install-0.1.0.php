<?php
/**
 * @category   MagePsycho
 * @package    MagePsycho_Jquerysliderspro
 * @author     magepsycho@gmail.com
 * @website    http://www.magepsycho.com
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
$installer = $this;

$installer->startSetup();

$installer->run("

-- DROP TABLE IF EXISTS {$this->getTable('jquerysliderspro_groups')};
CREATE TABLE {$this->getTable('jquerysliderspro_groups')} (
  `group_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `identifier` varchar(255) NOT NULL,
  `slider_type` varchar(255) NOT NULL,
  `slider_width` int(11) DEFAULT NULL,
  `slider_height` int(11) DEFAULT NULL,
  `use_slider_settings` varchar(255) NOT NULL,
  `slider_settings` text NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- DROP TABLE IF EXISTS {$this->getTable('jquerysliderspro_slides')};
CREATE TABLE {$this->getTable('jquerysliderspro_slides')} (
  `slide_id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content_type` varchar(50) NOT NULL,
  `imagefile` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `target` varchar(10) NOT NULL,
  `description` text NOT NULL,
  `html_content` text NOT NULL,
  `product_skus` text NOT NULL,
  `sort_order` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`slide_id`),
  CONSTRAINT `FK_GROUP_SLIDE` FOREIGN KEY (`group_id`) REFERENCES {$this->getTable('jquerysliderspro_groups')} (`group_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

    ");

$installer->endSetup();