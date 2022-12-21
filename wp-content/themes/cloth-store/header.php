<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Cloth_Store
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'cloth-store' ); ?></a>
	<header id="masthead" class="site-header">
		<div class="container">
			<div class="site-branding">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php bloginfo( 'name' ); ?>">
					<?php
					$website_logo_id = cloth_Store_Get_Theme_Option('website_logo_id');
					if( !empty ( $website_logo_id ) )
					{
					?>
					<img src="<?php echo wp_get_attachment_url( $website_logo_id ); ?>" alt="<?php echo get_post_meta( $website_logo_id , '_wp_attachment_image_alt', true); ?>" />
					<?php } else {
						echo bloginfo( 'name' );
					} ?>
				</a>
			</div>
			<nav id="site-navigation" class="main-navigation">
				<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'cloth-store' ); ?></button>
				<?php $search_img = cloth_Store_Get_Theme_Option('search_img'); 
				if( !empty ( $search_img ) ) { ?>
					<a class="search_product_popup">
						<img src="<?php echo wp_get_attachment_url( $search_img ); ?>" alt="<?php echo get_post_meta( $search_img , '_wp_attachment_image_alt', true); ?>" />
					</a>
					<div class="product-search d-none">
						<?php echo get_product_search_form(); ?> 
					</div>
				<?php
				}
				wp_nav_menu(
					array(
						'theme_location' => 'primary_menu',
					)
				);
				$cart_img = cloth_Store_Get_Theme_Option('cart_img'); if( !empty ( $cart_img ) ) { ?>
				<a title="Cart" href="<?php echo get_permalink( woocommerce_get_page_id( 'cart' ) ); ?>">
					<span class="cart_cnt"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
					<img src="<?php echo wp_get_attachment_url( $cart_img ); ?>" alt="<?php echo get_post_meta( $cart_img , '_wp_attachment_image_alt', true); ?>" />
				</a>
				<?php } ?>
			</nav>
		</div>
	</header>