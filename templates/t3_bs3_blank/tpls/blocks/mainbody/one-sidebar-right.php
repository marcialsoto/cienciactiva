<?php
/**
 * @package   T3 Blank
 * @copyright Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license   GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/**
 * Mainbody 2 columns: content - sidebar
 */
?>
<div id="content__title">
	<div class="container">
		<div class="row">
	<div class="t3-content col-xs-12 col-sm-12 col-md-12">
	<div class="page-header">
		<h3>Encuentra la oportunidad a tu medida</h3>
	</div>
</div>
	</div>
</div>
</div>

<div id="t3-mainbody" class="container t3-mainbody">
	<div class="row">

		<!-- MAIN CONTENT -->
		<div id="t3-content" class="t3-content col-xs-12 col-sm-8  col-md-8">
			<?php if($this->hasMessage()) : ?>
			<jdoc:include type="message" />
			<?php endif ?>
			<?php /** <jdoc:include type="component" /> */ ?>
			<?php if ($this->countModules('tabs--main')) : ?>
				<!-- HEADER SELECT MENU -->
				<div class="tabs--main <?php $this->_c('tabs--main') ?>">
					<jdoc:include type="modules" name="<?php $this->_p('tabs--main') ?>" style="raw" />
				</div>
				<!-- //HEADER SELECT MENU -->
			<?php endif ?>

			<?php if ($this->countModules('news--main')) : ?>
				<!-- HEADER SELECT MENU -->
				<div class="news--main <?php $this->_c('news--main') ?>">
					<div class="page-header">
						<h3><span>Noticias</span></h3>
					</div>
					<jdoc:include type="modules" name="<?php $this->_p('news--main') ?>" style="raw" />
				</div>
				<!-- //HEADER SELECT MENU -->
			<?php endif ?>
		</div>
		<!-- //MAIN CONTENT -->

		<!-- SIDEBAR RIGHT -->
		<div class="t3-sidebar t3-news-right col-xs-12 col-sm-4  col-md-4 <?php $this->_c($vars['sidebar']) ?>">
			<jdoc:include type="modules" name="<?php $this->_p($vars['sidebar']) ?>" style="T3Xhtml" />
		</div>
		<!-- //SIDEBAR RIGHT -->

	</div>
</div>
