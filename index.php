<html>
<head>
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<? wp_head(); ?>

<style>

	img{
		max-width: 300px;
		height: auto;
	}
	.align{
		text-align: center;
	}

</style>

<?php
    global $woocommerce;
    $items = $woocommerce->cart->get_cart();

        foreach($items as $item => $values) { 
            $_product =  wc_get_product( $values['data']->get_id()); 
            echo "<b>".$_product->get_title().'</b>  <br> Quantity: '.$values['quantity'].'<br>'; 
            $price = get_post_meta($values['product_id'] , '_price', true);
            echo "  Price: ".$price."<br>";
        }
	
	
?>




<div class="container">
		<div class="row">
			<div class="col-md-12">
				<? $menu = menu_mass('menu'); ?>
				<? foreach($menu as $item): ?>
					<li><a href="<? echo $item['url'] ?>"><? echo $item['title'] ?></a></li>
				<? endforeach; ?>
			</div>
		</div>
		<div class="row">

<? $query = new WP_Query(array('post_type' => 'product')); ?>
<?php if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); ?>

	
			<div class="col-md-3 align">
				<? the_post_thumbnail(); ?>
				<a href="<? the_permalink(); ?>"><? the_title(); ?></a>
				<?php 
		
				global $product;
				
				$class = implode( ' ', array_filter( array(
								'button',
								'product_type_' . $product->product_type,
								$product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
								$product->supports( 'ajax_add_to_cart' ) ? 'ajax_add_to_cart' : ''
						) ) );
				
				?>
				<?php if($price_html = $product->get_price_html()) :?>
				<p><a data-quantity="1" data-product_id="<?php echo $product->id;?>" data-product_sku="<?php echo $product->get_sku();?>" class="item_add <?php echo $class;?>" href="<?php echo esc_url($product->add_to_cart_url())?>"><i></i> <span class=" item_price"><?php echo $price_html?></span></a></p>
				<?php endif;?>
				
			</div>
		

<?php endwhile; ?>
<!-- post navigation -->
<?php else: ?>
<!-- no posts found -->
<?php endif; ?>

</div>
</div>


<? wp_footer(); ?>
</body>
</html>