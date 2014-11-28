<?php
/**
 * ------------------------------------------------------------------------
 * JA Slideshow Lite Module for J25 & J3.3
 * ------------------------------------------------------------------------
 * Copyright (C) 2004-2011 J.O.O.M Solutions Co., Ltd. All Rights Reserved.
 * @license - GNU/GPL, http://www.gnu.org/licenses/gpl.html
 * Author: J.O.O.M Solutions Co., Ltd
 * Websites: http://www.joomlart.com - http://www.joomlancers.com
 * ------------------------------------------------------------------------
 */
defined('_JEXEC') or die('Restricted access');
?>
<div id="ja-ss-<?php echo $module->id;?>" class="ja-ss<?php echo $params->get( 'moduleclass_sfx' );?> ja-ss-wrap <?php echo $type; ?>"  style="visibility: hidden">
	<div class="ja-ss-items">
	<?php for ($i = 0; $i < count($images); $i++): ?>
		<div class="ja-ss-item">
			<img src="<?php echo $images[$i];?>" alt="<?php echo str_replace('"', '"/', strip_tags($captionsArray[$i]) );?>"/>

			<?php
				$icaption = trim($captionsArray[$i]);
				$ititle = trim($titles[$i])
			?>
			<?php if(strlen($icaption) || strlen($ititle)): ?>
			<div class="ja-ss-desc">
				<?php if($ititle) : ?>
				<h3><?php echo $ititle ?></h3>
				<?php endif; ?>

				<?php echo $icaption ?>
			</div>
			<?php endif; ?>
			<div class="ja-ss-mask"></div>
		</div>
	<?php endfor; ?>
	</div>

	<?php if ($showThumbnail == 1): ?>
	<div class="ja-ss-thumbs-wrap">
		<div class="ja-ss-thumbs"><!--
		<?php for ($i=0;$i<count($images); $i++): ?>
			--><div class="ja-ss-thumb">
				<img src="<?php echo $thumbArray[$i]?>" alt="Photo Thumbnail" />
			</div><!-- //ja-ss-thumb
		<?php endfor; ?>
		--></div>
	</div>
	<?php endif; ?>
	<?php if ($showNavigation): ?>
	<div class="ja-ss-btns clearfix">
		<i class="ja-ss-prev fa fa-angle-left"></i>
		<i class="ja-ss-next fa fa-angle-right"></i>
	</div>
	<?php endif; ?>
</div>
