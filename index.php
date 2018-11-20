<?php
	include_once "goto-links.php";
	include_once "scripts/functions.php";
	include_once "scripts/query.php";
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
		<title>GOTOGO</title>
		<link rel="canonical" href="http://www.gotogo.com/" />
		<meta name="author" content="Goto Plus, Inc."> 
		<!-- Bootstrap Latest compiled and minified CSS -->
		<!-- <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous" /> -->
		<!-- Date Picker -->
		<!-- <link rel = "//cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.43/css/bootstrap-datetimepicker.min.css"> -->
		<!-- Fonts -->
		<link href="<?=DOMAIN;?>css/bootstrap.css" rel="stylesheet">
		<link href="<?=DOMAIN;?>css/bootstrap-datetimepicker.css" rel="stylesheet">
		<link href="//fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
		<!-- My Styles -->
		<link rel = "stylesheet" href="<?=DOMAIN;?>css/styles.css" />
		<?php include_once "ssi/favicons.php";?>
		<!-- Wow Slider -->
		<!-- <link rel="stylesheet" type="text/css" href="slider/engine1/style.css" />
		<script type="text/javascript" src="slider/engine1/jquery.js"></script> -->
		<style>
			.autocomplete-suggestions { border: 1px solid #999; background: #fff; cursor: default; overflow: auto; font-family: "Open Sans", Sans-serif; font-size:10px; }
			.autocomplete-suggestion { padding: 10px 5px; font-size: 1.2em; white-space: nowrap; overflow: hidden; }
			.autocomplete-selected { background: #f0f0f0; }
			.autocomplete-suggestions strong { font-weight: normal; color: #3399ff; }
			#searchfield { display: block; width: 100%; text-align: center; margin-bottom: 35px; }
			#searchfield p {
			  display: inline-block;
			  background: #eeefed;
			  padding: 0;
			  margin: 0;
			  padding: 5px;
			  border-radius: 3px;
			  margin: 5px 0 0 0;
			}
			#searchfield p .biginput {
			  width: 600px;
			  height: 40px;
			  padding: 0 10px 0 10px;
			  background-color: #fff;
			  border: 1px solid #c8c8c8;
			  border-radius: 3px;
			  color: #aeaeae;
			  font-weight:normal;
			  font-size: 1.5em;
			  -webkit-transition: all 0.2s linear;
			  -moz-transition: all 0.2s linear;
			  transition: all 0.2s linear;
			}
			#searchfield p .biginput:focus {
			  color: #858585;
			}
			div.dropdown-menu {
				background-color: #fff;
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
		<section id="slider-wrapper"></section>
		<section id="booking-wrapper">
			<div class="container">
				<div class="col-md-12"> 
					<div class="row">
						<div class="col-md-12">
							<div class="col-md-12">
								<h3>Find Hotels</h3>
								<!-- <h5>more than 180,000 hotels worldwide</h5> -->
							</div>                    
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<div class="input-group">
									<input placeholder="Destination, City or Hotels" type="text" class="form-control biginput" id="autocomplete">
									<span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
								</div>   
							</div>   
						</div>    
					</div>
					<div class="row">
						<!-- <div class="container"> -->
						<?php
							$arrival = date("Y-m-d", strtotime("+1 day"));
							$departure = date("Y-m-d", strtotime("+2 day"));
							$nights = 1;
						?>
						<form name="hotel_search" action="search.php" method="post">
						    <div class="col-md-4">
						        <div class="form-group">
						        	<label>Arrival Date</label>
						            <div class="input-group date" id="da_picker">
						            	<input type="text" id="date_arrival" name="date_arrival" value="<?=$arrival;?>" class="form-control" style="cursor:pointer;"/>
						                <span class="input-group-addon">
						                    <span class="glyphicon glyphicon-calendar"></span>
						                </span>
						            </div>
						        </div>
						    </div>
						    <div class="col-md-4">
						        <div class="form-group">
						        	<label>Departure Date</label>
						            <div class="input-group date" id="dd_picker">
						            	<input type="text" id="date_departure" name="date_departure" value="<?=$departure;?>" class="form-control" style="cursor:pointer;"/>
						                <span class="input-group-addon">
						                    <span class="glyphicon glyphicon-calendar"></span>
						                </span>
						            </div>
						        </div>
						    </div>
						    <div class="col-md-4">
								<input type="hidden" id="location" name="location"/>
								<input type="hidden" id="nights" name="nights" value="<?=$nights;?>"/>
								<button type="submit" name="btn_search" value="1" class="btn btn-global btn-block btn-lg" style="margin-top: 25px;color:#fff;padding:7px 16px; "><strong>Search</strong></button> 
							</div>
						</form>
						<!-- </div> -->
						<!-- <div class="col-md-4">
							<div class="form-group">
								<label>Arrival Date</label>
								<div class="input-group">
									<input id="arrival" placeholder="Arrival Date" type="text" class="col-md-12 form-control  ember-view ember-text-field hasDatepicker">
									<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
								</div>
							</div>   
						</div>   
						<div class="col-md-4">     
							<div class="form-group fa-icon-position">
								<label>Departure Date</label>
								<div class="input-group">
									<input id="departure" placeholder="Departure Date" type="text" class="col-md-12 form-control  ember-view ember-text-field hasDatepicker">
									<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
								</div>   
						  </div>       
						</div>  -->
					</div> 
					<div class="row slidedatelastrow">
						<div class="col-md-6">
							<div style='position: relative'>
								<div style='display: inline-block;position: absolute;left:0;'>
									<i class='fa fa-check mobilegone' style='font-size: 30px; color: #FFFFFF;text-align: center;border-radius: 100%;background: #8BC34A;width: 50px;line-height: 50px;height: 50px;'></i>
								</div>
								<div style='padding-left: 65px;'>
									<h3 class="remove-margin mobilegone">NO HIDDEN FEES OR EXTRA CHARGES!</h3>
									<span class="mobilegone">The rates you see on the website is final. The price is already inclusive of taxes and no service fee is required.</span>
								</div>
							</div>  
						</div>
						<div class="col-md-6">
							<div style='position: relative'>
								<div style='display: inline-block;position: absolute;left:0;'>
									<i class='fa fa-check-square-o' style='font-size: 54px; color: #FF9800;'></i>
								</div>
								<div style='padding-left: 65px;'>
									<h3 class="remove-margin mobilegone">DIRECT CONFIRMED BOOKING TO THE HOTEL</h3>
									<span class="mobilegone">Book safely and direct to hotel’s rooms. Scouring over the internet looking for cheaper rates is such a waste of time when you can book direct through gotogo.com.</span>
								</div>
							</div>
						</div>        
					</div>
				</div>  
			</div>
		</section>
		<section id="body-wrapper">
			<div class="container">
				<h2>Top Destinations</h2>
				<div class="row">
					<div class="col-md-12">
						<div class="row">
							<?php
								$location = array(
												"5" => array("angeles-city", "angeles3.jpg"),
												"11" => array("baguio-city", "baguio3.jpg"),
												"185" => array("coron", "coron3.jpg"),
												"3" => array("subic-bay-freeport-zone", "subic3.jpg"),
												"19" => array("manila", "manila3.jpg"),
												"27" => array("makati", "makati3.jpg"),
												"1" => array("barretto", "barretto3.jpg"),
												"25" => array("ilocos", "ilocos3.jpg"),
												"9" => array("zambales", "zambales3.jpg")
											);
								
								foreach($location as $key => $value){
									echo "<div class='col-md-4 col-sm-6 col-xs-12 margin-top-top'>
											<a href='".DOMAIN."destination/".$value[0]."' class='blinks' style='cursor:pointer;'>
												<div class='thumb-destination'><img src='".DOMAIN."images/Body/".$value[1]."'></div>
											</a>
										</div>";
								}
							?>
						</div>
					</div>
				</div>
			</div>
		</section>
		<section id="footer-wrapper">
			<?php include_once "ssi/footer.php";?>
		</section>
		<!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> -->
		<script src="//use.fontawesome.com/b7ea8ae414.js"></script>
		<!-- <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.16.0/moment.min.js"></script> -->
		<!-- <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>-->
		<!-- <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.43/js/bootstrap-datetimepicker.min.js"></script> -->
		<script type="text/javascript" src="js/jquery.js"></script>
		<script type="text/javascript" src="js/bootstrap.js"></script>
		<!-- <script type="text/javascript" src="slider/engine1/wowslider.js"></script>
		<script type="text/javascript" src="slider/engine1/script.js"></script> -->
		<script type="text/javascript" src="backstretch/jquery.backstretch.min.js"></script>
		<script type="text/javascript" src="js/moment.js"></script>
		<script type="text/javascript" src="js/bootstrap-datetimepicker.js"></script>
		<script type="text/javascript" src="js/jquery.mockjax.js"></script>
		<script type="text/javascript" src="js/jquery.autocomplete.js"></script>
		<script type="text/javascript" src="js/search.js"></script>
		<script type="text/javascript" src="js/calendarfunctions.js"></script>
		<script src="js/subscribe.js" type="text/javascript"></script>
		<script>
			$(function (){
				$("#da_picker").datetimepicker({
					format:"YYYY-MM-DD",
					minDate:moment()
				}).on("dp.change", function(e){
					set_departure();
					set_night();
				});
				
				$("#dd_picker").datetimepicker({
					format:"YYYY-MM-DD",
					minDate:moment()
				}).on("dp.change", function(e){
					set_night();
				});
			});
			
			$("[name='hotel_search']").submit(function(){
				$("#autocomplete").css("border-color", "");
				
				if($("#location").val()==""){
					$("#autocomplete").css("border-color", "#ff0000");
					return false;
				}
				return true;
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

			$.backstretch([
				"<?=DOMAIN;?>images/Slider/slide-one.jpg",
				"<?=DOMAIN;?>images/Slider/slide-two.jpg",
				"<?=DOMAIN;?>images/Slider/slide-three.jpg",
				"<?=DOMAIN;?>images/Slider/slide-four.jpg",
				"<?=DOMAIN;?>images/Slider/slide-five.jpg",
				"<?=DOMAIN;?>images/Slider/slide-six.jpg",
				"<?=DOMAIN;?>images/Slider/slide-seven.jpg"
			], {
				duration: 3000,
				fade: 750
			});
		</script>
	</body>
</html>
