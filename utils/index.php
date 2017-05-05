<?php
/**
 * Función para detectar el sistema operativo, navegador y versión del mismo
 */
$info=detect();
 
//echo "Sistema operativo: ".$info["os"];
//echo "Navegador: ".$info["browser"];

if($info["browser"]=='IE'){
echo $info["browser"];
?>
<script>
    window.location="http://radio.coomeva.com.co/live/programs/conferencia_apnea_sueno/playerFlv/";
</script>
<?php
}
//echo "Versión: ".$info["version"];
//echo $_SERVER['HTTP_USER_AGENT'];
 
/**
 * Funcion que devuelve un array con los valores:
 *	os => sistema operativo
 *	browser => navegador
 *	version => version del navegador
 */
function detect()
{
	$browser=array("IE","OPERA","MOZILLA","NETSCAPE","FIREFOX","SAFARI","CHROME");
	$os=array("WIN","MAC","LINUX");
 
	# definimos unos valores por defecto para el navegador y el sistema operativo
	$info['browser'] = "OTHER";
	$info['os'] = "OTHER";
 
	# buscamos el navegador con su sistema operativo
	foreach($browser as $parent)
	{
		$s = strpos(strtoupper($_SERVER['HTTP_USER_AGENT']), $parent);
		$f = $s + strlen($parent);
		$version = substr($_SERVER['HTTP_USER_AGENT'], $f, 15);
		$version = preg_replace('/[^0-9,.]/','',$version);
		if ($s)
		{
			$info['browser'] = $parent;
			$info['version'] = $version;
		}
	}
 
	# obtenemos el sistema operativo
	foreach($os as $val)
	{
		if (strpos(strtoupper($_SERVER['HTTP_USER_AGENT']),$val)!==false)
			$info['os'] = $val;
	}
 
	# devolvemos el array de valores
	return $info;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8" />
	<title>Radio Coomeva TV</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<link rel="stylesheet" type="text/css" href="http://radio.coomeva.com.co/live/assets/programs/css/style.css">
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script   src="https://code.jquery.com/jquery-3.1.0.min.js"   integrity="sha256-cCueBR6CsyA4/9szpPfrX3s49M9vUU5BgtiJj06wt/s="   crossorigin="anonymous"></script>

	<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-27914928-4', 'auto');
  ga('send', 'pageview');

</script>
	<!-- COMPATIBILITY THINGS -->
	<!--[if lt IE 9]>
		<script src="http://cdnjs.cloudflare.com/ajax/libs/json3/3.3.2/json3.min.js"></script>
		<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/es5-shim/4.0.5/es5-shim.min.js"></script>
        <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
        <style>
            .ng-hide {
                display: none !important;
            }
        </style>
	<![endif]-->
</head>
<body>
	<div class="container">
		




<style>
	body{
		background: url(http://radio.coomeva.com.co/live/assets/programs/img/background.jpg) !important;
		background-size: 100% !important;
	}
</style>
<div class="row video-display" style="margin-top:10%;">
<?php
	

	$document=(isset($_GET['doc']))?$_GET['doc']:"123";
?>

	<script>
		$(document).ready(function(){
			var isOpera = !!window.opera || navigator.userAgent.indexOf(' OPR/') >= 0;
		    // Opera 8.0+ (UA detection to detect Blink/v8-powered Opera)
			var isFirefox = typeof InstallTrigger !== 'undefined';   // Firefox 1.0+
			var isSafari = Object.prototype.toString.call(window.HTMLElement).indexOf('Constructor') > 0;
			    // At least Safari 3+: "[object HTMLElementConstructor]"
			var isChrome = !!window.chrome && !isOpera;              // Chrome 1+
			var isIE = /*@cc_on!@*/false || !!document.documentMode; // At least IE6
			if(!isIE){
				$('#video-flash').remove();
				$('#video-mp4').show();
			}

			function initial_report(){
				$.post( "http://radio.coomeva.com.co/radio-new/public/api/v2.0/post-audit",
					{ ip: "<?php echo $_SERVER['REMOTE_ADDR'] ?>",
					identifier:"<?php echo  $document  ?>",
					url:"bolsa-beneficios-mp1",
					action:"inicia"
				},
					function( data ) {
				  console.log( data ); // John

				});
			};

			initial_report();

			function report(){
				$.post( "http://radio.coomeva.com.co/radio-new/public/api/v2.0/post-audit",
					{ ip: "<?php echo $_SERVER['REMOTE_ADDR'] ?>",
					identifier:"<?php echo  $document  ?>",
					url:"bolsa-beneficios-mp1",
					action:"continua"
				},
					function( data ) {
				  console.log( data ); // John

				});
			}

			setInterval(report,60000);

		});
	</script>
	

	<video id="video-mp4" style="width:100%;" src="http://radio.coomeva.com.co/live/programs/videos/CONFERENCIA_APNEA_web.mp4" controls></video>
</div>
<div class="row">
	<div class="col-md-8 video-info">
		<h3>Coomeva Salud</h3>
		<small>Por: <a href="#">Coomeva salud</a> 12-12-2016</small>

	</div>

</div>



































	</div>





	<footer class="row" style="margin-bottom:60px;">
	
	</footer>
	

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</body>
</html>