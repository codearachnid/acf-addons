<?php

if ( !defined('ABSPATH') )
  die('-1');

?>
<div class="wrap">
	<div id="icon-edit" class="icon32 icon32-posts-acf"><br></div>
	<h2><?php _e('Advanced Custom Fields Addons','acf-field-loader'); ?></h2>

	<div class="notes">
        <p></p>
    </div>
    
    <form id="movies-filter" method="get">
        <input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>" />
        <?php $available_list->display(); ?>
    </form>

</div>
<style type="text/css">
	a.uninstall {
		background: url(<?php echo $this->acf->dir; ?>/images/button_remove.png) 0 0 no-repeat;
	}
	a.install {
		background: url(<?php echo $this->acf->dir; ?>/images/button_add.png) 0 0 no-repeat;
	}
</style>


