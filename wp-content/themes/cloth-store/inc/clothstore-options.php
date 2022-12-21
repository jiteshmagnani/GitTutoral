<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Cloth_Store_Options' ) ) 
{
		class Cloth_Store_Options {
		public function __construct() 
		{
			if ( is_admin() ) {
				/* add_filter( 'use_block_editor_for_post', array( $this , 'disable_gutenberg' ) ); */
				add_action( 'admin_menu', array( $this , 'add_admin_menu' ) );
				add_action( 'admin_init', array( $this , 'register_settings' ) );
				add_action('admin_enqueue_scripts', array ( $this ,'wptuts_options_enqueue_scripts' ) );
				/* add_filter( 'wp_editor_settings', array ( $this ,'disable_media' ) ); */
			}
				add_filter( 'login_headerurl', array ( $this , 'login_Page_logo_url' ) );
				add_action( 'login_enqueue_scripts', array ( $this , 'my_login_logo' ) );
		}
		
		function my_login_logo() 
		{
			$website_logo_id = cloth_Store_Get_Theme_Option('website_logo_id');
			if( !empty ( $website_logo_id ) )
			{ ?>
				<style type="text/css">
				#login h1 a, .login h1 a 
				{
					background-image: url(<?php echo wp_get_attachment_url( $website_logo_id ); ?>);
					height:65px;
					width:320px;
					background-size: 320px 65px;
					background-repeat: no-repeat;
					padding-bottom: 30px;
				}
				</style>
		<?php } }
		
		function login_Page_logo_url() {
			return home_url();
		}
		
		/* function disable_gutenberg() 
		{
			return false;
		} */
		
		function disable_media($settings) {
			$settings['media_buttons']=FALSE;
			return $settings;
		}
		
		function wptuts_options_enqueue_scripts() 
		{
			if ( 'toplevel_page_cloth-store-options-settings' == get_current_screen() -> id ) 
			{
				wp_enqueue_media();
				wp_register_script('theme_options', get_template_directory_uri() .'/js/admin-upload.js', array('jquery'));
				wp_enqueue_script('theme_options');
			}
		}
		
		public static function get_theme_options() {
			return get_option( 'theme_options' );
		}
		
		public static function get_theme_option( $id ) {
			$options = self::get_theme_options();
			if ( isset( $options[$id] ) ) {
				return $options[$id];
			}
		}
		
		public static function add_admin_menu() {
			add_menu_page(
				esc_html__( 'Theme Settings', 'text-domain' ),
				esc_html__( 'Theme Settings', 'text-domain' ),
				'manage_options',
				'cloth-store-options-settings',
				array( 'Cloth_Store_Options', 'create_admin_page' )
			);
		}
		
		public static function register_settings() {
			register_setting( 'theme_options', 'theme_options', array( 'Cloth_Store_Options', 'sanitize' ) );
		}
		
		public static function sanitize( $options ) 
		{
			return $options;
		}
		
		public static function create_admin_page() { ?>
			<div class="wrap">

				<h1><?php esc_html_e( 'Cloth Store - Theme Options', 'text-domain' ); ?></h1>

				<form method="post" action="options.php">

					<?php settings_fields( 'theme_options' ); ?>

					<table class="form-table wpex-custom-admin-login-table">
						<tr valign="top">
							<td>
								<h3>Header Section</h3>
							</td>
						</tr>
						  <tr valign="top">
							<th scope="row"><?php esc_html_e( 'Logo', 'text-domain' ); ?></th>
							<td>
								<?php $website_logo_id = self::get_theme_option( 'website_logo_id' ); 
								$logo_flag = false;
								if( !empty ( $website_logo_id ) )
								{
									$logo_flag = true;
									$logo_url = wp_get_attachment_url( $website_logo_id );
								}
								?>
								<img class="upload_image" style="width:100px;height:100px;<?php echo !$logo_flag ? "display:none;" : ""; ?>" src="<?php echo $logo_url; ?>" />
								<input class="upload_image_id" type="hidden" name="theme_options[website_logo_id]" value="<?php echo $website_logo_id; ?>" />
								<input class="button upload_image_button" type="button" value="Upload Image" />
								<a href="javascript:void(0);" style="<?php echo !$logo_flag ? "display:none;" : ""; ?>" class="remove_logo">Remove</a>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><?php esc_html_e( 'Search Image', 'text-domain' ); ?></th>
							<td>
								<?php $search_img = self::get_theme_option( 'search_img' ); 
								$logo_flag = false;
								if( !empty ( $search_img ) )
								{
									$logo_flag = true;
									$logo_url = wp_get_attachment_url( $search_img );
								}
								?>
								<img class="upload_image" style="width:100px;height:100px;<?php echo !$logo_flag ? "display:none;" : ""; ?>" src="<?php echo $logo_url; ?>" />
								<input class="upload_image_id" type="hidden" name="theme_options[search_img]" value="<?php echo $search_img; ?>" />
								<input class="button upload_image_button" type="button" value="Upload Image" />
								<a href="javascript:void(0);" style="<?php echo !$logo_flag ? "display:none;" : ""; ?>" class="remove_logo">Remove</a>
							</td>
						</tr>
						
						<tr valign="top">
							<th scope="row"><?php esc_html_e( 'Cart Image', 'text-domain' ); ?></th>
							<td>
								<?php $cart_img = self::get_theme_option( 'cart_img' ); 
								$logo_flag = false;
								if( !empty ( $cart_img ) )
								{
									$logo_flag = true;
									$logo_url = wp_get_attachment_url( $cart_img );
								}
								?>
								<img class="upload_image" style="width:100px;height:100px;<?php echo !$logo_flag ? "display:none;" : ""; ?>" src="<?php echo $logo_url; ?>" />
								<input class="upload_image_id" type="hidden" name="theme_options[cart_img]" value="<?php echo $cart_img; ?>" />
								<input class="button upload_image_button" type="button" value="Upload Image" />
								<a href="javascript:void(0);" style="<?php echo !$logo_flag ? "display:none;" : ""; ?>" class="remove_logo">Remove</a>
							</td>
						</tr>
						
						<tr valign="top">
							<td>
								<h3>Banner Section</h3>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><?php esc_html_e( 'Banner 1', 'text-domain' ); ?></th>
							<td>
								<?php $banner_1 = self::get_theme_option( 'banner_1' ); 
								$logo_flag = false;
								if( !empty ( $banner_1 ) )
								{
									$logo_flag = true;
									$logo_url = wp_get_attachment_url( $banner_1 );
								}
								?>
								<img class="upload_image" style="width:100px;height:100px;<?php echo !$logo_flag ? "display:none;" : ""; ?>" src="<?php echo $logo_url; ?>" />
								<input class="upload_image_id" type="hidden" name="theme_options[banner_1]" value="<?php echo $banner_1; ?>" />
								<input class="button upload_image_button" type="button" value="Upload Image" />
								<a href="javascript:void(0);" style="<?php echo !$logo_flag ? "display:none;" : ""; ?>" class="remove_logo">Remove</a>
							</td>
						</tr>
						
						 
						 <tr valign="top">
							<th scope="row"><?php esc_html_e( 'Banner 2', 'text-domain' ); ?></th>
							<td>
								<?php $banner_2 = self::get_theme_option( 'banner_2' ); 
								$logo_flag = false;
								if( !empty ( $banner_2 ) )
								{
									$logo_flag = true;
									$logo_url = wp_get_attachment_url( $banner_2 );
								}
								?>
								<img class="upload_image" style="width:100px;height:100px;<?php echo !$logo_flag ? "display:none;" : ""; ?>" src="<?php echo $logo_url; ?>" />
								<input class="upload_image_id" type="hidden" name="theme_options[banner_2]" value="<?php echo $banner_2; ?>" />
								<input class="button upload_image_button" type="button" value="Upload Image" />
								<a href="javascript:void(0);" style="<?php echo !$logo_flag ? "display:none;" : ""; ?>" class="remove_logo">Remove</a>
							</td>
						</tr>

						<tr valign="top">
							<td>
								<h3>Footer Section</h3>
							</td>
						</tr>
						
						 <tr valign="top">
							<th scope="row"><?php esc_html_e( 'Logo', 'text-domain' ); ?></th>
							<td>
								<?php $foo_website_logo_id = self::get_theme_option( 'foo_website_logo_id' ); 
								$logo_flag = false;
								if( !empty ( $foo_website_logo_id ) )
								{
									$logo_flag = true;
									$logo_url = wp_get_attachment_url( $foo_website_logo_id );
								}
								?>
								<img class="upload_image" style="width:100px;height:100px;<?php echo !$logo_flag ? "display:none;" : ""; ?>" src="<?php echo $logo_url; ?>" />
								<input class="upload_image_id" type="hidden" name="theme_options[foo_website_logo_id]" value="<?php echo $foo_website_logo_id; ?>" />
								<input class="button upload_image_button" type="button" value="Upload Image" />
								<a href="javascript:void(0);" style="<?php echo !$logo_flag ? "display:none;" : ""; ?>" class="remove_logo">Remove</a>
							</td>
						</tr>
						
						 <tr valign="top">
							<th scope="row"><?php esc_html_e( 'Logo', 'text-domain' ); ?></th>
							<td>
								<?php $foo_website_content = self::get_theme_option( 'foo_website_content' ); 
								wp_editor( $foo_website_content, 'theme_options[foo_website_content]' );
								?>
								
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><?php esc_html_e( 'Copyright Text', 'text-domain' ); ?></th>
							<td>
								<?php $foo_website_copyright = self::get_theme_option( 'foo_website_copyright' ); ?>
								<textarea cols="90" rows="6" name="theme_options[foo_website_copyright]"><?php echo $foo_website_copyright; ?></textarea>
							</td>
						</tr>
						
						<tr valign="top">
							<th scope="row"><?php esc_html_e( 'Design By Text', 'text-domain' ); ?></th>
							<td>
								<?php $foo_website_designby = self::get_theme_option( 'foo_website_designby' ); ?>
								<textarea cols="90" rows="6" name="theme_options[foo_website_designby]"><?php echo $foo_website_designby; ?></textarea>
							</td>
						</tr>
						
						
					</table>
					<?php submit_button(); ?>
				</form>
			</div>
		<?php }

	}
}
new Cloth_Store_Options();

function cloth_Store_Get_Theme_Option( $id = '' ) {
	return Cloth_Store_Options::get_theme_option( $id );
}
