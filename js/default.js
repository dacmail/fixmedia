$('document').ready(function() {
	if ($('.main_type_radio').length>0) {
		$('.main_type_radio').live('click', function() {
			var wrap = '#fields_' + $(this).data('count');
			var input = $(this);
			$.ajax({
				url:$(this).data('service')+'/'+$(this).val()+'/'+$('.report_data').length
			}).done(function ( data ) {
				// Cambio color de la caja que contiene al radio button
				input.closest('.wrap_types').find('.wrap_type').removeClass('active');
				input.parent('.wrap_type').addClass('active');
				//Introducimos los datos en 'wrap' y los mostramos
				$(wrap).html(data);
				$(wrap).show();
				if ($('.report_data').length < 3) { $('#add_more').show(); }
				$('#submit').show();

				//Mostramos las ayudas en el focus y las ocultamos en blur
				$('.sending .fields_wrap .row input').live('focus', function() {
					$(this).nextAll('.error').first().hide();
					$(this).nextAll('.help').first().show().css('display','block');
				});
				$('.sending .fields_wrap .row textarea').live('focus', function() {
					$(this).nextAll('.error').first().hide();
					$(this).nextAll('.help').first().show().css('display','block');
					var char = 350 - $(this).val().length;
					$(this).nextAll('.help').first().children('.charcount').text('Te quedan ' + char + ' caracteres.');
				});

				$('.sending .fields_wrap .row input').live('blur', function() {
					$(this).nextAll('.help').first().hide();
				});
				$('.sending .fields_wrap .row textarea').live('blur', function() {
					$(this).nextAll('.help').first().hide();
				});

				$('.textarea').live('keyup', function() {
			        var max = 350;
			        var len = $(this).val().length;
			        if (len >= max) {
			            $(this).nextAll('.help').first().children('.charcount').text('Has llegado al máximo de caracteres.');
			        }else {
			            var char = max - len;
			            $(this).nextAll('.help').first().children('.charcount').text('Te quedan ' + char + ' caracteres.');
			        }
			    });
			});
		});
		$('.add_url').live('click', function(e) {
			$(this).closest('.fields_wrap').first().find('.urls').first().clone().insertAfter($(this).closest('.fields_wrap').first().find('.urls').last()).val('').attr('placeholder','http://');
			if ($(this).closest('.fields_wrap').first().find('.urls').length>=3) { $(this).hide(); }
			e.preventDefault();
		});
	}
	if ($('.editing .report_data').length < 3 && $('.editing .report_data').length > 0) { $('#add_more').show();}
	if ($('.sending .fields_wrap').length>0) {
		$('.sending .fields_wrap .option input').live('click', function() {
			$(this).closest('.row').find('.option').removeClass('checked');
			$(this).parent().addClass('checked');
		});
	}
	if ($('#add_more').length>0) {
		$('#add_more').click(function(e) {
			$.ajax({
				url: $(this).data('service') + '/' + $('.report_data').length
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
			$(this).text($(this).text() == 'Mostrar detalles y fuentes' ? 'Ocultar detalles y fuentes' : 'Mostrar detalles y fuentes');
			$(this).toggleClass('show');
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

	if ($('.sending .fields_wrap .row').length>0) {
		$('.textarea').live('keyup', function() {
	        var max = 350;
	        var len = $(this).val().length;
	        if (len >= max) {
	            $(this).nextAll('.help').first().children('.charcount').text('Has llegado al máximo de caracteres.');
	        }else {
	            var char = max - len;
	            $(this).nextAll('.help').first().children('.charcount').text('Te quedan ' + char + ' caracteres.');
	        }
	    });
		$('.sending .fields_wrap .row input').live('focus', function() {
			$(this).nextAll('.error').first().hide();
			$(this).nextAll('.help').first().show().css('display','block');
		});
		$('.sending .fields_wrap .row textarea').live('focus', function() {
			$(this).nextAll('.error').first().hide();
			$(this).nextAll('.help').first().show().css('display','block');
			var char = 350 - $(this).val().length;
			$(this).nextAll('.help').first().children('.charcount').text('Te quedan ' + char + ' caracteres.');
		});
		$('.sending .fields_wrap .row input').live('blur', function() {
			$(this).nextAll('.help').first().hide();
		});
		$('.sending .fields_wrap .row textarea').live('blur', function() {
			$(this).nextAll('.help').first().hide();
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

	if ($('a.fix_vote').length>0) {
		$('a.fix_vote').click(function(e) {
			link = $(this);
			$.ajax({
				url: $(this).attr('href'),
				dataType: 'json'
			}).done(function ( data ) {
				if (data.valid) {
					link.remove();
					link.replaceWith($('<div class="' + link.attr('class') + '">' + link.html() + '</div>'));		
					$('.count-' + link.attr('id')).text(data.total_votes);
				} else {
					alert(data.error);
				}
			});
			e.preventDefault();
		});
	}

	if ($('a.report_vote').length>0) {
		$('a.report_vote').click(function(e) {
			link = $(this);
			$.ajax({
				url: $(this).attr('href'),
				dataType: 'json'
			}).done(function ( data ) {
				if (data.valid) {
					$('.vote-'+data.item_id).remove();
					$('.count-' + link.attr('id')).text(data.total_votes);
				} else {
					alert(data.error);
				}
			});
			e.preventDefault();
		});
	}

	if ($('.button.icon.share').length>0) {
		$('.button.icon.share').click(function() {
			alert('Este botón mostrará las opciones para compartir el envío. Estará disponible en la próxima versión.');
		});
	}


	if ($('.report #sidebar').length>0) {
		offset = $('.report #sidebar').offset();
		$(window).scroll(function(){	
			if( $(window).scrollTop() > (offset.top-10) ) 		
				$('.report #sidebar').css({'position':'fixed', 'margin-left':'680px', 'top':'10px'});
			else
				$('.report #sidebar').css({'position':'relative', 'margin-left':'0px', 'top':'0px'});				
		});
	}	

});
