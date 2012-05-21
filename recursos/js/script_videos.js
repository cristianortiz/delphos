$(document).ready(function() {
var base_url = 'http://localhost/delphos/';
//var base_url = 'http://146.83.74.15/delphos/';

  /*-------------------------------------------------------------------------------------------------------------
    Bloque JS para el plugin projekktor, llama al metodo carga_playlist delcontrolador home que carga la lista de
    reproduccion desde la BD en formato JSON para el reproductor
  ----------------------------------------------------------------------------------------------------------------*/ 
   projekktor('#player_a', {
	debug: false,
      // poster: 'intro.png',
      useYTIframeAPI: false, 
	width: 980,
	height: 570,
    playerFlashMP4:         base_url+'/recursos/js/jarisplayer.swf',
    playerFlashMP4:         base_url+'recursos/js/jarisplayer.swf',

	controls: true,
	playlist: [{0:{src:base_url+'/home/carga_playlist', type:"text/json"}}] 
    });  
});
