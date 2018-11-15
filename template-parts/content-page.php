<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>


<div class="dreamcrub">
			   	 <ul class="breadcrumbs">
                    <?php  woocommerce_breadcrumb();?>
                </ul>
                <div class="clearfix"></div>
			   </div>
			   <h2><?php the_title();?></h2>
			   
			   <?php the_content(); ?>