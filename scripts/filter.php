<?php
	include_once "../goto-links.php";
	include_once "functions.php";
	include_once "query.php";
	
	$date_arrival = $_POST['date_arrival'];
	$date_departure = $_POST['date_departure'];
	$location = $_POST['location'];
	$price = $_POST['fprice'];
	$facilities = $_POST['ffacilities'];
	
	$qs="";
	$facility = array();
	
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
	
	if(is_array($facilities)){
		foreach($facilities as $key => $value){
			$filter_fac = explode(", ", $value);
			
			foreach($filter_fac as $key1 => $value1){
				$facility[] = urlencode($value1);
			}
		}
	}
	
	$facility = implode("|", $facility);
	
	if($location_arr[0] == "place"){
		$qs = "place=".urlencode($location_arr[1])."|".urlencode($location_arr[2])."|".urlencode($location_arr[3]);
		$location = "in ".$location_arr[1].", ".$location_arr[2].", ".$location_arr[3];
	}
	
	if($location_arr[0] == "locationid"){
		$qs = "lid=".$location_arr[1];
		$location = file_get_contents(WEBSERVICE."gotogo/location.php?id=".$location_arr[1]);
		$location = json_decode($location, true);
		$location = (count($location['locations']) > 0) ? "in ".$location['locations'][0]['name'] : "";
	}
	
	if($location_arr[0] == "country"){
		$qs = "country=".$location_arr[1];
		$location = "in ".$location_arr[1];
	}
	
	if($location_arr[0] == "metaname"){
		$hotel = file_get_contents(WEBSERVICE."gotogo/hotel-meta.php?name=".$location_arr[1]);
		$hotel = json_decode($hotel, true);
		$hotel_id = $hotel['id'];
		
		$qs = "id=".$hotel_id;
		$location = "found";
	}
	
	$hotel = file_get_contents(WEBSERVICE."gotogo/hotel.php?$qs&ds=$date_arrival&de=$date_departure&fprice=$price&ffacilities=$facility&ca=false");
	$hotel = json_decode($hotel, true);
	
	$hotel_count = $hotel['hotelcount']." Hotel";
	$hotel_count .= ($hotel['hotelcount'] > 1) ? "s" : "";
	
	echo "<h2>$hotel_count $location</h2>
		<br/>";
	
	if(count($hotel['hotels']) > 0){
		$arrival_date = $hotel['arrival'];
		$departure_date = $hotel['departure'];
		
		if(date("Y", strtotime($arrival_date)) != date("Y", strtotime($departure_date))){
			$travel_dates .= date("l j F Y", strtotime($arrival_date))." to ".date("l j F Y", strtotime($departure_date));
		}
		else{
			if(date("m", strtotime($arrival_date)) != date("m", strtotime($departure_date))){
				$travel_dates .= date("l j F", strtotime($arrival_date))." to ".date("l j F Y", strtotime($departure_date));
			}
			else{
				$travel_dates .= date("l j", strtotime($arrival_date))." to ".date("l j F Y", strtotime($departure_date));
			}
		}
		
		echo "<h4>Available hotels from $travel_dates</h4>
			<div class='col-md-12 nhcdcb-container'>
				<div class='col-md-5 nhc'>
					<span>NO HIDDEN CHARGES OR EXTRA FEES</span>
				</div>
				<div class='col-md-1'></div>
				<div class='col-md-5 dcb'>
					<span>DIRECT CONFIRMED BOOKING TO HOTEL</span>
				</div>    
			</div>
			<br/><hr/>
			<div id='hotel-list'>
				<ul class='list' style='list-style:none;'>";
		
		foreach($hotel['hotels'] as $hotel_key => $hotel_value){
			$hotel_image = (count($hotel_value['images']) > 0) ? $hotel_value['images'][0] : "images/not-available.png";
			$hotel_desc_length = strlen(htmlspecialchars_decode($hotel_value['description']));
			
			if($hotel_desc_length > 366){
				$desc_class = "hideContent";
				$desc_gradient = "<div class='showdetails fadedesc'></div>";
				$more = "<div class='show-more'>Show more</div>";
			}
			
			echo "	<li><div class='element row'>
						<div class='col-md-3 search-hotel-image'>
							<img src='".OPONLINE.WEBSSI."imaging.php?width=200&height=200&cropratio=1:1&noimg=100&image=".urlencode($hotel_image)."' />
						</div>
						<div class='col-md-9'>
							<a onclick=\"set_cookie('".$hotel_value['id']."', '".$hotel_value['meta']."', '".$hotel_value['locationid']."');\" style='cursor:pointer; text-decoration:none;'>
								<h4 class='name' style='text-decoration:underline;'>".$hotel_value['name']."</h4>
							</a>
							<p>".$hotel_value['address'].", ".$hotel_value['country']."</p>
							<div class='hoteldesc $desc_class' style='float:left; position:relative; text-align:justify; font-family:\"Open Sans\", Sans-serif; font-size:13px;'>
								".htmlspecialchars_decode($hotel_value['description'])."
								$desc_gradient
							</div>
							$more
							<p style='font-weight:bold;'><span style='font-style:italic; font-size:12px; font-family:inherit;'>rates from </span><span style='color:#ff0000; font-size:18px; font-family:inherit;'>".$hotel_value['currency']." ".number_format($hotel_value['roomtypes'][0]['rate'])."</span></p>
						</div>
					</div>
					<hr/></li>";
		}
		
		echo "	</ul>
				<ul class='pagination'></ul>
			</div>";
	}
?>