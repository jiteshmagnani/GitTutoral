<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Cloth_Store_Functions' ) ) 
{
		class Cloth_Store_Functions 
		{
			public function __construct() 
			{
				add_filter( 'wp_nav_menu_items', array( $this , 'wti_loginout_menu_link' ) , 10, 2 );
				add_action('wp_ajax_woocommerce_ajax_add_to_cart', array( $this , 'woocommerce_ajax_add_to_cart' ) );
				add_action('wp_ajax_nopriv_woocommerce_ajax_add_to_cart', array( $this , 'woocommerce_ajax_add_to_cart' ) );
			}
			
			function woocommerce_ajax_add_to_cart() 
			{
				$data = array(
					'error' => false,
					'message' => ''
				);
				if ( ! check_ajax_referer( 'add-to-cart-clothstore-nonce', 'security', false ) ) 
				{
					wp_send_json_error( 'Invalid security token sent.' );
					wp_die();
				}
				$product_id = apply_filters('woocommerce_add_to_cart_product_id', absint($_POST['product_id']));
				$quantity = 1;
				$passed_validation = apply_filters('woocommerce_add_to_cart_validation', true, $product_id, $quantity);
				$product_status = get_post_status($product_id);
				if ($passed_validation && WC()->cart->add_to_cart( $product_id, $quantity ) && 'publish' === $product_status) 
				{
					do_action('woocommerce_ajax_added_to_cart', $product_id);
					$data['message'] = 'Cart Updated';
					$data['cart_cnt'] = WC()->cart->get_cart_contents_count();
				}
				else
				{
					$data['error'] = true;
				}
				echo wp_send_json($data);
				wp_die();
			}


			function wti_loginout_menu_link( $items , $args )
			{
				if ($args->theme_location == 'my_account_menu') 
				{
					$sign_Out ='';
					if (is_user_logged_in()) 
					{
						$myaccount_page = get_option( 'woocommerce_myaccount_page_id' );
						if ( $myaccount_page ) {
							$myaccount_page_url = get_permalink( $myaccount_page );
						}
						else
						{
							$myaccount_page_url = home_url( '/' );
						}
						$sign_Out = '<li class="right"><a href="'. wp_logout_url( $myaccount_page_url ) .'">'. __("Sign Out") .'</a></li>';
					}
					$items = $sign_Out . $items;
				}
				
				if ($args->theme_location == 'guest_menu') 
				{
					$sign_In ='';
					$myaccount_page = get_option( 'woocommerce_myaccount_page_id' );
					if ( $myaccount_page ) {
						$myaccount_page_url = get_permalink( $myaccount_page );
						$sign_In = '<li class="right"><a href="'. $myaccount_page_url .'">'. __("Sign In") .'</a></li>';
					}
					$items = $sign_In . $items;
				}
				return $items;
			}
			
		}
}
new Cloth_Store_Functions();