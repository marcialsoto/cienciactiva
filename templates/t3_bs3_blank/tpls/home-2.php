<?php
/**
 *------------------------------------------------------------------------------
 * @package	  T3 Framework for Joomla!
 *------------------------------------------------------------------------------
 * @copyright Copyright (C) 2004-2013 JoomlArt.com. All Rights Reserved.
 * @license	  GNU General Public License; http://www.gnu.org/licenses/gpl.html
 * @author		JoomlArt, JoomlaBamboo
 * 			      If you want to be come co-authors of this project, please follow
 * 			      our guidelines at http://t3-framework.org/contribute
 *------------------------------------------------------------------------------
 */


defined('_JEXEC') or die;
?>

<!DOCTYPE html>
<html lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>"
	  class='<jdoc:include type="pageclass" />'>

<head>
	<jdoc:include type="head" />
	<?php $this->loadBlock('head') ?>
	<?php $this->addCss('home') ?>
</head>

<body>

<div class="t3-wrapper content"> <!-- Need this wrapper for off-canvas menu. Remove if you don't use of-canvas -->

  <?php $this->loadBlock('header') ?>
<div class="inner">
  <?php $this->loadBlock('mainnav') ?>

  <?php $this->loadBlock('mainbody-home-2') ?>
</div>
</div>
<div class="t3-wrapper footer">
	<div class="inner">
	<?php $this->loadBlock('footer') ?>
	</div>
</div>


</body>
</html>
