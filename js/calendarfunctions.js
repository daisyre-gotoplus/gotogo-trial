function set_night(){
	if($('#date_arrival').val()!=""){
		var date_start = $('#date_arrival').val();
		var date_end = $('#date_departure').val();
		
		var date_start_arr = date_start.split("-");
		var date_end_arr = date_end.split("-");
		
		var date_start = new Date(date_start_arr[0]+"/"+date_start_arr[1]+"/"+date_start_arr[2]);
		var date_end = new Date(date_end_arr[0]+"/"+date_end_arr[1]+"/"+date_end_arr[2]);
		var nights = Math.abs(Math.round((date_start - date_end) / 86400000));
		
		if(nights == 0){
			nights = 1;
		}
		
		$('#nights').val(nights);
	}
	else{
		alert("Select date of arrival first.");
	}
	
}
function set_departure(){
	var date_start = $('#date_arrival').val();
	var date_end = $('#date_departure').val();
	
	if(date_end==""){
		date_end = "0000-00-00";
	}
	
	date_start_arr = date_start.split("-");
	date_end_arr = date_end.split("-");
	
	var date_start = date_start_arr[0]+date_start_arr[1]+date_start_arr[2];
	var date_end = date_end_arr[0]+date_end_arr[1]+date_end_arr[2];
	
	var date_start_parsed = parseInt(date_start);
	var date_end_parsed = parseInt(date_end);
	
	if(date_start_parsed >= date_end_parsed){
		var date_start = new Date(date_start_arr[0]+"/"+date_start_arr[1]+"/"+date_start_arr[2]);
		var date_start_valueof = date_start.valueOf() + (24 * 60 * 60 * 1000);
		var date_start_new = new Date(date_start_valueof);
		var date_end = new Date(date_start_new.toLocaleDateString());
		
		var day = date_end.getDate();
		var month = date_end.getMonth() + 1;
		var year = date_end.getFullYear();
		
		month = (month < 10) ? "0"+month : month;
		day = (day < 10) ? "0"+day : day;
		
		$('#date_departure').val(year+"-"+month+"-"+day);
	}
}