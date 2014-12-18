<?php
/**
 * @package   T3 Blank
 * @copyright Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license   GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
?>

<div class="home">

	<?php if ($this->countModules('slider-main') || $this->countModules('sidebar-main')) : ?>
		<!-- HOME SL 1 -->
		<div class="wrap t3-sl t3-sl-1 <?php $this->_c('slider-main') ?>">
			<div class="container">
				<div class="col-sm-8 main">
					<jdoc:include type="modules" name="<?php $this->_p('slider-main') ?>" style="raw" />
					<?php if ($this->countModules('content-convocatorias') || $this->countModules('banner-main')) : ?>
						<div class="row">
							<?php if ($this->checkSpotlight('feed', 'content-convocatorias')) : ?>
							<div class="col-sm-8 col-xs-12 convocatorias t3-sidebar">
								<div class="t3-module">
									<div class="module-inner">
										<h3 class="module-title">Convocatorias Abiertas</h3>
										<div class="row">
											<div class="col-sm-6 col-xs-6 convocatoria">
												<jdoc:include type="modules" name="<?php $this->_p('content-convocatorias') ?>" style="raw" />
											</div>
											<div class="col-sm-6 col-xs-6 thumb">
												<jdoc:include type="modules" name="<?php $this->_p('content-convocatorias-img') ?>" style="raw" />
											</div>
										</div>

									</div>
								</div>
							</div>
						<?php endif ?>
							<?php if ($this->checkSpotlight('banner', 'banner-main')) : ?>
								<div class="col-sm-4  col-xs-12 banner t3-sidebar">
									<?php $this->spotlight('banner', 'banner-main') ?>
								</div>
							<?php endif ?>
						</div>
					<?php endif ?>
				</div>
				<div class="col-sm-4 noticias t3-sidebar">
					<?php if ($this->checkSpotlight('feed1', 'sidebar-main')) : ?>
						<?php $this->spotlight('feed1', 'sidebar-main') ?>
					<?php endif ?>
					<?php if ($this->checkSpotlight('feed2', 'sidebar-video')) : ?>
						<?php $this->spotlight('feed2', 'sidebar-video') ?>
					<?php endif ?>
				</div>
			</div>
		</div>
		<!-- //HOME SL 1 -->
	<?php endif ?>
</div>
