<?php
/*
 * author Pavel Stary, Cesky WEB s.r.o.
 * @component Multicats
 * @copyright Copyright (C) Pavel Stary, Cesky WEB s.r.o. extensions.cesky-web.eu
 * @license http://www.gnu.org/copyleft/gpl.html GNU General Public License version 2 or later;
 */
 
defined('_JEXEC') or die;
/**
 * Since 3.4
 */ 
class MulticatsContentHelper
{
  /**
   * Method to get a HTML list of categories of an article
   */     
  public static function getCategoryNames($content_id,$link_category = true) {

    $language = JFactory::getLanguage();
    $language_tag = $language->getTag(); // loads the current language-tag
    $language->load('com_multicats', JPATH_SITE, $language_tag, true);

    $db = JFactory::getDbo();
    //get article's all categories - item->catid was cut to current category, so we need to re-read them again
      $query = "SELECT catid FROM #__content WHERE id = ".$content_id;
      $db->setQuery($query);
      $catid = $db->loadObject();
    $catarray = explode(',',$catid->catid);

    $html = (count($catarray) > 1) ? JText::_('COM_MULTICATS_CATEGORIES').": " : JText::_('JCATEGORY').": "; 
    
    $container = array();
    foreach($catarray as $key => $cat){
      $query = "SELECT id, title FROM #__categories WHERE id = ".$cat;
      $db->setQuery($query);
      $category = $db->loadObject();
      
      $title = $category->title;
      $url = '<a href="' . JRoute::_(ContentHelperRoute::getCategoryRoute($category->id)) . '">' . $title . '</a>';
      
      if ($link_category) :
        $container[] = $url;
      else :
        $container[] = $title;
      endif;         
    }  
    //adds list to html
    $html .= implode(', ',$container);  
    //return category list html
    return $html;
  }
  
}
