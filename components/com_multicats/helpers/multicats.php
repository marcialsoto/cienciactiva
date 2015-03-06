<?php
/*
 * author Pavel Stary, Cesky WEB s.r.o.
 * @component Multicats
 * @copyright Copyright (C) Pavel Stary, Cesky WEB s.r.o. extensions.cesky-web.eu
 * @license http://www.gnu.org/copyleft/gpl.html GNU General Public License version 2 or later;
 */
 
defined('_JEXEC') or die;

class MulticatsHelper
{

/**
 *  Functions for handling multicats
 */
  /* FUNKCE NA OBSLUHU $data: object <-> array */
  // Function Object a Array
  static function object_to_array($object)
  {
    if(is_array($object) || is_object($object))
    {
      $array = array();
      foreach($object as $key => $value)
      {
        $array[$key] = MulticatsHelper::object_to_array($value);
      }
      return $array;
    }
    return $object;
  }
   
  // Function Array a Object
  static function array_to_object($array = array())
  {
    return (object) $array;
  }
  // Funkce na projití objectu - obdoba in_array pro pole
  static function property_value_in_array($array, $property, $value) {
      $flag = false;
   
      foreach($array as $object) {
          if(!is_object($object) || !property_exists($object, $property)) {
              return false;        
          }
   
          if($object->$property == $value) {
              $flag = true;
          }
      }
      
      return $flag;
  }
  static function getTitle($id){
    $db = JFactory::getDbo();
    $query = "SELECT title FROM #__categories WHERE id = ".$id;
    $db->setQuery($query);
    return $db->loadResult();
  }
  /* END */
     
  static public function multicats()
  {
    $client = JRequest::getVar('client'); 
    $item = JRequest::getVar('item');
    if(!$client) { return; }
    
    $mainframe = JFactory::getApplication($client);
    //$mainframe->initialise();
     
    //$session =& JFactory::getSession();
    //$data = $session->get("catz");
     
    $data = $mainframe->getUserState( "com_content.mcats", '' );
     
    $data = json_decode($data);
    if(!is_array($data)) { $data = array(); }

    //Get category title
    $title = MulticatsHelper::getTitle($_GET['item']);
     
    // uncheck
    if($_GET['chck'] == 'false'){
      //$data = object_to_array($data); 
      foreach($data as $key => $cat){
        if($cat->id == $_GET['item']){
        //if($cat['id'] == $_GET['item']){
          unset($data[$key]);
        }
      }
      $data = MulticatsHelper::object_to_array($data);
      $data = array_values($data);
      foreach($data as $key => $cat){
        $data[$key] = (object) $data[$key];
      }
    }
    // check
    if(!MulticatsHelper::property_value_in_array($data, 'id', $_GET['item'], $data) AND $_GET['chck'] == 'true'){
      $data = MulticatsHelper::object_to_array($data);
      $data[] = array("id" => $_GET['item'], "title" => $title);
      //echo $_GET['item']."+";
    }
     
    // uncheck all
    if($_GET['item'] == 0){
      $data = MulticatsHelper::object_to_array($data);
      foreach($data as $key => $cat){
        unset($data[$key]);
      }
      
    }
     
    $catz = json_encode($data);
    //$session->set("catz",$catz);
    $mainframe->setUserState( "com_content.mcats", $catz );
     
    // Send the result
    echo $catz; 
  }
  
}
