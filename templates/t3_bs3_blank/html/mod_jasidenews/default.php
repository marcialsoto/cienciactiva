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
	$iheight = 130;

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
			<a class="media-left hidden-xs" href="<?php echo  $item->link; ?>">
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
				<div class="desc__social">
					<div class="desc">
						<?php echo $helper->trimString( strip_tags($item->introtext), $descMaxChars); ?>
					</div>
					<div class="social--share">
						<ul class="list-inline">
							<li>Compartir:</li>
							<li><!--Twitter-->
							<a class="twitter" href="http://twitter.com/home?status=Reading: <?php echo  $item->link; ?>" title="Share this post on Twitter!" target="_blank"><i class="fa fa-twitter"></i></a></li>
							<li><!--Facebook-->
							<a class="facebook" href="http://www.facebook.com/sharer.php?u=<?php echo  $item->link; ?>&amp;t=<?php echo  $helper->trimString( $item->title, $titleMaxChars );?>" title="Share this post on Facebook!" onclick="window.open(this.href); return false;"><i class="fa fa-facebook"></i></a></li>
							<li><!--Google Plus-->
							<a class="google-plus" target="_blank" href="https://plus.google.com/share?url=<?php echo  $item->link; ?>"><i class="fa fa-google-plus"></i></a></li>
						</ul>
					</div>
				</div>
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
