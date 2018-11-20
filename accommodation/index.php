<?php
	include_once "../goto-links.php";
	include_once "../scripts/functions.php";
	
	//if($_POST['hid']){
	//	$hotel_id = $_POST['hid'];
	//	$date_arrival = $_POST['date_arrival'];
	//	$date_departure = $_POST['date_departure'];
	//	$location = $location_hdn = $_POST['location'];
	//	
	//	$location_arr = explode("|", $location);
	//	
	//	if($location_arr[0] == "place"){
	//		$location = $location_arr[1].", ".$location_arr[2].", ".$location_arr[3];
	//	}
	//	
	//	if($location_arr[0] == "locationid"){
	//		$location = file_get_contents(WEBSERVICE."gotogo/location.php?id=".$location_arr[1]);
	//		$location = json_decode($location, true);
	//		$location = $location['locations'][0]['name'];
	//	}
	//	
	//	if($location_arr[0] == "country"){
	//		$location = $location_arr[1];
	//	}
	//}
	//else{
	//	header("Location:index.php");
	//	exit();
	//}
	
	$hotel_name = $_GET['name'];
	
	$hotel = file_get_contents(WEBSERVICE."gotogo/hotel-meta.php?name=$hotel_name");
	$hotel = json_decode($hotel, true);
	$hotel_id = $hotel['id'];
	
	$date_arrival = (trim($_COOKIE['da-'.$hotel_id])!="" && is_numeric($_COOKIE['da-'.$hotel_id])) ? date("Y-m-d", $_COOKIE['da-'.$hotel_id]) : date("Y-m-d", strtotime("+1 day"));
	$date_departure = (trim($_COOKIE['dd-'.$hotel_id])!="" && is_numeric($_COOKIE['dd-'.$hotel_id])) ? date("Y-m-d", $_COOKIE['dd-'.$hotel_id]) : date("Y-m-d", strtotime("+2 day"));
	$btn_val = (!in_array($hotel_id, $c2b)) ? "Check Availability" : "Call to Book";
	
	$hotel = file_get_contents(WEBSERVICE."gotogo/hotel.php?id=$hotel_id&ds=$date_arrival&de=$date_departure&ca=false");
	$hotel = json_decode($hotel, true);
	
	$location = $location_hdn = (trim($_COOKIE['location-'.$hotel_id])!="") ? $_COOKIE['location-'.$hotel_id] : "locationid|".$hotel['hotels'][0]['locationid'];
	
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
		$location = $hotel['hotels'][0]['name'];
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

		<?php include_once "../ssi/metas.php";?>
		<title>GoToGo | Hotel Profile</title> 
		<link href="<?=DOMAIN;?>css/bootstrap.css" rel="stylesheet">
		<link href="<?=DOMAIN;?>fontawesome/font-awesome-4.5.0/css/font-awesome.css" rel="stylesheet">
		<link href="//fonts.googleapis.com/css?family=Roboto+Slab" rel="stylesheet">
		<link href="//fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
		<link href="<?=DOMAIN;?>css/styles.css" rel = "stylesheet">
		<link rel="stylesheet" href="<?=DOMAIN;?>slider/Glide.js-master/dist/css/glide.core.css">
		<link rel="stylesheet" href="<?=DOMAIN;?>slider/Glide.js-master/dist/css/glide.theme.css">
		<link rel="stylesheet" type="text/css" href="<?=DOMAIN;?>datepicker/jquery-ui.min.css">
		<link rel="stylesheet" type="text/css" href="<?=DOMAIN;?>datepicker/jquery-ui.theme.css">
		<?php include_once "../ssi/favicons.php";?>
		<style type="text/css">
			html, body {
				background-color:#F5F5F5;
			}
			.autocomplete-suggestions { border: 1px solid #999; background: #fff; width: auto !important; cursor: default; overflow: auto; font-family: "Open Sans", Sans-serif; font-size:10px; }
			.autocomplete-suggestion { padding: 10px 5px; font-size: 1.2em; white-space: nowrap; overflow: hidden; }
			.autocomplete-selected { background: #f0f0f0; }
			.autocomplete-suggestions strong { font-weight: normal; color: #3399ff; }
			
			#tblheadRooms.stick {
			    margin-top: 0 !important;
			    position: fixed;
			    top: 0;
			    z-index: 10000;
			    background-color: #f5f5f5;
			}
			#chkAvailabilityButton.stick {
				margin-top: 0 !important;
			    position: fixed;
			    top: 60px;
    			/*margin-left: -103px;*/
			    z-index: 10000;
			}
		</style>
		<!--
		<script src="angular-1.5.3/angular.js"></script>
		<script src="angular-1.5.3/angular-animate.js"></script>                                    
		-->
	</head>
	<body>
		<!-- Google Tag Manager (noscript) -->
		<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-T82TQSK"
		height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
		<!-- End Google Tag Manager (noscript) -->

		<section id="navigation-wrapperBlue">
			<?php include_once "../ssi/navbar-blue.php";?>
		</section>
		<div class="container-fluid padding-zero" style="margin-top: 76px;">
			<div class="container padding-zero">
				<div class="row">
					<div class="col-md-3"> 
						<div id="ember538" class="ember-view">
							<div class="container-fluid padding-zero margin-top-medium">
								<div class="panel panel-warning margin-zero padding-zero calendar">
									<form name="hotel_search" method="post" action="<?=DOMAIN;?>search.php">
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
					</div>
					<?php
						if(count($hotel['hotels']) > 0){
							$arrival_date = $hotel['arrival'];
							$departure_date = $hotel['departure'];
							$num_nights = intval(((strtotime($departure_date) - strtotime($arrival_date)) / 3600) / 24);
							$nights = ($num_nights > 1) ? "nights" : "night";
							
							if(date("Y", strtotime($arrival_date)) != date("Y", strtotime($departure_date))){
								$travel_dates .= "<strong>".date("l j F Y", strtotime($arrival_date))."</strong> to <strong>".date("l j F Y", strtotime($departure_date))."</strong>";
							}
							else{
								if(date("m", strtotime($arrival_date)) != date("m", strtotime($departure_date))){
									$travel_dates .= "<strong>".date("l j F", strtotime($arrival_date))."</strong> to <strong>".date("l j F Y", strtotime($departure_date))."</strong>";
								}
								else{
									$travel_dates .= "<strong>".date("l j", strtotime($arrival_date))."</strong> to <strong>".date("l j F Y", strtotime($departure_date))."</strong>";
								}
							}
							
							$hotel = $hotel['hotels'][0];
							
							echo "<div class='col-md-9'>
									<div class='clearfix border-bottom'>
										<div class='pull-left'>
											<h3>
												<b>".$hotel['name']."</b>&nbsp;
												<!--<span class='text-info' style='font-size:10pt'>
													<i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i>
												</span>-->
											</h3>
											<span><i class='fa fa-marker'></i>".$hotel['address'].", ".$hotel['country']."</span>
										</div>
									</div>
									<div id='hotelImg'>
									   	<div class='row'>
											<div id='myCarousel' class='carousel slide' data-ride='carousel'>
												<!-- Indicators -->
												<!-- <ol class='carousel-indicators'>
													<li data-target='#myCarousel' data-slide-to='0' class='active'></li>
													<li data-target='#myCarousel' data-slide-to='1'></li>
													<li data-target='#myCarousel' data-slide-to='2'></li>
													<li data-target='#myCarousel' data-slide-to='3'></li>
												</ol> -->

												<!-- Wrapper for slides -->
												<div class='carousel-inner' role='listbox'>";

													$hotel_img_ctr = 0;
													foreach($hotel['images'] as $key => $value){
														$active = ($hotel_img_ctr == 0) ? "active" : "";

														echo "						
															<div class='$active item' data-slide-number='$hotel_img_ctr'>
															<img src='".OPONLINE.WEBSSI."imaging.php?width=1200&height=480&cropratio=2.5:1&noimg=100&image=".urlencode($value)."' class='img-responsive' style='margin:0 auto;'>
															</div>
														";

														$hotel_img_ctr++;
													}

											echo "
												</div>

												<!-- Left and right controls -->
												<a class='left carousel-control' href='#myCarousel' role='button' data-slide='prev'>
													<span class='glyphicon glyphicon-chevron-left' aria-hidden='true'></span>
													<span class='sr-only'>Previous</span>
												</a>
												<a class='right carousel-control' href='#myCarousel' role='button' data-slide='next'>
													<span class='glyphicon glyphicon-chevron-right' aria-hidden='true'></span>
													<span class='sr-only'>Next</span>
												</a>
											</div>
										</div>
									</div>
									<div class='row' style='padding-top:1em;padding-bottom:1em'>
										<div class='col-md-6'>
											<div style='position: relative'>
												<div style='display: inline-block;position: absolute;left:0;'>
													<i class='fa fa-check mobilegone' style='font-size: 30px; color: #FFFFFF;text-align: center;border-radius: 100%;background: #8BC34A;width: 50px;line-height: 50px;height: 50px;'></i>
												</div>
												<div style='padding-left: 65px;'>
													<h3 class='remove-margin'>NO HIDDEN FEES OR EXTRA CHARGES!</h3>
												</div>
											</div> 
										</div> 
										<div class='col-md-6'>
											<div style='position: relative'>
												<div style='display: inline-block;position: absolute;left:0;'>
													<i class='fa fa-check-square-o' style='font-size: 54px; color: #FF9800;'></i>
												</div>
												<div style='padding-left: 65px;'>
													<h3 class='remove-margin'>DIRECT CONFIRMED BOOKING TO THE HOTEL</h3>
												</div>
											</div>
										</div>        
									</div>    
									<div id='hotelRooms'>
										<div class='content-container' style='padding:1em'>
											<h4>Choose your roomtype</h4>
											<h5 class='text-default-color'>Available rooms from $travel_dates&nbsp;($num_nights $nights)</h5>
											<p class='text-danger'>The rates you see on the website is final. The price is already inclusive of taxes and no service fee is required.</p>
											<div>
											<table class='table table-bordered table-hover'>
												<thead>
													<tr id='tblheadRooms'>
														<th id='first' style='text-align:center;width:30%;'>Roomtype</th>
														<th id='second' style='text-align:center;width:20%;'>Person per room</th>
														<th id='third' style='text-align:center;width:20%;'>Price per night</th>
														<th id='fourth' style='text-align:center;width:30%;'>Action</th>
													</tr>
												</thead>
												<tbody>";
							
							$roomtype_ctr = 0;
							foreach($hotel['roomtypes'] as $key => $value){
								//$btn_check = ($hotel_id == "147") ? "onclick=\"window.location='../contact.php';\"" : "id='chkAvailabilityButton'";
								$roomtype_image = (count($value['images']) > 0) ? OPONLINE.WEBSSI."imaging.php?width=100&height=100&cropratio=1:1&noimg=100&image=".urlencode($value['images'][0]) : "images/not-available.png";
								$roomtypes = ($roomtype_ctr == 0) ? "<td id='tdfourth' style='width:30%;' rowspan='".count($hotel['roomtypes'])."'><button type='button' class='btn btn-sm btn-primary' id='chkAvailabilityButton'>$btn_val</button><div id='tblAnchorRooms'></div></td>" : "";
								
								$pax="";
								for($pax_ctr = 1; $pax_ctr <= $value['maxpax']; $pax_ctr++){
									$pax .= "<i class='fa fa-user'></i>";
									$pax .= ($pax_ctr % 4 == 0) ? "<br/>" : "&nbsp;";
								}
								
								echo "				<tr class='rooms' style='height:100px;'>
														<td id='tdfirst' style='width: 30%;'><img src='$roomtype_image'>&nbsp;<strong>".$value['name']."</strong></td>
														<td id='tdsecond' style='text-align:center;width:20%;'>$pax</td>
														<td id='tdthird' style='text-align:center;width:20%;'>".$hotel['currency']." ".number_format($value['rate'])."</td>
														$roomtypes
													</tr>";
								
								$roomtype_ctr++;
							}
							
							echo "				</tbody>  
											</table>
											<div id='footAnchorRooms'></div>
											</div>
											<div class='list-group' id='facilities'>
												<div class='list-group-item active'>
													Hotel Facilities
												</div>
												<div class='list-group-item'>
													<table id='facilities' class='table table-striped margin-top-small' style='margin:0px;'>
														<tr>
															<td style='border-top:0px;'><strong>General</strong></td>
															<td style='border-top:0px;'>".htmlspecialchars_decode($hotel['facilities']['general'])."</td>
														</tr>
														<tr>
															<td><strong>Activities</strong></td>
															<td>".htmlspecialchars_decode($hotel['facilities']['activities'])."</td>
														</tr>
														<tr>
															<td><strong>Services</strong></td>
															<td>".htmlspecialchars_decode($hotel['facilities']['services'])."</td>
														</tr>
														<tr>
															<td><strong>Internet</strong></td>
															<td>".htmlspecialchars_decode($hotel['facilities']['internet'])."</td>
														</tr>
														<tr>
															<td><strong>Parking</strong></td>
															<td>".htmlspecialchars_decode($hotel['facilities']['parking'])."</td>
														</tr>
														<tr>
															<td><strong>Food & Beverages</strong></td>
															<td>".htmlspecialchars_decode($hotel['facilities']['food'])."</td>
														</tr>
													</table>
												</div>
											</div>
											<div class='list-group' id='policies'>
												<div class='list-group-item active'>
													Hotel Policies
												</div>
												<div class='list-group-item'>
													<table id='policies' class='table table-striped margin-top-small' style='margin:0px;'>
														<tr>
															<td style='border-top:0px;'><strong>House Rules</strong></td>
															<td style='border-top:0px;'>".htmlspecialchars_decode($hotel['policies']['houserules'])."</td>
														</tr>
														<tr>
															<td><strong>Check-In</strong></td>
															<td>".htmlspecialchars_decode($hotel['policies']['checkin'])."</td>
														</tr>
														<tr>
															<td><strong>Check-Out</strong></td>
															<td>".htmlspecialchars_decode($hotel['policies']['checkout'])."</td>
														</tr>
														<tr>
															<td><strong>Cancellation</strong></td>
															<td>".htmlspecialchars_decode($hotel['policies']['cancellation'])."</td>
														</tr>
														<tr>
															<td><strong>Children</strong></td>
															<td>".htmlspecialchars_decode($hotel['policies']['children'])."</td>
														</tr>
														<tr>
															<td><strong>Pets</strong></td>
															<td>".htmlspecialchars_decode($hotel['policies']['pets'])."</td>
														</tr>
														<tr>
															<td><strong>Credit card accepted at the hotel</strong></td>
															<td>".htmlspecialchars_decode($hotel['policies']['ccard'])."</td>
														</tr>
														<tr>
															<td><strong>Non-refundable</strong></td>
															<td>".htmlspecialchars_decode($hotel['policies']['nonref'])."</td>
														</tr>
													</table>
												</div>
											</div>
											<div class='list-group' id='policies'>
												<div class='list-group-item active'>
													Area Information
												</div>
												<div class='list-group-item'>
													<table id='policies'>
														<tr>
															<td>".htmlspecialchars_decode($hotel['areainfo'])."</td>
														</tr>
													</table>
												</div>
											</div>
											<div class='list-group' id='policies'>
												<div class='list-group-item active'>
													Important Information
												</div>
												<div class='list-group-item'>
													<table id='policies'>
														<tr>
															<td>".htmlspecialchars_decode($hotel['imptinfo'])."</td>
														</tr>
													</table>
												</div>
											</div>
											<div class='list-group' id='policies'>
												<div class='list-group-item active'>
													Terms & Conditions
												</div>
												<div class='list-group-item'>
													<table id='policies'>
														<tr>
															<td>".htmlspecialchars_decode($hotel['terms'])."</td>
														</tr>
													</table>
												</div>
											</div>
										</div>   
									</div>
								</div>";
						}
					?>
					<?php if(!in_array($hotel_id, $c2b)){ ?>
					<form name="booking_page" method="post" action="<?=OPONLINE;?>">
						<input type="hidden" name="online_hid" value="<?=$hotel_id;?>"/>
						<input type="hidden" name="txtDateStart" value="<?=$date_arrival;?>"/>
						<input type="hidden" name="txtDateEnd" value="<?=$date_departure;?>"/>
						<input type="hidden" name="txtHomePage" value="<?="http".(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on" ? "s" : "")."://".$_SERVER['SERVER_NAME'].$_SERVER['PHP_SELF'];?>"/>
						<input type="hidden" name="bypass_dates" value="true"/>
					</form>
					<?php } ?>
				</div>
			</div>  
		</div>
		<section id="footer-wrapper">
			<?php include_once "../ssi/footer.php";?>
		</section>
		<script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
		<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
		<script src="//code.jquery.com/jquery-latest.min.js"></script>
		<script src="<?=DOMAIN;?>js/bootstrap.js"></script>
		<script type="text/javascript" src="<?=DOMAIN;?>datepicker/jquery-ui.js"></script>
		<script type="text/javascript" src="<?=DOMAIN;?>js/jquery.mockjax.js"></script>
		<script type="text/javascript" src="<?=DOMAIN;?>js/jquery.autocomplete.js"></script>
		<script type="text/javascript" src="<?=DOMAIN;?>js/search.js"></script>
		<script type="text/javascript" src="<?=DOMAIN;?>datepicker/calendarfunctions.js"></script>
		<script src="<?=DOMAIN;?>js/subscribe.js" type="text/javascript"></script>
		<script type="text/javascript">
			function sticky_relocate() {
				var window_top = $(window).scrollTop();
				var div_top = $('#tblAnchorRooms').offset().top;
				var div_foot = $('#footAnchorRooms').offset().top;
				
				if (window_top > div_top) {
					var headerWidth = $('#tblheadRooms').width();
					var headerHeight = $('#tblheadRooms').height();
					var firstHeight = $('#tdfirst').width() + 18;
					var secondHeight = $('#tdsecond').width() + 18;
					var thirdHeight = $('#tdthird').width() + 18;
					var fourthHeight = $('#tdfourth').width() + 18;

					$('#tblheadRooms').addClass('stick');
					$('#chkAvailabilityButton').addClass('stick');
					$('#tblheadRooms').css({'width': headerWidth+'px'});
					$('#first').css({'width': firstHeight+'px'});
					$('#second').css({'width': secondHeight+'px'});
					$('#third').css({'width': thirdHeight+'px'});
					$('#fourth').css({'width': fourthHeight+'px'});
					$('#tblAnchorRooms').height($('#tblheadRooms').outerHeight());
				}else {
					$('#tblheadRooms').removeClass('stick');
					$('#chkAvailabilityButton').removeClass('stick');
					$('#tblAnchorRooms').height(0);
				}

				if (window_top > div_foot) {
					$('#tblheadRooms').removeClass('stick');
					$('#chkAvailabilityButton').removeClass('stick');
					$('#tblAnchorRooms').height(0);
				}

				
			}
			
			$("[name='hotel_search']").submit(function(){
				$("#autocomplete").css("border-color", "");
				
				if($("#location").val()==""){
					$("#autocomplete").css("border-color", "#ff0000");
					return false;
				}
				return true;
			});

			$(function() {
				$(window).scroll(sticky_relocate);
				sticky_relocate();
			});
			
			$(document).on('ready', function(){
				$('#iconDateStart').click(function(){
					$('#txtDateStart').datepicker("show");
				});
				$('#iconDateEnd').click(function(){
					$('#txtDateEnd').datepicker("show");
				});
			});
			
			$("#chkAvailabilityButton").click(function(){
				<?php if(!in_array($hotel_id, $c2b)){ ?>
				$("[name='booking_page']").submit();
				<?php } else{ ?>
				window.location = "<?=DOMAIN;?>contact.php";
				<?php }  ?>
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