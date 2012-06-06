$('document').ready(function() {
	if ($('.main_type_radio').length>0) {
		$('.main_type_radio').live('click', function() {
			var wrap = '#fields_' + $(this).data('count');
			var input = $(this);
			$.ajax({
			  	url: $(this).data('service') + '/' + $(this).val() + '/' + $('.report_data').length,
			}).done(function ( data ) {
				// Cambio color de la caja que contiene al radio button
				input.closest('.wrap_types').find('.wrap_type').removeClass('active');
	    		input.parent('.wrap_type').addClass('active');
	    		//Introducimos los datos en 'wrap' y los mostramos
			  	$(wrap).html(data);
			  	$(wrap).show();
			  	if ($('.report_data').length < 3) { $('#add_more').show(); }
				$('#submit').show();
			  	$('.add_url').click(function(e) {
					$(this).closest('.fields_wrap').first().find('.urls').first().clone().insertAfter($(this).closest('.fields_wrap').first().find('.urls').last()).val('').attr('placeholder','http://');
					if ($(this).closest('.fields_wrap').first().find('.urls').length>=3) { $(this).hide();}
					e.preventDefault();
				});		
			});
		});		
	}
	if ($('.report_data').length < 3) { $('#add_more').show(); }
	if ($('.sending .fields_wrap').length>0) {
		$('.sending .fields_wrap .option input').live('click', function() {
			$(this).closest('.row').find('.option').removeClass('checked');
			$(this).parent().addClass('checked');
		});
	}
	if ($('#add_more').length>0) {
		$('#add_more').click(function(e) {
			$.ajax({
			  	url: $(this).data('service') + '/' + $('.report_data').length,
			}).done(function ( data ) {
			  	$('#add_more').before(data);
			  	$('#add_more').hide();
			});
			e.preventDefault();
		});		
	}

	if ($('.toggle_info').length>0) {
		$('.toggle_info').click(function(e) {
			$(this).next('.subreport_content').toggle();
			e.preventDefault();
		});
	}
	if ($('.add_url').length>0) {
		$('.add_url').click(function(e) {
			$(this).closest('.fields_wrap').first().find('.urls').first().clone().insertAfter($(this).closest('.fields_wrap').first().find('.urls').last()).val('').attr('placeholder','http://');
			if ($(this).closest('.fields_wrap').first().find('.urls').length>=3) { $(this).hide(); }
			e.preventDefault();
		});	
	}

	if ($('.sending .fields_wrap .wrap_error').length>0) {
		$('.sending .fields_wrap .wrap_error input').focus(function() {
			console.log('Focus');
			$(this).nextAll('.error').first().hide();
			$(this).nextAll('.help').first().show().css('display','block');
		});
		$('.sending .fields_wrap .wrap_error textarea').focus(function() {
			console.log('Focus');
			$(this).nextAll('.error').first().hide();
			$(this).nextAll('.help').first().show().css('display','block');
		});
	}

	if ($('#form_report').length>0) {
		$('#form_report').validate({
			rules:{
			    "type_info[]": "required"
			},
			messages: {
			    "type_info[]": "Debes seleccionar un tipo de corrección o ampliación"
			}, errorElement: "span", errorClass: "error"
		});
	}
});
