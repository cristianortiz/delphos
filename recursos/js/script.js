$(document).ready(function() {
	var base_url = 'http://localhost/delphos/';
	//var base_url = 'http://146.83.74.15/delphos/';
    
    var num_noticias_lateral = num_noticias_lateral();
   
 /*----------------------------------------------------------------------------- 
   Script que controla la cinta inferior de mensajes
   */
	$("#avisos").carouFredSel({
		direction: 'left',
		items: {
			visible: 1,
		},
		scroll: {
			fx: "cross",
			easing: "linear",
			duration: 15000,
			items: 1
		},
		auto: {
			pauseDuration: 10000,
			delay: 0
		}
	});
    
   /*------------------------------------------------------------------------
     script que controla las noticias que se muestran en el panel lateral
    */
	$("#lateral").carouFredSel({
		direction: 'down',
		items: {
			visible: num_noticias_lateral,
			minimum: 1
		},
		scroll: {
			fx: "cross",
			easing: "linear",
			duration: 8000,
			items: 1
		},
		auto: {
			pauseDuration: 6000,
			delay: 5000
		}
	});
    
    function num_noticias_lateral()  {
        var num_noticias = 0;
        $.ajax({
            url:  base_url + 'panel_lateral/num_noticias_lateral/',
            type: 'post',
            dataType: 'json',
            async: false,
            success: function(respuesta) {
                num_noticias = respuesta.num_noticias_lat;
            }
        });
       return num_noticias;
    }   
    
/*--------------------------------------------------------------------------------------------------------------------------
  Esta seccion controla las animaciones del panel principal, es un content rotator que sincroniza las imagenes y los textos 
   En dicho panel.
*/
	$(function() {
		var current = 1;
		var iterate = function() {
			var i = parseInt(current + 1);
			var lis = $('#rotmenu').children('li').size();
			if (i > lis) i = 1;
			display($('#rotmenu li:nth-child(' + i + ')'));
		}
		display($('#rotmenu li:first'));
		var slidetime = setInterval(iterate, 8000);
		$('#rotmenu li').bind('click', function(e) {
			clearTimeout(slidetime);
			display($(this));
			e.preventDefault();
		});

		function display(elem) {
			var $this = elem;
			var repeat = false;
			if (current == parseInt($this.index() + 1)) repeat = true;
			if (!repeat) $this.parent().find('li:nth-child(' + current + ') a').stop(true, true).animate({
				'marginRight': '-20px'
			}, 300, function() {
				$(this).animate({
					'opacity': '0.7'
				}, 700);
			});
			current = parseInt($this.index() + 1);
			var elem = $('a', $this);
			elem.stop(true, true).animate({
				'marginRight': '0px',
				'opacity': '1'
			}, 300);
			var info_elem = elem.next();
			$('#rot1 .title').animate({
				'left': '-420px',
				'opacity': '0.9'
			}, 300, 'easeOutCirc', function() {
				$('h3', $(this)).html(info_elem.find('.info_title').html());
				$(this).animate({
					'left': '0px'
				}, 900, 'easeInOutQuad');
			});
			$('#rot1 .heading').animate({
				'left': '800px',
				'top': '42px'
			}, 700, 'easeOutCirc', function() {
				$('h1', $(this)).html(info_elem.find('.info_heading').html());
				$(this).animate({
					'left': '0px'
				}, 500, 'easeInOutQuad');
			});
			$('#rot1 .description').animate({
				'bottom': '-270px'
			}, 500, 'easeOutCirc', function() {
				$('p', $(this)).html(info_elem.find('.info_description').html());
				$(this).animate({
					'bottom': '0px'
				}, 400, 'easeInOutQuad');
			})
			$('#rot1').prepend(
			$('<img/>', {
				style: 'opacity:0',
				className: 'bg'
			}).load(

			function() {
				$(this).animate({
					'opacity': '1'
				}, 600);
				$('#rot1 img:first').next().animate({
					'opacity': '0'
				}, 700, function() {
					$(this).remove();
				});
			}).attr('src', '/delphos/recursos/images/' + info_elem.find('.info_image').html()).attr('width', '1000').attr('height', '600'));
		}
	});


/*-------------------------------------------------------------------------------------------------------------
    Bloque JS para el plugin projekktor, llama al metodo carga_playlist delcontrolador home que carga la lista de
    reproduccion desde la BD en formato JSON para el reproductor
  ----------------------------------------------------------------------------------------------------------------*/
/*	projekktor('#player_a', {
		debug: true,
		// poster: 'intro.png',
		useYTIframeAPI: false,
		width: 970,
		height: 500,
		playerFlashMP4: base_url + 'recursos/js/jarisplayer.swf',
		controls: true,
		playlist: [{
			0: {
				src: base_url + 'home/carga_playlist',
				type: "text/json"
			}
		}]
	}, function(player) {
		player.addListener('done', function() {
			var mostrar = 'texto';
			$.ajax({
				url: base_url + 'panel_principal/cambiar_a_texto/',
				type: 'POST',
				data: {
					'id': '1',
					'opcion': 'texto'
                    
				},
				dataType: 'json',
				success: function(respuesta) {
					if (respuesta.status == 'succes') {
						document.location = base_url;
					}
				}
			});
			return false;
		});
	});
    
 
    
   jQuery.extend({
    recupera_tiempo: function() {
        var tiempo_texto = null;
        $.ajax({
            url:  base_url + 'panel_principal/recupera_tiempo/',
            type: 'post',
            dataType: 'json',
            async: false,
            success: function(respuesta) {
                tiempo_texto = respuesta.tiempo;
            }
        });
       return tiempo_texto;
    }
});

 
    

	
	$.timer($.recupera_tiempo(), function() {
		var opcion = 'video';
		$.ajax({
			url: base_url + 'panel_principal/cambiar_a_video/',
			type: 'POST',
			data: {
				'id': '1',
				'opcion': opcion
			},
			dataType: 'json',
			success: function(respuesta) {
				if (respuesta.status == 'succes') {
					document.location = base_url;
				}
			}
		});
		return false;
	})*/
});