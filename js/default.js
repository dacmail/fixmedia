$('document').ready(function() {
	if ($('.main_type_radio').length>0) {
		$('.main_type_radio').click(function() {
			var wrap = '#fields_' + $(this).data('count');
			$.ajax({
			  	url: $(this).data('service') + '/' + $(this).val(),
			}).done(function ( data ) {
			  	$(wrap).html(data);
			});
		});		
	}
});