<?php/*** @version		1.0.1* @package		DJ Select Menu* @subpackage	DJ Select Menu Module* @copyright	Copyright (C) 2010 DJ-Extensions.com LTD, All rights reserved.* @license		http://www.gnu.org/licenses GNU/GPL* @autor url    http://design-joomla.eu* @autor email  contact@design-joomla.eu* @Developer    Lukasz Ciastek - lukasz.ciastek@design-joomla.eu* * * DJ Select Menu Module is free software: you can redistribute it and/or modify* it under the terms of the GNU General Public License as published by* the Free Software Foundation, either version 3 of the License, or* (at your option) any later version.** DJ Select Menu Module is distributed in the hope that it will be useful,* but WITHOUT ANY WARRANTY; without even the implied warranty of* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the* GNU General Public License for more details.** You should have received a copy of the GNU General Public License* along with DJ Select Menu Module. If not, see <http://www.gnu.org/licenses/>.* */
defined ('_JEXEC') or die('Restricted access');
//echo '<pre>';print_r($list);die();
	$list_level = array();
?>
	<div class="djselect_menu">	
		<?php 			
		echo '<select class="djsm-select" onchange="DJSelectMenu(this.value)" >';
			echo '<option value="">'.JText::_('MOD_DJSELECTMENU_PLEASE_SELECT_ELEMENT').'</option>';
			foreach($list as $li){
				if($li->level==1){
					echo '<option ';
					if ($li->id == $active_id || in_array($li->id, $path)) {
						echo ' SELECTED ';
					}					
					echo 'value="'.$li->flink.'">'.$li->title.'</option>';		
				}else{
					$list_level[$li->level][] = $li;	
				}	
			}
		echo '</select>'; 
		
		foreach($list_level as $list_l){
			echo '<select class="djsm-select" onchange="DJSelectMenu(this.value)" >';
				if(!isset($list_level[$list_l[0]->level+1])){
					echo '<option value=""></option>';
				}
				
				foreach($list_l as $li){					
					echo '<option ';
					if ($li->id == $active_id || in_array($li->id, $path)) {
						echo ' SELECTED ';
					}
					echo 'value="'.$li->flink.'">'.$li->title.'</option>';			
				}
			echo '</select>';
		}
			
		?>
	</div>	
	 <script type="text/javascript" >
	 	function DJSelectMenu(url){
	 		if(url){
	 			window.location=url;
	 		}
	 	}
	 </script>