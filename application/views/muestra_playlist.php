
<!DOCTYPE HTML>
<html>
<head>
    <title>Projekktor - simply mighty video</title>
    <style type="text/css">
	body { background-color: #fdfdfd; padding: 0 20px; color:#000; font: 13px/18px monospace; width: 800px;}
	a { color: #360; }
	h3 { padding-top: 20px; }
    </style>

    <!-- Load player theme -->
    <link rel="stylesheet" href="<? echo base_url('recursos/css/theme/style.css');?>" type="text/css" media="screen" />

    <!-- Load jquery -->
    <script type="text/javascript" src="<? echo base_url('recursos/js/jquery-1.7.1.min.js');?>"></script>

    <!-- load projekktor -->
    <script type="text/javascript" src="<? echo base_url('recursos/js/projekktor-1.0.13r41.min.js');?>"></script>

</head>
<body>
<script type="text/javascript">
$(document).ready(function() {
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
})
</script>

    <h1>Thanks for downloading Projekktor <span id="projekktorver"></span></h1>
    <p>
	This file is intended to give a quick introduction on how to install and use Projekktor Zwei.
	Please have a look at the source in order to check out what&acute;s going on here.
	More detailed information and a documentation can be found online:
    </p>

    <ul>
	<li><a href="http://www.projekktor.com">Homepage</a></li>
	<li><a href="http://www.projekktor.com/docs.php">Docs</a></li>
	<li><a href="http://www.projekktor.com/downloads.php">More Downloads</a></li>
	<li><a href="http://www.projekktor.com/license.php">GPL License</a></li>
	<li><a href="http://www.projekktor.com/donate.php"><b>Support this projekkt: Consider a donation</b></a></li>
	<li><a href="http://www.projekktor.com/donate.php#buy"><b>Buy a Business license</b></a></li>
	<li><a href="http://www.spinningairwhale.com/contact/"><b>Need customizations or Support? Get in touch.</b></a></li>
    </ul>
    <p>
	brought to you by <a href="http://www.spinningairwhale.com">spinning airwhale media</a> - Free the Princess of Agentia!
    </p>

    <h2>Example - One Video, OGG+MP4+WEBM, Theme: Maccaco by <a href="http://www.porkhead.org">porkhead</a></h2>

    <div id="player_a" class="projekktor"></div>


    <h3>please read the <a href="http://www.projekktor.com/changelog.php">changelog</a></h3>

</body>
</html>
