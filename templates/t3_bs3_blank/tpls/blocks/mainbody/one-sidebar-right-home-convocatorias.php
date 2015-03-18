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
    <div id="t3-content" class="t3-content col-xs-12 col-sm-8  col-md-9">
      <?php if($this->hasMessage()) : ?>
        <jdoc:include type="message" />
      <?php endif ?>

      <?php if ($this->countModules('conv--categ')) : ?>
        <!-- CATEGORIA DE CONVOCATORIAS -->
        <div class="conv--categ <?php $this->_c('conv--categ') ?>">
          <jdoc:include type="modules" name="<?php $this->_p('conv--categ') ?>" style="raw" />
        </div>
        <!-- //CATEGORIA DE CONVOCATORIAS -->
      <?php endif ?>
    </div>
    <!-- //MAIN CONTENT -->

    <!-- SIDEBAR RIGHT -->
    <div class="t3-sidebar t3-news-right col-xs-12 col-sm-4  col-md-3 <?php $this->_c($vars['sidebar']) ?>">
      <jdoc:include type="modules" name="<?php $this->_p($vars['sidebar']) ?>" style="T3Xhtml" />
    </div>
    <!-- //SIDEBAR RIGHT -->

  </div>
</div>
