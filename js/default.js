$('document').ready(function() {
	if ($('.main_type_radio').length>0) {
		$('.main_type_radio').click(function() {
			$.ajax({
			  	url: $(this).data('service') + '/' + $(this).val(),
			}).done(function ( data ) {
			  	$('.fields_wrap').html(data);
			});
		});		
	}
});