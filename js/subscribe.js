$("#form_subscribe").submit(function(){
	$("#btn_subscribe").blur();
	
	if(!$("#btn_subscribe").hasClass("disabled")){
		$("#subscribe_msg").removeClass("alert-danger alert-success").css("display", "none");
		$("input[name='subscribe-email']").attr("readonly", true);
		$("#btn_subscribe").addClass("disabled");
		
		var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		
		if(regex.test($("input[name='subscribe-email']").val())){
			var xhr = new XMLHttpRequest();
			xhr.open("POST", "//"+location.host+"/scripts/subscribe.php");
			xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			xhr.onload = function(){
				var class_name;
				var response = eval('('+ xhr.responseText +')');
				
				if(response.error == 1){
					class_name = "alert-danger";
				}
				else{
					class_name = "alert-success";
					$("input[name='subscribe-email']").val("");
				}
				
				$("input[name='subscribe-email']").removeAttr("readonly");
				$("#btn_subscribe").removeClass("disabled");
				$("#subscribe_msg").addClass(class_name).html(response.message).fadeIn("fast");
			};
			xhr.send($(this).serialize());
		}
		else{
			$("input[name='subscribe-email']").removeAttr("readonly");
			$("#btn_subscribe").removeClass("disabled");
			$("#subscribe_msg").addClass("alert-danger").html("Please enter a valid email address").fadeIn("fast");
		}
	}
	
	return false;
});