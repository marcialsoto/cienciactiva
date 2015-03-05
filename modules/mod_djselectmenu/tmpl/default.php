<?php
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
