<?php while(have_posts()): the_post() ?>
		
			<?php if(is_cart() || is_checkout() || is_account_page()) :?>
				
				<?php get_template_part( 'template-parts/content', 'page');?>
			
			<?php endif; ?>
		
		<?php endwhile;?>