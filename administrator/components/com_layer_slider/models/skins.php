<?php
/*-------------------------------------------------------------------------
# com_layer_slider - com_layer_slider
# -------------------------------------------------------------------------
# @ author    John Gera, George Krupa, Janos Biro
# @ copyright Copyright (C) 2014 Offlajn.com  All Rights Reserved.
# @ license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# @ website   http://www.offlajn.com
-------------------------------------------------------------------------*/
?><?php
// No direct access.
defined('_JEXEC') or die;

jimport('joomla.application.component.modeladmin');

/**
 * Layer_slider model.
 */
class Layer_sliderModelSkins extends JModelAdmin
{
	/**
	 * @var		string	The prefix to use with controller messages.
	 * @since	1.6
	 */
	protected $text_prefix = 'COM_LAYER_SLIDER';


	/**
	 * Returns a reference to the a Table object, always creating it.
	 *
	 * @param	type	The table type to instantiate
	 * @param	string	A prefix for the table class name. Optional.
	 * @param	array	Configuration array for model. Optional.
	 * @return	JTable	A database object
	 * @since	1.6
	 */
	public function getForm($data = array(), $loadData = true)
	{
		return $form;
	}

  public function saveSkin($jinput) {
  
  	// Get skin file and contents
  	$skin = $jinput->get("skin",0,"STRING");
  	$folder = $file = LS_ROOT_PATH.'/static/skins/'.$skin;
  	$file = LS_ROOT_PATH.'/static/skins/'.$skin.'/skin.css';
  	$content = $jinput->get("contents",0,"STRING");
  
  	// Attempt to write the file
  	if(is_writable($folder)) {
  		file_put_contents($file, $content);
  		header('Location: index.php?option=com_layer_slider&view=skineditor&skin='.$skin.'&edited=1');
  	} else {
//  		wp_die(__("It looks like your files isn't writable, so PHP couldn't make any changes (CHMOD).", "LayerSlider"), __('Cannot write to file', 'LayerSlider'), array('back_link' => true) );
  		JError::raiseWarning( 100, "It looks like your files isn't writable, so PHP couldn't make any changes (CHMOD)." );
      header('Location: index.php?option=com_layer_slider&view=skineditor&skin='.$skin.'&error=1');
  	}
  }
	
	/**
	 * Prepare and sanitise the table prior to saving.
	 *
	 * @since	1.6
	 */
	protected function prepareTable($table)
	{
		jimport('joomla.filter.output');

		if (empty($table->id)) {

			// Set ordering to the last item if not set
			if (@$table->ordering === '') {
				$db = JFactory::getDbo();
				$db->setQuery('SELECT MAX(ordering) FROM slider');
				$max = $db->loadResult();
				$table->ordering = $max+1;
			}

		}
	}

}