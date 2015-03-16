<?php
/**
 * @package   T3 Blank
 * @copyright Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license   GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
?>

<!-- FOOTER -->
<footer id="t3-footer" class="wrap t3-footer">

	<?php if ($this->checkSpotlight('footnav', 'footer-1, footer-2, footer-3, footer-4, footer-5, footer-6')) : ?>
		<!-- FOOT NAVIGATION -->
		<div class="container">
			<div class="social__links">
					<?php if ($this->countModules('menu--social')) : ?>
						<!-- SOCIAL MENU -->
						<div class="menu--social <?php $this->_c('menu--social') ?>">
							<jdoc:include type="modules" name="<?php $this->_p('menu--social') ?>" style="raw" />
						</div>
						<!-- //SOCIAL MENU -->
					<?php endif ?>
			</div>
			<?php if ($this->countModules('menu--social')) : ?>
				<!-- SPONSORS LINKS -->
				<div class="row sponsors">
				<div class="sponsors--links <?php $this->_c('sponsors--links') ?>">
					<jdoc:include type="modules" name="<?php $this->_p('sponsors--links') ?>" style="raw" />
				</div>
				<!-- //SPONSORS LINKS -->
			</div>
			<?php endif ?>

			<?php $this->spotlight('footnav', 'footer-1, footer-2, footer-3, footer-4, footer-5, footer-6') ?>
		</div>
		<!-- //FOOT NAVIGATION -->
	<?php endif ?>

	<section class="t3-copyright">
		<div class="container">
			<div class="row">
				<div class="<?php echo $this->getParam('t3-rmvlogo', 1) ? 'col-md-8' : 'col-md-12' ?> copyright <?php $this->_c('footer') ?>">
					<jdoc:include type="modules" name="<?php $this->_p('footer') ?>" />
				</div>
				<?php if ($this->getParam('t3-rmvlogo', 1)): ?>
					<div class="col-md-4 poweredby text-hide">
						<a class="t3-logo t3-logo-color" href="http://t3-framework.org" title="<?php echo JText::_('T3_POWER_BY_TEXT') ?>"
						   target="_blank" <?php echo method_exists('T3', 'isHome') && T3::isHome() ? '' : 'rel="nofollow"' ?>><?php echo JText::_('T3_POWER_BY_HTML') ?></a>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</section>

</footer>
<!-- //FOOTER -->
