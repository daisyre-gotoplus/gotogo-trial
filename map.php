<?php
	$location_id = $_GET['id'];
	
	$location = file_get_contents("https://secure.gotogo.com/web-services/gotogo/location.php?id=$location_id");
	$location = json_decode($location, true);
	$latitude = (count($location['locations']) > 0) ? $location['locations'][0]['latitude'] : 0;
	$longitude = (count($location['locations']) > 0) ? $location['locations'][0]['longitude'] : 0;
?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<html lang=en xml:lang="en">
	<head>
		<!-- Google Tag Manager -->
		<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
		new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
		j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
		'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
		})(window,document,'script','dataLayer','GTM-T82TQSK');</script>
		<!-- End Google Tag Manager -->

		<title>Simple Map</title>
		<meta name="viewport" content="initial-scale=1.0">
		<meta charset="utf-8">
		<style>
			/* Always set the map height explicitly to define the size of the div
			* element that contains the map. */
			#map {
			height: 100%;
			}
			/* Optional: Makes the sample page fill the window. */
			html, body {
			height: 100%;
			margin: 0;
			padding: 0;
		}
		</style>
	</head>
	<body>
		<!-- Google Tag Manager (noscript) -->
		<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-T82TQSK"
		height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
		<!-- End Google Tag Manager (noscript) -->

		<div id="map"></div>
		
		<script>
			var map;
			
			function initMap(){
				var myLatlng = new google.maps.LatLng(<?=$latitude;?>, <?=$longitude;?>);
				
				map = new google.maps.Map(document.getElementById('map'), {
					zoom:8,
					center:myLatlng
				});
				
				var marker = new google.maps.Marker({
					position:myLatlng,
					map:map,
					title:"Lorem"
				});
			}
		</script>
		<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAGghgA8VCXMohBwJusLIWVz7j57zWcf_Y&callback=initMap" async defer></script>
	</body>
</html>