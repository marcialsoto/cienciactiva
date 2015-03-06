<?php

/**
 * author Pavel Stary, Cesky WEB s.r.o.
 * @component Multicats
 * @copyright Copyright (C) Pavel Stary, Cesky WEB s.r.o. extensions.cesky-web.eu
 * @license http://www.gnu.org/copyleft/gpl.html GNU General Public License version 2 or later;
 */

defined( '_JEXEC' ) or die( 'Restricted access' );
if(!defined('DS')){
  define('DS',DIRECTORY_SEPARATOR);
} 
global $mainframe;
$app = JFactory::getApplication('site'); 
$params = $app->getParams();
require_once (JPATH_COMPONENT.DS.'controller.php');
require_once (JPATH_COMPONENT.DS.'helpers/multicats.php'); 

$controller = new MulticatsController();
$controller->execute(JRequest::getCmd('task'));
$controller->redirect();