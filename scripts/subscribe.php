<?php
	include_once "functions.php";
	include_once "query.php";
	
	$ma_con = db_connect(MA_DB);
	
	$email_address = addslash($_POST['subscribe-email']);
	
	$error = 0;
	$message = "Thank you for subscribing to our newsletter. You\'ve been added to our list and will hear from us soon.";
	
	$row="";
	$row = db_select("SELECT email, deleted FROM newsletter_email WHERE email='$email_address'", $ma_con);
	if($row){
		if(trim(stripslashes($row[0]['deleted'])) == 0){
			$error = 1;
			$message = "The email is already registered in the system. Please enter another email to subscribe to the newsletter.";
		}
		else{
			execute_query("UPDATE newsletter_email SET deleted='0'", $ma_con);
		}
	}
	else{
		execute_query("INSERT INTO newsletter_email(email, date_added, deleted) VALUES ('$email_address', '".date("Y-m-d H:i:s")."', '0')", $ma_con);
	}
	
	if($error == 0){
		$headers  = "MIME-Version: 1.0"."\r\n";
		$headers .= "Content-type: text/plain; charset=utf-8"."\r\n";
		$headers .= "From: GoToGo <contact@gotogo.com>"."\r\n";
		
		$to = "apidev@gotoplus.com, webdev@gotoplus.com";
		$subject = "GoToGo Newsletter";
		
		$emessage = "New newsletter subscribe notification\n\n";
		$emessage .= "Customer email: $email_address\n\n\n";
		$emessage .= "© 2017 Online Travel Gotogo | All rights reserved";
		
		mail($to, $subject, $emessage, $headers);
		
		$headers .= "Bcc: $to";
		
		$to = $email_address;
		$subject = "GoToGo Newsletter";
		
		$emessage = "Greetings!\n\n";
		$emessage .= "You are subscribed as $email_address\n\n\n";
		$emessage .= "© 2017 Online Travel Gotogo | All rights reserved";
		
		mail($to, $subject, $emessage, $headers);
	}
	
	echo "{
			'error':'$error',
			'message':'$message'
		}";
?>	