<?php
/**
 * Random youtube video fancy zoom 
 *
 * @package Random youtube video fancy zoom
 * @subpackage Random youtube video fancy zoom
 * @version   3.3
 * @author    Gopi Ramasamy
 * @copyright Copyright (C) 2010 - 2014 www.gopiplus.com, LLC
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 *
 */

// no direct access
defined('_JEXEC') or die;

// Include the syndicate functions only once
require_once(dirname(__FILE__).'/helper.php');
$args['ytfz_videocode1'] 	= $params->get('ytfz_videocode1');
$args['ytfz_videocode2'] 	= $params->get('ytfz_videocode2');
$args['ytfz_videocode3'] 	= $params->get('ytfz_videocode3');
$args['ytfz_videocode4']	= $params->get('ytfz_videocode4');
$args['ytfz_videocode5'] 	= $params->get('ytfz_videocode5');
$args['ytfz_videocode6'] 	= $params->get('ytfz_videocode6');
$args['ytfz_videocode7'] 	= $params->get('ytfz_videocode7');
$args['ytfz_videocode8'] 	= $params->get('ytfz_videocode8');
$args['ytfz_videocode9']	= $params->get('ytfz_videocode9');
$args['ytfz_videocode10'] 	= $params->get('ytfz_videocode10');
$args['ytfz_width'] 		= $params->get('ytfz_width');
$args['ytfz_height'] 		= $params->get('ytfz_height');
$args['ytfz_image'] 		= $params->get('ytfz_image');
$args['ytfz_option'] 		= $params->get('ytfz_option');
$args['ytfz_imgfolder'] 	= $params->get('ytfz_imgfolder');
$args['moduleclass_sfx'] 	= $params->get('moduleclass_sfx');
$video	= ModRandomYoutubeVideoFancyZoom::getVideoList($args);
ModRandomYoutubeVideoFancyZoom::loadScripts($params);
require(JModuleHelper::getLayoutPath('mod_random_youtube_video_fancy_zoom'));
?>