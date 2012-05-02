$('document').ready(function() {
	if ($('.main_type_radio').length>0) {
		$('.main_type_radio').live('click', function() {
			var wrap = '#fields_' + $(this).data('count');
			$.ajax({
			  	url: $(this).data('service') + '/' + $(this).val(),
			}).done(function ( data ) {
			  	$(wrap).html(data);
			});
		});		
	}

	if ($('#add_more').length>0) {
		$('#add_more').click(function(e) {
			$.ajax({
			  	url: $(this).data('service') + '/' + $('.report_data').length,
			}).done(function ( data ) {
			  	$('#add_more').before(data);
			  	if ($('.report_data').length >= 3) {
			  		$('#add_more').hide();
			  	}
			});
			e.preventDefault();
		});		
	}
});
