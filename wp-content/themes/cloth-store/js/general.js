jQuery( ".search_product_popup" ).click(function() {
	jQuery('.product-search').toggle(500);
});
jQuery(document).ready(function(){
	jQuery(".slick-slider").slick({
		slidesToShow: 1,
		infinite:false,
		slidesToScroll: 1,
		autoplay: true,
		autoplaySpeed: 2000,
		dots: false,
		arrows: false
	});
	jQuery( document ).on( 'click', '.add-to-cart', function(e) {
		e.preventDefault();
		var $this = jQuery( this );
		var curr_product_id = $this.data('product-id');
		var data = {
			action: 'woocommerce_ajax_add_to_cart',
			product_id: curr_product_id,
			security: wc_add_to_cart_params.security
		};
		$.ajax({
            type: 'post',
            url: wc_add_to_cart_params.ajax_url,
            data: data,
            beforeSend: function (response) {
				$this.addClass('loading');
            },
            complete: function (response) {
				$this.removeClass('loading');
            },
            success: function (response) 
			{
                if ( response.error ) {
                    alert('Something went Wrong, Please try after some time');
                } else {
					jQuery( '.cart_cnt' ).text( response.cart_cnt );
                }
            },
        });
	});
});