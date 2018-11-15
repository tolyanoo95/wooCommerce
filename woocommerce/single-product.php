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
	
	
	
	//echo "<pre>";
	//print_r($items);
	//echo "</pre>";
	
	/*$srt = "[{'attributes':{'attribute_pa_diagonal':'12','attribute_pa_tsvet':'black'},'availability_html':'','backorders_allowed':false,'dimensions':{'length':'','width':'','height':''},'dimensions_html':'\u041d\/\u0414','display_price':10000,'display_regular_price':20000,'image':{'title':'83_1500x_1505364451','caption':'','url':'http:\/\/woo\/wp-content\/uploads\/2018\/10\/83_1500x_1505364451.jpg','alt':'','src':'http:\/\/woo\/wp-content\/uploads\/2018\/10\/83_1500x_1505364451-100x100.jpg','srcset':'http:\/\/woo\/wp-content\/uploads\/2018\/10\/83_1500x_1505364451-100x100.jpg 100w, http:\/\/woo\/wp-content\/uploads\/2018\/10\/83_1500x_1505364451-300x300.jpg 300w, http:\/\/woo\/wp-content\/uploads\/2018\/10\/83_1500x_1505364451-600x600.jpg 600w, http:\/\/woo\/wp-content\/uploads\/2018\/10\/83_1500x_1505364451-150x150.jpg 150w, http:\/\/woo\/wp-content\/uploads\/2018\/10\/83_1500x_1505364451-768x768.jpg 768w, http:\/\/woo\/wp-content\/uploads\/2018\/10\/83_1500x_1505364451-1024x1024.jpg 1024w, http:\/\/woo\/wp-content\/uploads\/2018\/10\/83_1500x_1505364451.jpg 1500w','sizes':'(max-width: 100px) 100vw, 100px','full_src':'http:\/\/woo\/wp-content\/uploads\/2018\/10\/83_1500x_1505364451.jpg','full_src_w':1500,'full_src_h':1500,'gallery_thumbnail_src':'http:\/\/woo\/wp-content\/uploads\/2018\/10\/83_1500x_1505364451-100x100.jpg','gallery_thumbnail_src_w':100,'gallery_thumbnail_src_h':100,'thumb_src':'http:\/\/woo\/wp-content\/uploads\/2018\/10\/83_1500x_1505364451-300x300.jpg','thumb_src_w':300,'thumb_src_h':300,'src_w':100,'src_h':100},'image_id':'10','is_downloadable':false,'is_in_stock':true,'is_purchasable':true,'is_sold_individually':'no','is_virtual':false,'max_qty':'','min_qty':1,'price_html':'<span class=\'price\'><del><span class=\'woocommerce-Price-amount amount\'><span class=\'woocommerce-Price-currencySymbol\'>&#8372;<\/span>20,000.00<\/span><\/del> <ins><span class=\'woocommerce-Price-amount amount\'><span class=\'woocommerce-Price-currencySymbol\'>&#8372;<\/span>10,000.00<\/span><\/ins><\/span>','sku':'','variation_description':'','variation_id':35,'variation_is_active':true,'variation_is_visible':true,'weight':'','weight_html':'\u041d\/\u0414'},
	         {'attributes':{'attribute_pa_diagonal':'12','attribute_pa_tsvet':'white'},'availability_html':'','backorders_allowed':false,'dimensions':{'length':'','width':'','height':''},'dimensions_html':'\u041d\/\u0414','display_price':500,'display_regular_price':1000,'image':{'title':'83_1500x_1505364451','caption':'','url':'http:\/\/woo\/wp-content\/uploads\/2018\/10\/83_1500x_1505364451.jpg','alt':'','src':'http:\/\/woo\/wp-content\/uploads\/2018\/10\/83_1500x_1505364451-100x100.jpg','srcset':'http:\/\/woo\/wp-content\/uploads\/2018\/10\/83_1500x_1505364451-100x100.jpg 100w, http:\/\/woo\/wp-content\/uploads\/2018\/10\/83_1500x_1505364451-300x300.jpg 300w, http:\/\/woo\/wp-content\/uploads\/2018\/10\/83_1500x_1505364451-600x600.jpg 600w, http:\/\/woo\/wp-content\/uploads\/2018\/10\/83_1500x_1505364451-150x150.jpg 150w, http:\/\/woo\/wp-content\/uploads\/2018\/10\/83_1500x_1505364451-768x768.jpg 768w, http:\/\/woo\/wp-content\/uploads\/2018\/10\/83_1500x_1505364451-1024x1024.jpg 1024w, http:\/\/woo\/wp-content\/uploads\/2018\/10\/83_1500x_1505364451.jpg 1500w','sizes':'(max-width: 100px) 100vw, 100px','full_src':'http:\/\/woo\/wp-content\/uploads\/2018\/10\/83_1500x_1505364451.jpg','full_src_w':1500,'full_src_h':1500,'gallery_thumbnail_src':'http:\/\/woo\/wp-content\/uploads\/2018\/10\/83_1500x_1505364451-100x100.jpg','gallery_thumbnail_src_w':100,'gallery_thumbnail_src_h':100,'thumb_src':'http:\/\/woo\/wp-content\/uploads\/2018\/10\/83_1500x_1505364451-300x300.jpg','thumb_src_w':300,'thumb_src_h':300,'src_w':100,'src_h':100},'image_id':'10','is_downloadable':false,'is_in_stock':true,'is_purchasable':true,'is_sold_individually':'no','is_virtual':false,'max_qty':'','min_qty':1,'price_html':'<span class=\'price\'><del><span class=\'woocommerce-Price-amount amount\'><span class=\'woocommerce-Price-currencySymbol\'>&#8372;<\/span>1,000.00<\/span><\/del> <ins><span class=\'woocommerce-Price-amount amount\'><span class=\'woocommerce-Price-currencySymbol\'>&#8372;<\/span>500.00<\/span><\/ins><\/span>','sku':'','variation_description':'','variation_id':36,'variation_is_active':true,'variation_is_visible':true,'weight':'','weight_html':'\u041d\/\u0414'}]";
	
	$srt = explode("attributes",$srt);
	//echo "<pre>";
	//print_r($srt);
	//echo "</pre>";
	
	$srt2 = explode("'variation_id':",$srt[1]);
	
	echo "<pre>";
	print_r($srt2);
	echo "</pre>";
	
	$haystack = $srt[1];
	$needle   = "'attribute_pa_diagonal':'12','attribute_pa_tsvet':'black'";

	$pos = strripos($haystack, $needle);
	
	if ($pos === false) {
		echo "К сожалению, //($needle) не найдена в ($haystack)";
	} else {
		echo "Поздравляем!\n";
		//echo "Последнее вхождение ($needle) найдено в ($haystack) в позиции ($pos)";
	}*/

	
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

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

	
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
			<div class="col-md-9">
				<?
					
					//$attr = $product->get_attribute;
					
					echo $product->get_attribute('diagonal');
					
					$attributes = $product->get_attributes();

				   foreach($attributes as $attr=>$attr_deets){

					   $attribute_label = wc_attribute_label($attr);

					   if ( isset( $attributes[ $attr ] ) || isset( $attributes[ 'pa_' . $attr ] ) ) {

						   $attribute = isset( $attributes[ $attr ] ) ? $attributes[ $attr ] : $attributes[ 'pa_' . $attr ];

						   if ( $attribute['is_taxonomy'] ) {

							   $formatted_attributes[$attribute_label] = wc_get_product_terms( $product->id, $attribute['name']);

						   } else {

							   $formatted_attributes[$attribute_label] = $attribute['value'];
						   }

					   }
				   }


				   print_r($formatted_attributes);
				?>
				
				<?
					$attachment_ids = $product->get_gallery_attachment_ids();

					foreach( $attachment_ids as $attachment_id ) {
						echo $image_link = wp_get_attachment_url( $attachment_id );
					}
				?>
				
				
				
				<? if ( $product->is_in_stock() ) : ?>

					<?php do_action( 'woocommerce_before_add_to_cart_form' ); ?>

					<form class="cart" action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>" method="post" enctype='multipart/form-data'>
						<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>

						<?php
						do_action( 'woocommerce_before_add_to_cart_quantity' );

						woocommerce_quantity_input( array(
							'min_value'   => apply_filters( 'woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product ),
							'max_value'   => apply_filters( 'woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product ),
							'input_value' => isset( $_POST['quantity'] ) ? wc_stock_amount( wp_unslash( $_POST['quantity'] ) ) : $product->get_min_purchase_quantity(), // WPCS: CSRF ok, input var ok.
						) );

						do_action( 'woocommerce_after_add_to_cart_quantity' );
						?>

						<button type="submit" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>" class="single_add_to_cart_button button alt"><?php echo esc_html( $product->single_add_to_cart_text() ); ?></button>
						
						

						<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
					</form>

					<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>

				<?php endif; ?>
				
				<!--Вариации--->
				
				<? 
					//$product1 = new WC_Product_Variable( 16 );
					//$product2 = $product1->get_available_variations();
					
				?>
				
				<?
					if ($product->is_type( 'variable' )) 
					{
						$available_variations = $product->get_available_variations();
						
						foreach ($available_variations as $key) 
						{ 
							//echo $key['attributes']['attribute_pa_diagonal'];
						}
					
						echo "<pre>";
						//print_r($available_variations);
						echo "</pre>";
					}
				
				?>
				
				
				
				<? woo_display_variation_dropdown_on_shop_page() ?>
				
				<button class="btn1">ATTR</button>		
				
				
				
			</div>
		

<?php endwhile; ?>
<!-- post navigation -->
<?php else: ?>
<!-- no posts found -->
<?php endif; ?>

</div>
</div>


<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>

<script>

(function ($) {
	
    $(document).on('click', '.single_add_to_cart_button', function (e) {
        e.preventDefault();

        var $thisbutton = $(this),
                $form = $thisbutton.closest('form.cart'),
                id = $thisbutton.val(),
                product_qty = $form.find('input[name=quantity]').val() || 1,
                product_id = $form.find('input[name=product_id]').val() || id,
                variation_id = $form.find('input[name=variation_id]').val() || 0;

        var data = {
            action: 'woocommerce_ajax_add_to_cart',
            product_id: product_id,
            product_sku: '',
            quantity: product_qty,
            variation_id: variation_id,
        };

        $(document.body).trigger('adding_to_cart', [$thisbutton, data]);

        $.ajax({
            type: 'post',
            url: wc_add_to_cart_params.ajax_url,
            data: data,
            beforeSend: function (response) {
                $thisbutton.removeClass('added').addClass('loading');
            },
            complete: function (response) {
                $thisbutton.addClass('added').removeClass('loading');
            },
            success: function (response) {

                if (response.error & response.product_url) {
                    window.location = response.product_url;
                    return;
                } else {
                    $(document.body).trigger('added_to_cart', [response.fragments, response.cart_hash, $thisbutton]);
                }
            },
        });

        return false;
    });
})(jQuery);

jQuery(function(){
	
	$('#pa_diagonal').change(function(){
		
		
		var option1 = $(this).val();
		var option2 = $('#pa_tsvet').val();
		
		
		
		$.ajax({
			
			url: "<?  echo admin_url('admin-ajax.php') ?>",
			type: 'POST',
			data:{
				action: 'attr',
				attr1: option1,
				attr2: option2,
			},
			beforeSend: function(){
				//alert('Загрузка')
			},
			success: function(data){
				alert(data);
			},
			error: function (error) {
				alert(error);
			}
			
		});
		
	});
	
});

</script>
<? wp_footer(); ?>
</body>
</html>