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
					var char = 120 - $(this).val().length;
					$(this).nextAll('.help').first().children('.charcount').html('Te quedan <strong>' + char + '</strong> caracteres.');
				});
				$('.sending .fields_wrap .row textarea').live('focus', function() {
					$(this).nextAll('.error').first().hide();
					$(this).nextAll('.help').first().show().css('display','block');
					var char = 400 - $(this).val().length;
					$(this).nextAll('.help').first().children('.charcount').html('Te quedan <strong>' + char + '</strong> caracteres.');
				});

				$('.sending .fields_wrap .row input').live('blur', function() {
					$(this).nextAll('.help').first().hide();
				});
				$('.sending .fields_wrap .row textarea').live('blur', function() {
					$(this).nextAll('.help').first().hide();
				});

				$('.textarea').live('keyup', function() {
			        var max = 400;
			        if  ($('.profile').length>0) {alert('hh');max=300;}
			        var len = $(this).val().length;
			        if (len >= max) {
			            $(this).nextAll('.help').first().children('.charcount').html('Has llegado al máximo de caracteres.');
			        }else {
			            var char = max - len;
			            $(this).nextAll('.help').first().children('.charcount').html('Te quedan <strong>' + char + '</strong> caracteres.');
			        }
			    });
			    $('.text').live('keyup', function() {
			        var max = 120;
			        var len = $(this).val().length;
			        if (len >= max) {
			            $(this).nextAll('.help').first().children('.charcount').html('Has llegado al máximo de caracteres.');
			        }else {
			            var char = max - len;
			            $(this).nextAll('.help').first().children('.charcount').html('Te quedan <strong>' + char + '</strong> caracteres.');
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

	if ($('.sending .row').length>0) {
		$('.textarea').live('keyup', function() {
	        var max = 400;
	        if ($('.profile').length>0) {max=300;}
	        var len = $(this).val().length;
	        if (len >= max) {
	            $(this).nextAll('.help').first().children('.charcount').text('Has llegado al máximo de caracteres.');
	        }else {
	            var char = max - len;
	            $(this).nextAll('.help').first().children('.charcount').text('Te quedan ' + char + ' caracteres.');
	        }
	    });
	    $('.text').live('keyup', function() {
	        var max = 120;
	        var len = $(this).val().length;
	        if (len >= max) {
	            $(this).nextAll('.help').first().children('.charcount').html('Has llegado al máximo de caracteres.');
	        }else {
	            var char = max - len;
	            $(this).nextAll('.help').first().children('.charcount').html('Te quedan <strong>' + char + '</strong> caracteres.');
	        }
	    });
		$('.sending .fields_wrap .row input').live('focus', function() {
			$(this).nextAll('.error').first().hide();
			$(this).nextAll('.help').first().show().css('display','block');
		});
		$('.sending .fields_wrap .row textarea').live('focus', function() {
			var max = 400;
	        if ($('.profile').length>0) {max=300;}
			$(this).nextAll('.error').first().hide();
			$(this).nextAll('.help').first().show().css('display','block');
			var char = max - $(this).val().length;
			$(this).nextAll('.help').first().children('.charcount').text('Te quedan ' + char + ' caracteres.');
		});
		$('.sending .fields_wrap .row input').live('focus', function() {
			$(this).nextAll('.error').first().hide();
			$(this).nextAll('.help').first().show().css('display','block');
			var char = 120 - $(this).val().length;
			$(this).nextAll('.help').first().children('.charcount').html('Te quedan <strong>' + char + '</strong> caracteres.');
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
					link.replaceWith($('<div class="fix_done">¡Hecho!</div>'));
					$('.count-' + link.attr('id')).text(data.total_votes);
					$('.action-title').html('<strong>¡Ya has hecho FIX!</strong> ¿Qué quieres hacer ahora?');
					$(".action-button.share").effect("pulsate", { times:4 }, 300);
				} else {
					alert(data.error);
				}
			});
			e.preventDefault();
		});
	}

	if ($('a.report_vote').length>0) {
		$('a.report_vote').click(function(e) {
			e.preventDefault();
			link = $(this);
			$.ajax({
				url: $(this).attr('href'),
				dataType: 'json'
			}).done(function ( data ) {
				if (data.valid) {
					//$('.vote-' + data.item_id).remove();
					$('.vote-' + data.item_id).each(function() {
						$(this).replaceWith('<span class="'+ $(this).attr('class') +'" id="'+ $(this).attr('id') +'">'+ $(this).text() +'</span>');
					});

					$('.count-' + link.attr('id')).text(data.total_votes);
					if (link.hasClass('up')) {
						if ($('a.fix_vote').length>0) {
							$('a.fix_vote').click();
						}
					}
				} else {
					alert(data.error);
				}
			});
			e.preventDefault();
		});
	}

	if ($('a.report_solved').length>0) {
		$('a.report_solved').click(function(e) {
			e.preventDefault();
			link = $(this);
			$.ajax({
				url: $(this).attr('href'),
				dataType: 'json'
			}).done(function ( data ) {
				if (data.valid) {
					$('.count-' + link.attr('id')).text(data.total_votes);
					link.next('.solved_counter').html('<span class="number">'+data.total_votes+'</span> ');
					if (data.total_votes==1)
						link.next('.solved_counter').append('persona dice que está arreglado');
					else
						link.next('.solved_counter').append('personas dicen que está arreglado');

					if (data.is_solved)
						link.closest('.subreport').first().addClass('solved');

					link.prev('.question').remove();
					$('.solved-' + data.item_id).remove();
				} else {
					alert(data.error);
				}
			});
			e.preventDefault();
		});
	}

	if ($('.report #sidebar').length>0) {
		if ($('#container').outerHeight()>$('#sidebar').outerHeight()) {
			$('#sidebar').scrollToFixed({
			    marginTop: 10,
			    limit: $('#footer').offset().top - $('#sidebar').outerHeight() - 10,
			});
		}
	}


	if ($('#header .user .welcome').length>0) {
		$('#header .user .welcome').click(function (e) {
			e.preventDefault();
			$('#header .user .user_info').toggle();
			$("#header .user .welcome").toggleClass("menu-open");
		});

		$("#header .user .user_info").mouseup(function() {
        	return false
        });
        $(document).mouseup(function(e) {
            if ($(e.target).parent("#header .user .welcome").length==0) {
                $("#header .user .welcome").removeClass("menu-open");
                $("#header .user .user_info").hide();
            }
        });
	}

	if ($('.tabs').length>0 && $('.tabs.notabs').length==0) {
		$('.tabs').tabs({select: function(e, ui) {
						    var tab = $(ui.tab);
						    var url = $.data(ui.tab, 'load.tabs');
						    if(url && tab.attr('data-ajax') == 'false')
						    {
						        location.href = url;
						        return false;
						    }
						    return true;
						}});
	}


	if ($(".action-button.share").length>0) {
		$(".action-button.share").colorbox({ iframe:true,
											width:"490px",
											height:"250px",
											opacity: "0.5",
											transition: 'none',
											onClosed:function(){window.location = $('#url_report').val();}
										});
		if ($(".action-button.share").hasClass('autoload')) {
			$(".action-button.share").click();
		}
	}
	if($('.static h2.toggle')) {
		$('.static h2.toggle').click(function() {
			$(this).next('.wrap-title').toggleClass('open');
		});
	}

});
