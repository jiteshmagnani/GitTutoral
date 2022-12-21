jQuery(document).ready(function($){
	$('.upload_image_button').click(function(e) {
		e.preventDefault();
		var custom_uploader;
		var current_ele = $(this);
		if (custom_uploader) {
			custom_uploader.open();
			return;
		}
		custom_uploader = wp.media.frames.file_frame = wp.media({
			title: 'Choose Image',
			button: {
				text: 'Choose Image'
		},
			multiple: false
		});
	
		custom_uploader.on('select', function() {
			attachment = custom_uploader.state().get('selection').first().toJSON();
			current_ele.prev('.upload_image_id').val(attachment.id);
			current_ele.prev().prev('.upload_image').attr('src',attachment.url).show();
			current_ele.next('.remove_logo').show();
		});
		custom_uploader.open();
	});
	$('.remove_logo').click(function(en) {
		en.preventDefault();
		$(this).prev().prev('.upload_image_id').val('');
		$(this).prev().prev().prev('.upload_image').hide();
		$(this).hide();
	});
});