<?php
/**
* @package   T3 Blank
* @copyright Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
* @license   GNU General Public License version 2 or later; see LICENSE.txt
*/

defined('_JEXEC') or die;
?>

<div class="home">

  <?php if ($this->countModules('mast-col')) : ?>
    <!-- HOME SL 1 -->
    <div class="wrap t3-sl t3-sl-1">
      <jdoc:include type="modules" name="<?php $this->_p('mast-col') ?>" style="raw" />
    </div>
    <!-- //HOME SL 1 -->
  <?php endif ?>

  <?php $this->loadBlock('mainbody-home-categorias-layout') ?>



</div>
