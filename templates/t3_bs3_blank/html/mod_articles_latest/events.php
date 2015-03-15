<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_articles_latest
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
?>
<ul class="media-list latestnews<?php echo $moduleclass_sfx; ?>" itemscope itemtype="http://schema.org/Event">
	<?php foreach ($list as $item) :  ?>
		<li class="media">
			<?php
				$dia = JHtml::_('date', $item->created, "d");
				$mes = JHtml::_('date', $item->created, "M");
				$anio = JHtml::_('date', $item->created, "Y");
			?>
		<div class="media-left" itemprop="Date">
			<?php echo '<span class="day">' . $dia .'</span>' . '<br><span class="month">' . $mes . '</span>'; ?>
		</div>
		<div class="media-body">
			<h4 class="media-heading">
				<a href="/<?php echo $item->link; ?>" itemprop="url">
					<span itemprop="name">
						<?php echo $item->title; ?>
					</span>
				</a>
			</h4>
			<p>
				<a href="/<?php echo $item->link; ?>" itemprop="url">
					<span itemprop="name">
						Más detalles
					</span>
				</a>
			</p>
		</div>
	</li>
	<?php endforeach; ?>
</ul>
