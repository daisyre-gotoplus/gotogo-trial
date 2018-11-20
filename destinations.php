<?php
	include_once "goto-links.php";
	include_once "scripts/functions.php";
	
	function rating($rating){
		if($rating >= 0 && $rating <= 3){
			$rating = "Very Poor";
			$star = "<i class='fa fa-star' style='font-size:14px;'></i><i class='fa fa-star-o' style='font-size:14px;'></i><i class='fa fa-star-o' style='font-size:14px;'></i><i class='fa fa-star-o' style='font-size:14px;'></i><i class='fa fa-star-o' style='font-size:14px;'></i>";
		}
		elseif($rating >= 3.1 && $rating <= 5){
			$rating = "Poor";
			$star = "<i class='fa fa-star' style='font-size:14px;'></i><i class='fa fa-star' style='font-size:14px;'></i><i class='fa fa-star-o' style='font-size:14px;'></i><i class='fa fa-star-o' style='font-size:14px;'></i><i class='fa fa-star-o' style='font-size:14px;'></i>";
		}
		elseif($rating >= 5.1 && $rating <= 8){
			$rating = "Good";
			$star = "<i class='fa fa-star' style='font-size:14px;'></i><i class='fa fa-star' style='font-size:14px;'></i><i class='fa fa-star' style='font-size:14px;'></i><i class='fa fa-star-o' style='font-size:14px;'></i><i class='fa fa-star-o' style='font-size:14px;'></i>";
		}
		elseif($rating >= 8.1 && $rating <= 9){
			$rating = "Very Good";
			$star = "<i class='fa fa-star' style='font-size:14px;'></i><i class='fa fa-star' style='font-size:14px;'></i><i class='fa fa-star' style='font-size:14px;'></i><i class='fa fa-star' style='font-size:14px;'></i><i class='fa fa-star-o' style='font-size:14px;'></i>";
		}
		else{
			$rating = "Excellent";
			$star = "<i class='fa fa-star' style='font-size:14px;'></i><i class='fa fa-star' style='font-size:14px;'></i><i class='fa fa-star' style='font-size:14px;'></i><i class='fa fa-star' style='font-size:14px;'></i><i class='fa fa-star' style='font-size:14px;'></i>";
		}
		
		return array("rating" => $rating, "star" => $star);
	}
	
	$date_arrival = date("Y-m-d", strtotime("+1 day"));
	$date_departure = date("Y-m-d", strtotime("+2 day"));
	
	$location_name = $_GET['lname'];
	$location = file_get_contents(WEBSERVICE."gotogo/location.php?name=$location_name");
	$location = json_decode($location, true);
	
	if(count($location['locations']) > 0){
		$location_id = $location['locations'][0]['id'];
	}
	else{
		header("Location:index.php");
		exit();
	}
	
	$location = file_get_contents(WEBSERVICE."gotogo/location.php?id=$location_id");
	$location = json_decode($location, true);
	$loc_desc = htmlspecialchars_decode($location['locations'][0]['description']);
	$location = (count($location['locations']) > 0) ? $location['locations'][0]['name'] : "";
	
	$hotel = file_get_contents(WEBSERVICE."gotogo/hotel.php?lid=$location_id&ca=false");
	$hotel = json_decode($hotel, true);
	
	//if(count($hotel['hotels']) > 0){
	//	foreach($hotel['hotels'] as $hotel_key => $hotel_value){
	//		setcookie()
	//	}
	//}
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

		<?php include_once "ssi/metas.php";?>
		<title>GoToGo | Destinations</title> 
		<!-- Bootstrap Latest compiled and minified CSS -->
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous" />
		<!-- My Styles -->
		<link rel = "stylesheet" href="<?=DOMAIN;?>css/styles.css" />
		<!-- Fonts -->
		<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" />
		<?php include_once "ssi/favicons.php";?>
		<!-- Wow Slider -->
		<link rel="stylesheet" type="text/css" href="<?=DOMAIN;?>slider/engine1/style.css" />
		<!-- Feather Light -->
		<link href="//cdn.rawgit.com/noelboss/featherlight/1.5.0/release/featherlight.min.css" type="text/css" rel="stylesheet" />
		<link rel="stylesheet" href="<?=DOMAIN;?>css/owl.carousel.css" />
		<link rel="stylesheet" href="<?=DOMAIN;?>css/owl.theme.css" />
		<?php
			$location_banner = array(
								"5" => array("Angeles", "angeles-two.jpg"),
								"11" => array("Baguio", "baguio-two.jpg"),
								"185" => array("Coron", "coron-two.jpg"),
								"3" => array("Subic Bay", "subic-two.jpg"),
								"19" => array("Manila", "manila-two.jpg"),
								"27" => array("Makati", "makati-two.jpg"),
								"25" => array("Ilocos", "ilocos-two.jpg"),
								"1" => array("Barretto", "barretto-two.jpg"),
								"23" => array("Palawan", "palawan.jpg"),
								"9" => array("Zambales", "zambales-two.jpg")
							);
			
			if(array_key_exists($location_id, $location_banner)){
				echo "<style>
						#banner-wrapper{
							position:relative;
							background:#333333 url('".DOMAIN."images/Banners/".$location_banner[$location_id][1]."') no-repeat center center;
						}
					</style>";
			}
		?>
		<style>
			.thumbnail{
			    height:500px;
			}
			.caption{
			    height:265px !important;
			}
			.rating-review{
				height:100px;
			}
		</style>
	</head>
	<body>
		<!-- Google Tag Manager (noscript) -->
		<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-T82TQSK"
		height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
		<!-- End Google Tag Manager (noscript) -->

		<section id="navigation-wrapperBlue">
			<?php include_once "ssi/navbar-blue.php";?>
		</section>
		<?php
			$location_title = array(
								"5" => array("Angeles", "Angeles City"),
								"11" => array("Baguio", "Baguio City"),
								"185" => array("Coron", "Coron"),
								"3" => array("Subic Bay", "Subic Bay"),
								"19" => array("Manila", "Manila City"),
								"27" => array("Makati", "Makati City"),
								"25" => array("Ilocos", "Ilocos"),
								"23" => array("Palawan", "Palawan"),
								"9" => array("Zambales", "Zambales"),
								"1" => array("Barretto", "Barretto")
							);

			if(array_key_exists($location_id, $location_title)){
		?>
		<section id="banner-wrapper">
			<div style="position: absolute;left:0;right:0;top:50%;text-align: center; transform: translate(0, -50%);">
				<span style="color: #fff;font-size: 70px;text-shadow: rgb(3, 3, 3) 3px 3px 4px;"><?=$location_title[$location_id][1];?></span>
			</div>
		</section>
		<?php
			}
		?>
		<section id="featured-wrapper">
			<div class="container featuredContainer">
				<div class="row">
					<?php
						if(count($hotel['hotels']) > 0){
							echo "<h2>$location Hotels</h2>
									<div class='col-md-12'>
										<div class='row'>
											<div id='owl-demo' class='owl-carousel'>";
							
							foreach($hotel['hotels'] as $hotel_key => $hotel_value){
								$hotel_image = (count($hotel_value['images']) > 0) ? $hotel_value['images'][0] : DOMAIN."images/not-available.png";
								$hotel_name = strlen($hotel_value['name'] > 29) ? "..." : "";
								
								$review_count = "0 Review";
								$rate = 5.1;
								$comment=$review_num="";
								
								$review = file_get_contents(WEBSERVICE."gotogo/reviews.php?hid=".$hotel_value['id']);
								$review = json_decode($review, true);
								if(count($review['reviews']) > 0){
									$review_count = $review['reviewcount']." Review";
									$review_count .= ($review_count > 1) ? "s" : "";
									
									if(count($review['reviews']) > 5){
										foreach($review['reviews'] as $review_key => $review_value){
											$rate += $review_value['rate'];
										}
										
										$rate = round(($rate / $review['reviewcount']) * 2, 1);
									}
									
									$review_desc = $review['reviews'][0]['like'];
									$review_desc_length = strlen(htmlspecialchars_decode($review_desc));
									
									if($review_desc_length > 165){
										$review_desc = substr($review_desc, 0, 165)."...";
									}
									
									$comment = "<div class='rating-review'>\"$review_desc\"</div>
												<br/>
												<span class='rating-user-text'>-</span>
												<span class='rating-user'>".$review['reviews'][0]['guest']."</span>";
									
									$review_num = "<span class='rating-text'>&nbsp;according to</span>
												<span class='rating-reviews'>&nbsp;<a>$review_count</a></span>";
								}
								
								$rating = rating($rate);
								
								//<span>★</span>
								echo "			<div class='item hotel-slidestyle'>
													<!--<a class='rating-link' href='#'>-->
														<div class='thumbnail'>
															<a onclick=\"set_cookie('".$hotel_value['id']."', '".$hotel_value['meta']."');\" alt='".$hotel_value['name']."' title='".$hotel_value['name']."' style='cursor:pointer;'>
																<img class='img-responsive' src='".OPONLINE.WEBSSI."imaging.php?width=275&height=275&cropratio=1:1&noimg=100&image=".urlencode($hotel_image)."' alt='...'/>
															</a>
															<div class='caption'>
																<a onclick=\"set_cookie('".$hotel_value['id']."', '".$hotel_value['meta']."');\" style='cursor:pointer;'>
																	<p>".substr($hotel_value['name'], 0, 29)."$hotel_name</p>
																</a>
																<div class='star-ratings-css'>
																	<div class='star-ratings-css-top' style='width:100%'>
																		<span class='rating-number'>$rate</span>
																		<span>".$rating['star']."</span>
																	</div>
																</div>
																<span class='rating-word'>".strtoupper($rating['rating'])."</span>
																$review_num
																<hr/>
																$comment
															</div>
														</div>
													<!--</a>-->
												</div>";
							}
							
							echo "			</div>
										</div>
									</div>
									";
						}
					?>
					<a onclick="_allhotel()" class="btn btn-cta btn-cta-primary" style="float:right;margin-right:10px; cursor:pointer;">View All Hotels</a>
					<form id="search_request" action="<?=DOMAIN;?>search.php" method="post">
						<input type="hidden" id="btn_search" name="btn_search" value="1"/>
						<input type="hidden" name="location" value="<?="locationid|$location_id";?>"/>
						<input type="hidden" name="date_arrival" value="<?=$date_arrival;?>"/>
						<input type="hidden" name="date_departure" value="<?=$date_departure;?>"/>
					</form>
				</div>
			</div>
		</section>
		<section id="body-wrapper2">
			<div class="container bodyContainer2">
				<div class="row">
					<div class="col-md-12">
						<div class="row">
							<div class="col-md-12 locationDescription">
								<h2>About <?=$location;?></h2>
								<p style="margin-top:25px;line-height: 1.5;"><?=$loc_desc;?></p>
							</div>
							<div class="col-md-12 locationMap" style="margin-bottom:30px">
								<h2>Location</h2>
								<iframe src="<?=DOMAIN;?>map.php?id=<?=$location_id;?>" width="100%" height="300px" frameborder="0" style="border:0" allowfullscreen="" class="margin-top-medium"></iframe>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<section id="footer-wrapper">
			<?php include_once "ssi/footer.php";?>
		</section>
		<script>
			function _allhotel(){
				$("#search_request").submit();
			}
			function set_cookie(hid, hname){
				var d = new Date();
				
				//d.setTime(d.getTime() + (30 * 24 * 60 * 60 * 1000)); //(days, hours, minutes, seconds, milliseconds)
				d.setTime(d.getTime() + (24 * 30 * 60 * 1000)); //1day
				
				var expires = "expires="+d.toGMTString();
				
				document.cookie = "da-"+hid+"=<?=strtotime($date_arrival);?>;"+expires+";path=/";
				document.cookie = "dd-"+hid+"=<?=strtotime($date_departure);?>;"+expires+";path=/";
				document.cookie = "location-"+hid+"=locationid|<?=$location_id;?>;"+expires+";path=/";
				
				window.location = "<?=DOMAIN;?>accommodation/?name="+hname;
			}
		</script>
		<!-- JQuery -->
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>    
		<!-- Font Awesome JS -->
		<script src="//use.fontawesome.com/b7ea8ae414.js"></script>
		<!-- Boostrap Latest compiled and minified JavaScript -->  
		<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
		<!-- Featherlight -->
		<script src="//cdn.rawgit.com/noelboss/featherlight/1.5.0/release/featherlight.min.js" type="text/javascript" charset="utf-8"></script>
		<!-- OWL Slider -->
		<script src="<?=DOMAIN;?>js/owl.carousel.min.js"></script>
		<script src="<?=DOMAIN;?>js/subscribe.js" type="text/javascript"></script>
		<script>
			$(document).ready(function() {
				$(".owl-carousel").owlCarousel();
					var owl = $(".owl-carousel");
					owl.trigger('owl.play',3000);
					owl.owlCarousel({
						items : 12, 
						itemsDesktop : [1000,5],
						itemsDesktopSmall : [900,3],
						itemsTablet: [600,2], 
						itemsMobile : [300,2], 
						autoplayHoverPause : true,
						loop : true
					});
			});
		</script>
	</body>
</html>