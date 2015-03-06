<?php
/**
 * author Cesky WEB s.r.o.
 * @component CWtags
 * @copyright Copyright (C) Pavel Stary, Cesky WEB s.r.o. extensions.cesky-web.eu
 * @license http://www.gnu.org/copyleft/gpl.html GNU General Public License version 2 or later;
 */

defined('_JEXEC') or die( 'Restricted access' );
//jimport('joomla.application.component.controller');

class MulticatsController extends JControllerLegacy {
  public function display($cachable = false, $urlparams = false)
  {
    $this->input->set('view', 'multicats'); // force it to be the search view
  
    return parent::display($cachable, $urlparams);
  }
  public function multicats() 
  {
      
      require_once( JPATH_SITE.DS.'components'.DS.'com_multicats'.DS.'helpers'.DS.'multicats.php' );

      MulticatsHelper::multicats();

      return;
  }

  // autocomplete
  public function autocomplete() 
  {
    $q = strtolower($_GET["term"]);
    if (!$q) return;  
    
    $db = JFactory::getDbo();
    $query =  "SELECT title AS value, id FROM #__categories WHERE title LIKE '%".mysql_escape_string($q)."%' AND extension = 'com_content' AND published=1 LIMIT 0,15"; 
    $db->setQuery($query);
    $result = $db->loadObjectList();
    
    $catz = json_encode($result);
    echo $catz;
  }     
}