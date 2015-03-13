<?php
/**
 * ------------------------------------------------------------------------
 * JA SideNews Module for J25 & J33
 * ------------------------------------------------------------------------
 * Copyright (C) 2004-2011 J.O.O.M Solutions Co., Ltd. All Rights Reserved.
 * @license - GNU/GPL, http://www.gnu.org/licenses/gpl.html
 * Author: J.O.O.M Solutions Co., Ltd
 * Websites: http://www.joomlart.com - http://www.joomlancers.com
 * ------------------------------------------------------------------------
 */
// no direct access
defined('_JEXEC') or die('Restricted access');
?>

<?php
	$iwidth = 200;
	$iheight = 125;

?>
<div class="ja-sidenews-list clearfix">
	<ul class="media-list">
	<?php foreach( $list as $item ) :
		$item->date = null;
		if( $showdate) {
			//$item->date =  strtotime ( $item->modified ) ? $item->created : $item->modified;
			$item->date = ($item->modified != '' && $item->modified != '0000-00-00 00:00:00') ? $item->modified : $item->created;
		}
		if(isset($item->text)){
			$item->text = $item->introtext . $item->text;
		}else{
			$item->text = $item->introtext;
		}


	?>
		<div class="ja-slidenews-item">
			<li class="media">
			<a class="media-left" href="<?php echo  $item->link; ?>">
				<?php if( $showimage ):  ?>
						<?php echo $helper->renderImage ($item, $params, $descMaxChars, $iwidth, $iheight ); ?>
				<?php endif; ?>
			</a>
			<div class="media-body">
				<?php if (isset($item->date)) : ?>
					<p><span class="ja-createdate"><?php echo JHTML::_('date', $item->date, JText::_('d F Y')); ?> </span></p>
				<?php endif; ?>
				<h4 class="media-heading"><a href="<?php echo  $item->link; ?>"><?php echo  $helper->trimString( $item->title, $titleMaxChars );?></a></h4>

				<?php if ($descMaxChars!=0) : ?>
				<?php echo $helper->trimString( strip_tags($item->introtext), $descMaxChars); ?>
				<?php endif;?>
			</div>




		  <?php if( $showMoredetail ) : ?>
		  <a class="readon" href="<?php echo  $item->link; ?>"> <?php echo JTEXT::_("MORE_DETAIL"); ?></a>
		  <?php endif;?>
		</li>
		</div>
  <?php endforeach; ?>
	</ul>
</div>
