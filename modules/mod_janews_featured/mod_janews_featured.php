<?php
/**
 * ------------------------------------------------------------------------
 * JA News Featured Module for J25 & J33
 * ------------------------------------------------------------------------
 * Copyright (C) 2004-2011 J.O.O.M Solutions Co., Ltd. All Rights Reserved.
 * @license - GNU/GPL, http://www.gnu.org/licenses/gpl.html
 * Author: J.O.O.M Solutions Co., Ltd
 * Websites: http://www.joomlart.com - http://www.joomlancers.com
 * ------------------------------------------------------------------------
 */


// no direct access
defined('_JEXEC') or die('Restricted access');
if(!defined('DS')){
	define('DS', DIRECTORY_SEPARATOR);
}
require_once (dirname(__FILE__) . DS . 'helpers' . DS . 'helper.php');
require_once JPATH_SITE . '/components/com_content/helpers/route.php';

if (version_compare(JVERSION, '3.0', 'ge'))
{
	JModelLegacy::addIncludePath(JPATH_SITE . '/components/com_content/models');
}
else if (version_compare(JVERSION, '2.5', 'ge'))
{
	JModel::addIncludePath(JPATH_SITE . '/components/com_content/models');
}
else
{
	JModel::addIncludePath(JPATH_SITE . '/components/com_content/models');
}

$files = JFolder::files(dirname(__FILE__) . DS . 'helpers' . DS . 'adapter');
if ($files) {
    foreach ($files as $file) {
		//only load php files
       if(strpos($file,".php")){
			require_once (dirname(__FILE__) . DS . 'helpers' . DS . 'adapter' . DS . $file);
		}
    }
}
$mainframe = JFactory::getApplication();
$helper = new modJaNewsFrontpageHelper($module, $params);
$theme = $helper->get('themes', 'default');

if (JRequest::getBool('janews_fp_ajax')) {
    if (JRequest::getInt('moduleid') != $module->id) {
        return;
    }

    $count = JRequest::getInt('count', 1);
    if (!$count) {
        $count = 1;
    }
    $limitstart = (int) $helper->get('more_article', 5) * $count + ((int) $helper->get('numberofheadlinenews', 10) - (int) $helper->get('more_article', 5));
    $helper->jaset('limitstart', $limitstart);
    $helper->jaset('limit', (int) $helper->get('more_article', 6));
    $helper->_load($params);
    $flagMore = -1;
}

$helper->_load($params);

$rows = $helper->articles;
//count Number of Featured Articles on setting
$helper->jaset('bigitems', $helper->get( 'bigitems', 1)>count($rows)?count($rows):$helper->get( 'bigitems', 1));

if (!defined('_MODE_JAMODNEWSFP_ASSETS_')) {
    define('_MODE_JAMODNEWSFP_ASSETS_', 1);
    JHTML::stylesheet('modules/' . $module->module . '/assets/css/style.css');

    if (is_file(JPATH_SITE . DS . 'templates' . DS . $mainframe->getTemplate() . DS . 'css' . DS . $module->module . ".css"))
        JHTML::stylesheet('templates/' . $mainframe->getTemplate() . '/css/' . $module->module . ".css");

    //mootools support joomla 1.7 and 2.5
	JHTML::_('behavior.framework', true);
	
    JHTML::_('behavior.tooltip');
    JHTML::script('modules/' . $module->module . '/assets/js/script.js');
}

if (!defined('_MODE_JAMODNEWSFP_ASSETS_' . $theme)) {
    define('_MODE_JAMODNEWSFP_ASSETS_' . $theme, 1);

    if (is_file(JPATH_SITE . DS . 'modules' . DS . $module->module . DS . 'tmpl' . DS . $theme . DS . "style.css"))
        JHTML::stylesheet('modules/' . $module->module . '/tmpl/' . $theme . '/style.css');

    if (is_file(JPATH_SITE . DS . 'templates' . DS . $mainframe->getTemplate() . DS . 'html' . DS . $module->module . DS . $theme . DS . "style.css"))
        JHTML::stylesheet('templates/' . $mainframe->getTemplate() . '/html/' . $module->module . '/' . $theme . '/style.css');
	
    

    if (is_file(JPATH_SITE . DS . 'templates' . DS . $mainframe->getTemplate() . DS . 'html' . DS . $module->module . DS . $theme . DS . "script.js")){
        JHTML::script('templates/' . $mainframe->getTemplate() . '/html/' . $module->module . '/' . $theme . '/script.js');
    }else if (is_file(JPATH_SITE . DS . 'modules' . DS . $module->module . DS . 'tmpl' . DS . $theme . DS . "script.js"))
        JHTML::script('modules/' . $module->module . '/tmpl/' . $theme . '/script.js');
    
    
	//mootools support joomla 1.7 and 2.5
	JHTML::_('behavior.framework', true);
	
    JHTML::_('behavior.tooltip');
    JHTML::script('modules/' . $module->module . '/assets/js/script.js');
}
/**
 * Display data
 */
if (JRequest::getBool('janews_fp_ajax')) {
    $path = JModuleHelper::getLayoutPath($module->module, $theme . '/blog_links');
    ob_clean();
    require ($path);
    exit();
} else {
    $path = JModuleHelper::getLayoutPath($module->module, $theme . '/blog');
    if (file_exists($path)) {
        require ($path);
    }
}

?>