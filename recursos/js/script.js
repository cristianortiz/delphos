$(document).ready(function() {

	/* Using default configuration
	$("#avisos").carouFredSel();

    /*	CarouFredSel: an infinite, circular jQuery carousel.
	Configuration created by the "Configuration Robot"
	at caroufredsel.frebsite.nl
*/
/*	CarouFredSel: an infinite, circular jQuery carousel.
	Configuration created by the "Configuration Robot"
	at caroufredsel.frebsite.nl
*/
/*	CarouFredSel: an infinite, circular jQuery carousel.
	Configuration created by the "Configuration Robot"
	at caroufredsel.frebsite.nl
*/
/*	CarouFredSel: an infinite, circular jQuery carousel.
	Configuration created by the "Configuration Robot"
	at caroufredsel.frebsite.nl
*/
$("#avisos").carouFredSel({
	
	items: {
		visible: 1,
		minimum: 1
	},
	scroll: {
		fx: "cross",
        easing:"linear",
		duration: 6000,
		items: 1
		
	},
	auto: {
		pauseDuration: 4500,
		delay: 4000
	}
});

$("#lateral").carouFredSel({
	
    direction: 'down',
	items: {
	   
		visible: 2,
		minimum: 1
	},
	scroll: {
	   
		fx: "cross",
        easing:"linear",
		duration: 3000,
		items: 1
		
	},
	auto: {
		pauseDuration: 3000,
		delay: 2500
	}
});

/*--------------------------------------------------------------------------------------------------------------------------
  Esta seccion controla las animaciones del panel principal, es un content rotator que sincroniza las imagenes y los textos 
   En el panel principal
*/

 $(function() {
                var current = 1;
                
                var iterate		= function(){
                    var i = parseInt(current+1);
                    var lis = $('#rotmenu').children('li').size();
                    if(i>lis) i = 1;
                    display($('#rotmenu li:nth-child('+i+')'));
                }
                display($('#rotmenu li:first'));
                var slidetime = setInterval(iterate,8000);
				
                $('#rotmenu li').bind('click',function(e){
                    clearTimeout(slidetime);
                    display($(this));
                    e.preventDefault();
                });
				
                function display(elem){
                    var $this 	= elem;
                    var repeat 	= false;
                    if(current == parseInt($this.index() + 1))
                        repeat = true;
					
                    if(!repeat)
                        $this.parent().find('li:nth-child('+current+') a').stop(true,true).animate({'marginRight':'-20px'},300,function(){
                            $(this).animate({'opacity':'0.7'},700);
                        });
					
                    current = parseInt($this.index() + 1);
					
                    var elem = $('a',$this);
                    
                        elem.stop(true,true).animate({'marginRight':'0px','opacity':'1.0'},300);
					
                    var info_elem = elem.next();
                    $('#rot1 .heading').animate({'left':'-420px'}, 500,'easeOutCirc',function(){

                        $('h1',$(this)).html(info_elem.find('.info_heading').html());
                        $(this).animate({'left':'0px'},400,'easeInOutQuad');
                    });
					
                    $('#rot1 .description').animate({'bottom':'-270px'},500,'easeOutCirc',function(){
                        $('p',$(this)).html(info_elem.find('.info_description').html());
                        $(this).animate({'bottom':'0px'},400,'easeInOutQuad');
                    })
                    $('#rot1').prepend(
                    $('<img/>',{
                        style	:	'opacity:0',
                        className : 'bg'
                    }).load(
                    function(){
                        $(this).animate({'opacity':'1'},600);
                        $('#rot1 img:first').next().animate({'opacity':'0'},700,function(){
                            $(this).remove();
                        });
                    }
                ).attr('src','/delphos/recursos/images/'+info_elem.find('.info_image').html()).attr('width','1000').attr('height','600')
                );
                }
            });
           
         /*fin content-rotator panel principal
        ---------------------------------------------------------------------------------------------------------------------*/
  
   projekktor('#player_a', {
	debug: false,
      // poster: 'intro.png',
      useYTIframeAPI: false, 
	width: 640,
	height: 385,
    playerFlashMP4:         'http://localhost/delphos/recursos/js/jarisplayer.swf',
	controls: true,
	playlist: [{0:{src:'http://localhost/delphos/home/carga_playlist', type:"text/json"}}] 
    });  
});
