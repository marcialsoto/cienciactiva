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

class ModRandomYoutubeVideoFancyZoom
{
	public static function loadScripts(&$params)
	{
		$doc = JFactory::getDocument();
		$ytfz_jquery = $params->get("ytfz_jquery","yes");	
		if($ytfz_jquery == "yes")	
		{
			$doc->addScript(JURI::Root(true).'/modules/mod_random_youtube_video_fancy_zoom/inc/jquery.min.js');
		}
		$doc->addStyleSheet(JURI::Root(true).'/modules/mod_random_youtube_video_fancy_zoom/inc/youtube-with-fancy-zoom.css','','screen');
		$doc->addScript(JURI::Root(true).'/modules/mod_random_youtube_video_fancy_zoom/inc/youtube-with-fancy-zoom.js');
	}
	
	public static function getVideoList($args)
	{
		
		$ytfz_videocode1 = $args['ytfz_videocode1'];
		$ytfz_videocode2 = $args['ytfz_videocode2'];
		$ytfz_videocode3 = $args['ytfz_videocode3'];
		$ytfz_videocode4 = $args['ytfz_videocode4'];
		$ytfz_videocode5 = $args['ytfz_videocode5'];
		$ytfz_videocode6 = $args['ytfz_videocode6'];
		$ytfz_videocode7 = $args['ytfz_videocode7'];
		$ytfz_videocode8 = $args['ytfz_videocode8'];
		$ytfz_videocode9 = $args['ytfz_videocode9'];
		$ytfz_videocode10 = $args['ytfz_videocode10'];
		
		$ytfz_width = $args['ytfz_width'];
		$ytfz_height = $args['ytfz_height'];
		
		$ytfz_image = $args['ytfz_image'];
		$ytfz_option = $args['ytfz_option'];
		$moduleclass_sfx = $args['moduleclass_sfx'];
		$ytfz_imgfolder = $args['ytfz_imgfolder'];
		
		$video = array();
		$videocode = array();
		$videodisplay = array();
		
		$LiveSite	= JURI::base();

		$arr = 0;
		//$video[0] = new stdClass;
		if($ytfz_videocode1 <> "")
		{
			$video[$arr] = new stdClass;
			$video[$arr]->videocode = $ytfz_videocode1;
			$video[$arr]->videimage = "1.jpg";
			$arr = $arr +1;
		}
		if($ytfz_videocode2 <> "")
		{
			$video[$arr] = new stdClass;
			$video[$arr]->videocode = $ytfz_videocode2;
			$video[$arr]->videimage = "2.jpg";
			$arr = $arr +1;
		}
		if($ytfz_videocode3 <> "")
		{
			$video[$arr] = new stdClass;
			$video[$arr]->videocode = $ytfz_videocode3;
			$video[$arr]->videimage = "3.jpg";
			$arr = $arr +1;
		}
		if($ytfz_videocode4 <> "")
		{
			$video[$arr] = new stdClass;
			$video[$arr]->videocode = $ytfz_videocode4;
			$video[$arr]->videimage = "4.jpg";
			$arr = $arr +1;
		}
		if($ytfz_videocode5 <> "")
		{
			$video[$arr] = new stdClass;
			$video[$arr]->videocode = $ytfz_videocode5;
			$video[$arr]->videimage = "5.jpg";
			$arr = $arr +1;
		}
		if($ytfz_videocode6 <> "")
		{
			$video[$arr] = new stdClass;
			$video[$arr]->videocode = $ytfz_videocode6;
			$video[$arr]->videimage = "6.jpg";
			$arr = $arr +1;
		}
		if($ytfz_videocode7 <> "")
		{
			$video[$arr] = new stdClass;
			$video[$arr]->videocode = $ytfz_videocode7;
			$video[$arr]->videimage = "7.jpg";
			$arr = $arr +1;
		}
		if($ytfz_videocode8 <> "")
		{
			$video[$arr] = new stdClass;
			$video[$arr]->videocode = $ytfz_videocode8;
			$video[$arr]->videimage = "8.jpg";
			$arr = $arr +1;
		}
		if($ytfz_videocode9 <> "")
		{
			$video[$arr] = new stdClass;
			$video[$arr]->videocode = $ytfz_videocode9;
			$video[$arr]->videimage = "9.jpg";
			$arr = $arr +1;
		}
		if($ytfz_videocode10 <> "")
		{
			$video[$arr] = new stdClass;
			$video[$arr]->videocode = $ytfz_videocode10;
			$video[$arr]->videimage = "10jpg";
			$arr = $arr +1;
		}
		
		$vcode = rand(0, count($video)-1);
		$videodisplay[0] = new stdClass;
		$videodisplay[0]->videolink = $video[$vcode]->videocode;
		$videodisplay[0]->width = $ytfz_width;
		$videodisplay[0]->height = $ytfz_height;

		if($ytfz_image == "YouTubeImage")
		{
			
			$q = parse_url($video[$vcode]->videocode,6);
			parse_str($q);
			$videodisplay[0]->imagepath = "http://img.youtube.com/vi/".$v."/0.jpg";
		}
		else
		{
			$LiveSite	= JURI::base();

			// if folder includes livesite info, remove
			if (JString::strpos($ytfz_imgfolder, $LiveSite) === 0) {
				$ytfz_imgfolder = str_replace($LiveSite, '', $ytfz_imgfolder);
			}
			// if folder includes absolute path, remove
			if (JString::strpos($ytfz_imgfolder, JPATH_SITE) === 0) {
				$ytfz_imgfolder= str_replace(JPATH_BASE, '', $ytfz_imgfolder);
			}
			
			$path = JURI::base().$ytfz_imgfolder ."/". $video[$vcode]->videimage;
			
			$videodisplay[0]->imagepath = $path;
		}
		return $videodisplay;
    }
}
?>