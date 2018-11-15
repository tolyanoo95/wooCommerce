<?

add_theme_support( 'woocommerce' );

if ( is_cart() || is_checkout() ) {
    echo "This is the cart, or checkout page!";
}

register_nav_menus( array(
		'menu' => 'Menu',
	) );
	
	function menu_mass($name){
	
		$menu_name = $name; 

		if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ $menu_name ] ) ) {
			$menu = wp_get_nav_menu_object( $locations[ $menu_name ] );

			$menu_items = wp_get_nav_menu_items($menu->term_id);
			
			$menu = array();
			$count = 0;
			$count_sub = 0;
			foreach($menu_items as $item):
				if($item->menu_item_parent == 0):
					$menu[$count]['title'] =  $item->title;
					$menu[$count]['url'] = $item->url;
				endif;
				foreach($menu_items as $item_sub):
					if($item_sub->menu_item_parent == $item->db_id):
					$menu[$count]['sub'][$count_sub]['title'] = $item_sub->title;
						$menu[$count]['sub'][$count_sub]['url'] = $item_sub->url;
						$count_sub++;
					endif;
				endforeach;
				$count++;
			endforeach;
		}
		return $menu;
	}
	
	
	add_action('wp_ajax_woocommerce_ajax_add_to_cart', 'woocommerce_ajax_add_to_cart');
	add_action('wp_ajax_nopriv_woocommerce_ajax_add_to_cart', 'woocommerce_ajax_add_to_cart');
			
	function woocommerce_ajax_add_to_cart() {

		$product_id = apply_filters('woocommerce_add_to_cart_product_id', absint($_POST['product_id']));
		$quantity = empty($_POST['quantity']) ? 1 : wc_stock_amount($_POST['quantity']);
		$variation_id = absint($_POST['variation_id']);
		$passed_validation = apply_filters('woocommerce_add_to_cart_validation', true, $product_id, $quantity);
		$product_status = get_post_status($product_id);

		if ($passed_validation && WC()->cart->add_to_cart($product_id, $quantity, $variation_id) && 'publish' === $product_status) {

			do_action('woocommerce_ajax_added_to_cart', $product_id);

			if ('yes' === get_option('woocommerce_cart_redirect_after_add')) {
				wc_add_to_cart_message(array($product_id => $quantity), true);
			}

			WC_AJAX :: get_refreshed_fragments();
		} else {

			$data = array(
				'error' => true,
				'product_url' => apply_filters('woocommerce_cart_redirect_after_error', get_permalink($product_id), $product_id));

			echo wp_send_json($data);
		}

		wp_die();
	}
	
	add_action('wp_ajax_attr', 'test_function');
	add_action('wp_ajax_nopriv_attr', 'test_function');
	
	function test_function()
	{
		$product_get = new WC_Product_Variable( 16 );
		$product_attr = $product_get->get_available_variations();
		
		foreach($product_attr as $item)
		{
			$key = array_keys($item['attributes']);
			
			if(($_POST['attr1'] == $item['attributes'][$key[0]]) && ($_POST['attr2'] == $item['attributes'][$key[1]]))
			{
				$res = $item['variation_id'];
			}
		}
		
		echo $res;
		
		wp_die();
	}
	

	

// Display variations dropdowns on shop page for variable products
add_filter( 'woocommerce_loop_add_to_cart_link', 'woo_display_variation_dropdown_on_shop_page' );
 
function woo_display_variation_dropdown_on_shop_page() {
	 
 	global $product;
	if( $product->is_type( 'variable' )) {
	
	$attribute_keys = array_keys( $product->get_attributes() );
	?>
	
	<form class="variations_form cart" method="post" enctype='multipart/form-data' data-product_id="<?php echo absint( $product->id ); ?>" data-product_variations="<?php echo htmlspecialchars( json_encode( $product->get_available_variations() ) ) ?>">
		<?php do_action( 'woocommerce_before_variations_form' ); ?>
	
		<?php if ( empty( $product->get_available_variations() ) && false !== $product->get_available_variations() ) : ?>
			<p class="stock out-of-stock"><?php _e( 'This product is currently out of stock and unavailable.', 'woocommerce' ); ?></p>
		<?php else : ?>
			<table class="variations" cellspacing="0">
				<tbody>
					<?php foreach ( $product->get_variation_attributes() as $attribute_name => $options ) : ?>
						<tr>
							<td class="label"><label for="<?php echo sanitize_title( $attribute_name ); ?>"><?php echo wc_attribute_label( $attribute_name ); ?></label></td>
							<td class="value">
								<?php
									$selected = isset( $_REQUEST[ 'attribute_' . sanitize_title( $attribute_name ) ] ) ? wc_clean( urldecode( $_REQUEST[ 'attribute_' . sanitize_title( $attribute_name ) ] ) ) : $product->get_variation_default_attribute( $attribute_name );
									wc_dropdown_variation_attribute_options( array( 'options' => $options, 'attribute' => $attribute_name, 'product' => $product, 'selected' => $selected ) );
									echo end( $attribute_keys ) === $attribute_name ? apply_filters( 'woocommerce_reset_variations_link', '<a class="reset_variations" href="#">' . __( 'Clear', 'woocommerce' ) . '</a>' ) : '';
								?>
							</td>
						</tr>
					<?php endforeach;?>
				</tbody>
			</table>
	
			<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>
	
			<div class="single_variation_wrap">
				<?php
					/**
					 * woocommerce_before_single_variation Hook.
					 */
					do_action( 'woocommerce_before_single_variation' );
	
					/**
					 * woocommerce_single_variation hook. Used to output the cart button and placeholder for variation data.
					 * @since 2.4.0
					 * @hooked woocommerce_single_variation - 10 Empty div for variation data.
					 * @hooked woocommerce_single_variation_add_to_cart_button - 20 Qty and cart button.
					 */
					do_action( 'woocommerce_single_variation' );
	
					/**
					 * woocommerce_after_single_variation Hook.
					 */
					do_action( 'woocommerce_after_single_variation' );
				?>
			</div>
	
			<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
		<?php endif; ?>
	
		<?php do_action( 'woocommerce_after_variations_form' ); ?>
	</form>
		
	<?php } else {
		
	echo sprintf( '<a rel="nofollow" href="%s" data-quantity="%s" data-product_id="%s" data-product_sku="%s" class="%s">%s</a>',
			esc_url( $product->add_to_cart_url() ),
			esc_attr( isset( $quantity ) ? $quantity : 1 ),
			esc_attr( $product->id ),
			esc_attr( $product->get_sku() ),
			esc_attr( isset( $class ) ? $class : 'button' ),
			esc_html( $product->add_to_cart_text() )
		);
	
	}
	 
}
	
	
?>