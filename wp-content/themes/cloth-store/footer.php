<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Cloth_Store
 */

?>
	<footer id="colophon" class="site-footer">
		<div class="container">
		<div class="site-info">
			<?php $foo_website_logo_id = cloth_Store_Get_Theme_Option('foo_website_logo_id');
				if( !empty ( $foo_website_logo_id ) ) { ?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php bloginfo( 'name' ); ?>">
						<img src="<?php echo wp_get_attachment_url( $foo_website_logo_id ); ?>" alt="<?php echo get_post_meta( $foo_website_logo_id , '_wp_attachment_image_alt', true); ?>" />
					</a>
			<?php }
			$foo_website_content = cloth_Store_Get_Theme_Option('foo_website_content');
			if( !empty ( $foo_website_content ) ) { ?>
				<div class="site-info">
					<?php echo $foo_website_content; ?>
				</div>
			<?php
			}
			$menu_id = get_nav_menu_locations()[ 'information_menu' ];
			if( $menu_id != 0 )
			{
				echo wp_get_nav_menu_object( $menu_id ) -> name;
				wp_nav_menu(
					array(
						'theme_location' => 'information_menu',
					)
				);
			}
			
			$menu_id = get_nav_menu_locations()[ 'why_choose_menu' ];
			if( $menu_id != 0 )
			{
				echo wp_get_nav_menu_object( $menu_id ) -> name;
				wp_nav_menu(
					array(
						'theme_location' => 'why_choose_menu',
					)
				);
			}
			$theme_location = 'guest_menu'; /* for Guest Users */
			if (is_user_logged_in()) 
			{
				$theme_location = 'my_account_menu'; /* for registered Users */
			}
			
			$menu_id = get_nav_menu_locations()[ $theme_location ];
			if( $menu_id != 0 )
			{
				echo "My Account";
				wp_nav_menu(
					array(
						'theme_location' => $theme_location
					)
				);
			}
			?>
			<div class="footer-bottom">
				<?php echo !empty ( cloth_Store_Get_Theme_Option('foo_website_copyright') ) ? "<p>" . cloth_Store_Get_Theme_Option('foo_website_copyright') . "</p>" : ""; ?>
				<?php echo !empty ( cloth_Store_Get_Theme_Option('foo_website_designby') ) ? "<p>" . cloth_Store_Get_Theme_Option('foo_website_designby') . "</p>" : ""; ?>
			</div>
		</div>
		</div>
	</footer>
</div>
<?php wp_footer(); ?>
</body>
</html>