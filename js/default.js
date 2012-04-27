$('document').ready(function() {
	if ($('.subtype_list').length>0) {
		$('.subtype_list').hide();
		$('.main_type_radio').click(function() {
			$('.subtype_list').hide();
			var subtype = '#subtype_' + $(this).val();
			$(subtype).show(); 
		});		
	}
});