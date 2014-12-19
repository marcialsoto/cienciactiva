<?php
/**
 * Random youtube video fancy zoom 
 *
 * @package Random youtube video fancy zoom
 * @subpackage Random youtube video fancy zoom
 * @version   3.3
 * @author    Gopi Ramasamy
 * @copyright Copyright (C) 2010 - 2014 www.gopiplus.com, LLC
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 *
 */

// no direct access
defined('_JEXEC') or die;

if ( ! empty($video) ) 
{
	foreach ( $video as $video ) 
	{ 
		?>
        <div class="gallery clearfix">
            <a href="<?php echo $video->videolink; ?>" rel="g_ywfz[gallery]" title=""> 
              <img src="<?php echo $video->imagepath; ?>" width="<?php echo $video->width; ?>" height="<?php echo $video->height; ?>" />
            </a> 
        </div>
        <?php
	}
}
?>
<script type="text/javascript">
jQuery(document).ready(function(){
	jQuery(".gallery a[rel^='g_ywfz']").g_ywfz({theme:'g_ywfz_theme'});
});
</script>