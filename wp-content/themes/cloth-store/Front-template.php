<?php 
/**
* Template Name: Full Width Page
*
* @package WordPress
* @subpackage Twenty_Fourteen
* @since Twenty Fourteen 1.0
*/
get_header();
/* Slider Start */
$banner_1 = cloth_Store_Get_Theme_Option('banner_1');
$banner_2 = cloth_Store_Get_Theme_Option('banner_2');
if( !empty ( $banner_1 ) || !empty ( $banner_1 ) ) { ?>
	<div class="slick-slider">
		<?php if( !empty ( $banner_1 ) ) { ?>
			<div class="element element-1">
				<img src="<?php echo wp_get_attachment_url( $banner_1 ); ?>" alt="<?php echo get_post_meta( $banner_1 , '_wp_attachment_image_alt', true); ?>" />
			</div>
		<?php } if( !empty ( $banner_2 ) ) { ?>
			<div class="element element-2">
				<img src="<?php echo wp_get_attachment_url( $banner_2 ); ?>" alt="<?php echo get_post_meta( $banner_2 , '_wp_attachment_image_alt', true); ?>" />
			</div>
		<?php } ?>
	</div>
<?php } ?>
<div class="container">
<?php
/* Slider Ends */
/* Latest Products Start */
echo "<h3>What is New?</h3>";
$args = array(
	'post_type' => 'product',
	'post_status' => 'publish',
	'orderby' => 'date',
	'order' => 'DESC',
	'posts_per_page' => 4
);
$the_query = new WP_Query( $args );
?>
<div class="cart-list-wrap">
<?php 
if ( $the_query->have_posts() ) {
	$featured_img = wc_placeholder_img_src();
	while ( $the_query->have_posts() ) { $the_query->the_post();
		
		if( has_post_thumbnail() )
		{
			$featured_img = get_the_post_thumbnail_url();
		} ?>
		<div class="cart-list">
		
		<a title="<?php echo get_the_title(); ?>" href="<?php echo get_the_permalink(); ?>">
			<img src="<?php echo $featured_img; ?>" title="<?php echo get_the_title(); ?>" alt="<?php echo get_the_title(); ?>" style="width:100px;height:100px;" />
		</a>
		
		<a href="javascript:void(0);" class="add-to-cart" data-product-id="<?php echo get_the_ID(); ?>">
			<img src="<?php echo home_url( '/' ); ?>wp-content/uploads/2022/08/Cart.png" alt="Cart"/>
		</a>
		<?php
		$cat = get_the_terms( get_the_ID() ,  'product_cat' );
		echo $cat[0]->name ?? "";
		echo get_woocommerce_currency_symbol() . get_post_meta( get_the_ID(), '_sale_price', true );
		echo get_woocommerce_currency_symbol() . get_post_meta( get_the_ID(), '_regular_price', true );
		echo "</div>";
	}
}
wp_reset_postdata();
?>
</div>
<?php 
/* Latest Products Ends */
/* Best Sellers Start */
echo "<h3>Best Sellers</h3>";
$args = array(
	'post_type' => 'product',
	'post_status' => 'publish',
    'meta_key' => 'total_sales',
    'orderby' => 'meta_value_num',
    'order' => 'DESC',
    'posts_per_page' => 8,
);
$the_query = new WP_Query( $args );
?>
<div class="cart-list-wrap">
<?php 
if ( $the_query->have_posts() ) {
	$featured_img = wc_placeholder_img_src();
	while ( $the_query->have_posts() ) 
	{ 
		$the_query->the_post();
		if( has_post_thumbnail() )
		{
			$featured_img = get_the_post_thumbnail_url();
		} ?>
		<div class="cart-list">
		<a title="<?php echo get_the_title(); ?>" href="<?php echo get_the_permalink(); ?>">
		<img src="<?php echo $featured_img; ?>" title="<?php echo get_the_title(); ?>" alt="<?php echo get_the_title(); ?>" style="width:100px;height:100px;" />
		</a>
		<a href="javascript:void(0);" class="add-to-cart" data-product-id="<?php echo get_the_ID(); ?>">
			<img src="<?php echo home_url( '/' ); ?>wp-content/uploads/2022/08/Cart.png" alt="Cart"/>
		</a>
		<?php
		$cat = get_the_terms( get_the_ID() ,  'product_cat' );
		echo $cat[0]->name ?? "";
		echo get_woocommerce_currency_symbol() . get_post_meta( get_the_ID(), '_sale_price', true );
		echo get_woocommerce_currency_symbol() . get_post_meta( get_the_ID(), '_regular_price', true );
		echo "</div>";
	}
}
wp_reset_postdata();
?>
</div>
<?php 
/* Best Sellers Ends */
/* Latest Blogs start */
echo "<h3>Latest blog</h3>";
$args = array(
	'post_type' => 'post',
	'post_status' => 'publish',
	'orderby' => 'date',
	'order' => 'DESC',
	'posts_per_page' => 3
);
$the_query = new WP_Query( $args ); ?>

<div class="latest-blog-list-wrap">
<?php 
if ( $the_query->have_posts() ) {
	$featured_img = home_url( '/' ) . 'wp-content/uploads/2022/08/no-image.jpg';
	while ( $the_query->have_posts() ) 
	{ 
		$the_query->the_post();
			if( has_post_thumbnail() )
			{
				$featured_img = get_the_post_thumbnail_url();
			} ?>
			<div class="latest-blog-list">
			<img src="<?php echo $featured_img; ?>" title="<?php echo get_the_title(); ?>" alt="<?php echo get_the_title(); ?>" style="width:100px;height:100px;" />
			<?php
			echo '<a href="'.get_the_permalink().'">'. get_the_title() . '</a>'; echo "<br/>";
			echo get_the_excerpt(); echo "<br/>";
			echo get_the_date('d M Y'); echo "<br/>";
			echo "</div>";
	}
}
wp_reset_postdata();
/* Latest Blogs Ends */ ?>
</div>
</div>
<?php get_footer(); ?>