<?php
	include_once "goto-links.php";
	include_once "scripts/functions.php";
	
	if($_POST['btn_search']){
		$date_arrival = $_POST['date_arrival'];
		$date_departure = $_POST['date_departure'];
		$location = $location_hdn = $_POST['location'];
		
		$location_arr = explode("|", $location);
		
		if($location_arr[0] == "place"){
			$location = $location_arr[1].", ".$location_arr[2].", ".$location_arr[3];
		}
		
		if($location_arr[0] == "locationid"){
			$location = file_get_contents(WEBSERVICE."gotogo/location.php?id=".$location_arr[1]);
			$location = json_decode($location, true);
			$location = $location['locations'][0]['name'];
		}
		
		if($location_arr[0] == "country"){
			$location = $location_arr[1];
		}
		
		if($location_arr[0] == "metaname"){
			$hotel = file_get_contents(WEBSERVICE."gotogo/hotel-meta.php?name=".$location_arr[1]);
			$hotel = json_decode($hotel, true);
			$hotel_id = $hotel['id'];
?>
			<script>
				var d = new Date();
				
				//d.setTime(d.getTime() + (30 * 24 * 60 * 60 * 1000)); //(days, hours, minutes, seconds, milliseconds)
				d.setTime(d.getTime() + (24 * 30 * 60 * 1000)); //1day
				
				var expires = "expires="+d.toGMTString();
				
				document.cookie = "da-<?=$hotel_id;?>=<?=strtotime($date_arrival);?>;"+expires+";path=/";
				document.cookie = "dd-<?=$hotel_id;?>=<?=strtotime($date_departure);?>;"+expires+";path=/";
				document.cookie = "location-<?=$hotel_id;?>=metaname|<?=$location_arr[1];?>;"+expires+";path=/";
				
				window.location = "<?=DOMAIN;?>accommodation/?name=<?=$location_arr[1];?>";
			</script>
<?php
			//header("Location:accommodation/?name=".$location_arr[1]);
			exit();
		}
	}
	else{
		header("Location:index.php");
		exit();
	}
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
		<title>GoToGo | Search</title> 
		<!-- Bootstrap Latest compiled and minified CSS -->
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous" />
		<!-- My Styles -->
		<link rel = "stylesheet" href="<?=DOMAIN;?>css/styles.css" />
		<!-- Fonts -->
		<link href="//fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" />
		<link href="//fonts.googleapis.com/css?family=Josefin+Sans" rel="stylesheet">
		<?php include_once "ssi/favicons.php";?>
		<!-- Wow Slider -->
		<link rel="stylesheet" type="text/css" href="<?=DOMAIN;?>slider/engine1/style.css" />
		<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/9.7.2/css/bootstrap-slider.min.css"> 
    	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.1/css/star-rating.min.css">
		<script type="text/javascript" src="<?=DOMAIN;?>slider/engine1/jquery.js"></script>
		<!-- Swiper Slider -->
		<!-- <link rel="stylesheet" type="text/css" href="css/swiper.min.css" />-->
		<!-- Owl Slider -->
		<link rel="stylesheet" href="<?=DOMAIN;?>css/owl.carousel.css" />
		<link rel="stylesheet" href="<?=DOMAIN;?>css/owl.theme.css" />
		<link rel="stylesheet" type="text/css" href="<?=DOMAIN;?>datepicker/jquery-ui.min.css">
		<link rel="stylesheet" type="text/css" href="<?=DOMAIN;?>datepicker/jquery-ui.theme.css">
		<link rel="stylesheet" type="text/css" href="<?=DOMAIN;?>css/loader.css">
		<style>
			.autocomplete-suggestions { border: 1px solid #999; background: #fff; width: auto !important; cursor: default; overflow: auto; font-family: "Open Sans", Sans-serif; font-size:10px; }
			.autocomplete-suggestion { padding: 10px 5px; font-size: 1.2em; white-space: nowrap; overflow: hidden; }
			.autocomplete-selected { background: #f0f0f0; }
			.autocomplete-suggestions strong { font-weight: normal; color: #3399ff; }
			
			.showContent, .hideContent{
				margin-bottom:5px; 
			}
			.hideContent{
				height:7em;
				overflow:hidden;
			}
			.showContent{
				height: auto;
			}
			.show-more {
				font-size: 12px;
				right: 0;
				text-align: left;
				width: 100%;
				font-family: "Open Sans", Sans-serif;
				color: #337ab7;
				cursor: pointer;
			}
			.fadedesc{
				background: #000;
				width: 100%;
				height: 4em;
				position: absolute;
				bottom: 0px;
				background: rgba(255,255,255,0);
				background: -moz-linear-gradient(top, rgba(255,255,255,0) 0%, rgba(255,255,255,1) 100%);
				background: -webkit-gradient(left top, left bottom, color-stop(0%, rgba(255,255,255,0)), color-stop(100%, rgba(255,255,255,1)));
				background: -webkit-linear-gradient(top, rgba(255,255,255,0) 0%, rgba(255,255,255,1) 100%);
				background: -o-linear-gradient(top, rgba(255,255,255,0) 0%, rgba(255,255,255,1) 100%);
				background: -ms-linear-gradient(top, rgba(255,255,255,0) 0%, rgba(255,255,255,1) 100%);
				background: linear-gradient(to bottom, rgba(255,255,255,0) 0%, rgba(255,255,255,1) 100%);
				filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ffffff', endColorstr='#ffffff', GradientType=0 );
			}
		</style>
	</head>
	<body>
		<!-- Google Tag Manager (noscript) -->
		<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-T82TQSK"
		height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
		<!-- End Google Tag Manager (noscript) -->

		<section id="navigation-wrapperBlue">
			<?php include "ssi/navbar-blue.php";?>
		</section>
		<section id="body-wrapper-search" style="padding-top:50px;">
			<div class="container">
				<div class="col-md-3" style="margin-bottom: 30px;">
					<div id="ember538" class="ember-view">
						<div>
							<div class="panel panel-warning margin-zero padding-zero calendar">
								<form name="hotel_search" method="post" action="">
									<div class="panel-heading" style="border-radius:0;background-color:#FF9800">
										<h4 class="margin-zero" style="color:#fff">Find Hotels</h4>
									</div>   
									<div class="panel-body">
										<div class="form-group">
											<label><strong>Where do you want to go?</strong></label>
											<div class="input-group">
												<input type="text" id="autocomplete" placeholder="Destination, City or Hotels" value="<?=$location;?>" class="col-md-12 form-control ember-view ember-text-field"/>
												<span class="input-group-addon"><i class="fa fa-search"></i></span>
											</div>
										</div> 
										<div class="form-group">
											<label>Arrival Date</label>
											<div class="input-group">
												<input type="text" id="txtDateStart" name="date_arrival" placeholder="Arrival Date" value="<?=$date_arrival;?>" readonly class="col-md-12 form-control ember-view ember-text-field"/>
												<span class="input-group-addon" id="iconDateStart"><i class="fa fa-calendar"></i></span>
											</div>
										</div> 
										<div class="form-group">
											<label>Departure Date</label>
											<div class="input-group">
												<input type="text" id="txtDateEnd" name="date_departure" placeholder="Departure Date" value="<?=$date_departure;?>" readonly class="col-md-12 form-control ember-view ember-text-field"/>
												<span class="input-group-addon" id="iconDateEnd"><i class="fa fa-calendar"></i></span>
											</div>
										</div> 
									</div>
									<div class="panel-footer">
										<input type="hidden" id="location" name="location" value="<?=$location_hdn;?>"/>
										<input type="hidden" name="fprice" value=""/>
										<input type="hidden" name="ffacilities" value=""/>
										<button type="submit" name="btn_search" value="1" class="btn btn-lg btn-primary btn-block">Search</button>
									</div>
								</form>
							</div>      
						</div>   	   
					</div>
					<div style="text-align:center;">
						<div style="border:1px solid #a9a9a9; border-radius:3px; padding:20px;">
							<form name="filter_hotel" method="post" action="">
								<input type="hidden" id="fdate_arrival" name="date_arrival" value="<?=$date_arrival;?>"/>
								<input type="hidden" id="fdate_departure" name="date_departure" value="<?=$date_departure;?>"/>
								<input type="hidden" id="flocation" name="location" value="<?=$location_hdn;?>"/>
								<div class="form-group">
									<label for="ex2" style="display: block; text-align: left; margin-bottom: 10px;">Price per Night:</label>
									<div style="margin: 0 8px 0px 8px;">
										<input id="ex2" type="text" name="fprice" class="span2" value="" data-slider-min="0" data-slider-max="30000" data-slider-step="5" data-slider-value="[0,30000]" style="width: 100%;"/>
									</div>
									<div style="height: 25px;">
										<div>
											<span class="minrange" style="display: inline-block;float: left;margin-left: 5px;font-family: 'Arial', sans-serif;">&#8369; 0</span>
											<span class="maxrange" style="display: inline-block;float: right;margin-right: 5px;font-family: 'Arial', sans-serif;">&#8369; 30000</span>
										</div>
									</div>
								</div>
								<hr style="margin: 20px -15px;"/>
								<div class="form-group">
									<label style="display: block; text-align: left; margin-bottom: 10px;">Facilities:</label>
									<div class="form-check">
										<label style="font-family:Arial, Sans-Serif; font-weight:400; display:block; text-align:left; margin-left:10px;"><input type="checkbox" name="ffacilities[]" value="Beach" class="form-check-input"> Beach</label>
										<label style="font-family:Arial, Sans-Serif; font-weight:400; display:block; text-align:left; margin-left:10px;"><input type="checkbox" name="ffacilities[]" value="Gym,Fitness" class="form-check-input"> Gym</label>
										<label style="font-family:Arial, Sans-Serif; font-weight:400; display:block; text-align:left; margin-left:10px;"><input type="checkbox" name="ffacilities[]" value="Wifi,Wi-Fi,Internet" class="form-check-input"> Internet</label>
										<label style="font-family:Arial, Sans-Serif; font-weight:400; display:block; text-align:left; margin-left:10px;"><input type="checkbox" name="ffacilities[]" value="Non-Smoking" class="form-check-input"> Non Smoking Rooms</label>
										<label style="font-family:Arial, Sans-Serif; font-weight:400; display:block; text-align:left; margin-left:10px;"><input type="checkbox" name="ffacilities[]" value="Parking" class="form-check-input"> Parking</label>
										<label style="font-family:Arial, Sans-Serif; font-weight:400; display:block; text-align:left; margin-left:10px;"><input type="checkbox" name="ffacilities[]" value="Pets" class="form-check-input"> Pets Allowed</label>
										<label style="font-family:Arial, Sans-Serif; font-weight:400; display:block; text-align:left; margin-left:10px;"><input type="checkbox" name="ffacilities[]" value="Restaurant" class="form-check-input"> Restaurant</label>
										<label style="font-family:Arial, Sans-Serif; font-weight:400; display:block; text-align:left; margin-left:10px;"><input type="checkbox" name="ffacilities[]" value="Spa,Jacuzzi,Hot Tub" class="form-check-input"> Spa</label>
										<label style="font-family:Arial, Sans-Serif; font-weight:400; display:block; text-align:left; margin-left:10px;"><input type="checkbox" name="ffacilities[]" value="Golf,Table Tennis,Tennis,Water Sports" class="form-check-input"> Sports</label>
										<label style="font-family:Arial, Sans-Serif; font-weight:400; display:block; text-align:left; margin-left:10px;"><input type="checkbox" name="ffacilities[]" value="Swimming Pool" class="form-check-input"> Swimming Pool</label>
									</div>
								</div>
								<!-- <hr style="margin: 20px -15px;"/>
								<div class="form-group" style="margin: 0;">
									<label for="input-1" class="control-label" style="display: block; text-align: left; margin-bottom: 10px;">Star Rating:</label>
									<input id="input-1" name="input-1" value="0" class="rating-loading">
								</div> -->
							</form>
						</div>
					</div>
				</div>
				<div class="col-md-9">
					<div id="preloader" style="display:none; position:absolute; width:100%; z-index:6;">
						<div class="ui active dimmer">
							<div class="ui large text loader">Loading</div>
						</div>
					</div>
					<div id="filter-result">
					</div>
				</div>
			</div>
		</section>
		<section id="footer-wrapper">
			<?php include_once "ssi/footer.php";?>
		</section>
		<!-- JQuery -->
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>    
		<!-- Font Awesome JS -->
		<script src="//use.fontawesome.com/b7ea8ae414.js"></script>
		<!-- Boostrap Latest compiled and minified JavaScript -->  
		<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
		<!-- List.js pagination -->  
		<script src="<?=DOMAIN;?>js/list.js"></script>
		<script src="<?=DOMAIN;?>js/list.pagination.min.js"></script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/9.7.2/bootstrap-slider.min.js"></script>
    	<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.1/js/star-rating.min.js"></script>
    	<script type="text/javascript" src="<?=DOMAIN;?>datepicker/jquery-ui.js"></script>
    	<script type="text/javascript" src="<?=DOMAIN;?>js/jquery.mockjax.js"></script>
		<script type="text/javascript" src="<?=DOMAIN;?>js/jquery.autocomplete.js"></script>
		<script type="text/javascript" src="<?=DOMAIN;?>js/search.js"></script>
		<script type="text/javascript" src="<?=DOMAIN;?>datepicker/calendarfunctions.js"></script>
		<script src="<?=DOMAIN;?>js/subscribe.js" type="text/javascript"></script>
		<script type="text/javascript">
			function expand(){
				$(".show-more").on("click", function(){
					var $this = $(this);
					var $content = $this.prev("div.hoteldesc");
					var linkText = $this.text().toUpperCase();
					
					if(linkText === "SHOW MORE"){
						linkText = "Show less";
						$content.switchClass("hideContent", "showContent", 400);
						$content.find("div.showdetails").removeClass("fadedesc");
					}
					else{
						linkText = "Show more";
						$content.switchClass("showContent", "hideContent", 400);
						$content.find("div.showdetails").addClass("fadedesc");
					};
					
					$this.text(linkText);
				});
			}
			function pahina(){
				var monkeyList = new List('hotel-list', {
					valueNames: ['name'],
					page: 5,
					plugins: [ ListPagination({}) ] 
				});
			}
			function set_cookie(hid, hname, lid){
				var d = new Date();
				
				//d.setTime(d.getTime() + (30 * 24 * 60 * 60 * 1000)); //(days, hours, minutes, seconds, milliseconds)
				d.setTime(d.getTime() + (24 * 30 * 60 * 1000)); //1day
				
				var expires = "expires="+d.toGMTString();
				
				document.cookie = "da-"+hid+"=<?=strtotime($date_arrival);?>;"+expires+";path=/";
				document.cookie = "dd-"+hid+"=<?=strtotime($date_departure);?>;"+expires+";path=/";
				document.cookie = "location-"+hid+"=locationid|"+lid+";"+expires+";path=/";
				
				window.location = "<?=DOMAIN;?>accommodation/?name="+hname;
			}
			
			$(document).on('ready', function(){
				$('#iconDateStart').click(function(){
					$('#txtDateStart').datepicker("show");
				});
				$('#iconDateEnd').click(function(){
					$('#txtDateEnd').datepicker("show");
				});

				$("#ex2").slider();  
				$("#ex2").on('slide', function(slideEvt){
					$('.minrange').text("₱ "+slideEvt.value[0]);
					$('.maxrange').text("₱ "+slideEvt.value[1]);
				});
				$("#ex2").on('change', function(slideEvt){
					$('.minrange').text("₱ "+slideEvt.value.newValue[0]);
					$('.maxrange').text("₱ "+slideEvt.value.newValue[1]);
				});

				$('#input-1').rating({
					min: 0, 
					max: 5, 
					step: 1, 
					stars: 5, 
					size: 'xs',
					animate: false,
					showClear: false,
					showCaption: false,
				});
				
				$("#preloader").css("height", $("#ember538").parent().outerHeight()+"px");
				$("[name='hotel_search']").submit();
			});
			
			var xhr = new XMLHttpRequest();
			
			$("[name='hotel_search']").submit(function(){
				$("#autocomplete").css("border-color", "");
				
				if($("#location").val()==""){
					$("#autocomplete").css("border-color", "#ff0000");
				}
				else{
					$("#fdate_arrival, #pdate_start").val($("#txtDateStart").val());
					$("#fdate_departure, #pdate_end").val($("#txtDateEnd").val());
					$("#flocation, #plocation").val($("#location").val());
					
					$("#filter-result").css({"height":$("#ember538").parent().outerHeight()+"px", "opacity":"0.4", "filter":"alpha(opacity=40)", "overflow":"hidden"});
					$("#preloader").show();
					
					xhr.abort();
					xhr.open("POST", "scripts/filter.php");
					xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
					xhr.onload = function(){
						$("#filter-result").css({"height":"", "opacity":"", "filter":"", "overflow":""});
						$("#preloader").hide();
						$("#filter-result").html(xhr.responseText);
						
						expand();
						pahina();
					};
					xhr.send($("[name='hotel_search']").serialize());
				}
				
				return false;
			});
			
			$("[name='filter_hotel'] :input").change(function(){
				$("#filter-result").css({"height":$("#ember538").parent().outerHeight()+"px", "opacity":"0.4", "filter":"alpha(opacity=40)", "overflow":"hidden"});
				$("#preloader").show();
				
				xhr.abort();
				xhr.open("POST", "scripts/filter.php");
				xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
				xhr.onload = function(){
					$("#filter-result").css({"height":"", "opacity":"", "filter":"", "overflow":""});
					$("#preloader").hide();
					$("#filter-result").html(xhr.responseText);
					
					expand();
					pahina();
				};
				xhr.send($("[name='filter_hotel']").serialize());
			});
    	</script> 
		<script>
			var locations = {
				<?php
					$location = file_get_contents(WEBSERVICE."gotogo/location-qs.php");
					$location = json_decode($location, true);
					
					if(count($location['locations']) > 0){
						$place_ctr = 0;
						foreach($location['locations'] as $key => $value){
							echo ($place_ctr > 0) ? "," : "";
							echo '"'.$value['search'].'": "'.$value['location'].'"';
							
							$place_ctr++;
						}
					}
				?>
			}
		</script>
	</body>
</html>
