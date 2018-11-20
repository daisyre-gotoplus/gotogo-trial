<?php
	include_once "scripts/functions.php";
	include_once "scripts/query.php";
	
	if(isset($_POST['btn_su_gotogo']) && $_POST['btn_su_gotogo']!=""){
		include_once "scripts/password-hash.php";
		
		$ma_con = db_connect(MA_DB);
		
		$success = false;
		
		$first_name = addslash($_POST['signup-fname']);
		$last_name = addslash($_POST['signup-lname']);
		$email_address = addslash($_POST['signup-email']);
		$password = addslash($_POST['signup-password']);
		$confirm_password = addslash($_POST['signup-repassword']);
		
		if(trim($first_name)=="" || trim($last_name)=="" || trim($email_address)=="" || trim($password)=="" || trim($confirm_password)==""){
			$message = "All fields are required";
		}
		else{
			if(strcmp($password, $confirm_password) !== 0){
				$message = "Password did not match";
			}
			else{
				$message="";
				$error_occured = true;
				$password_hash = new PasswordHash(8, FALSE);
				
				$row="";
				$row = db_select("SELECT email FROM users WHERE email='$email_address'", $ma_con);
				if($row){
					$message = "Email address already exist";
				}
				else{
					$date = date("Y-m-d H:i:s");
					$ma_password = $password_hash->HashPassword($password);
					
					execute_query("INSERT INTO users(password, email, activated, last_ip, created, modified) VALUES ('$ma_password', '$email_address', '0', '".$_SERVER['REMOTE_ADDR']."', '$date', '$date')", $ma_con);
					$ma_user_id = mysql_insert_id();
					
					execute_query("INSERT INTO ".MA_DB_PREFIX."member(email, password, last_name, first_name, changed, active, deleted, user_id) VALUES ('$email_address', '$ma_password', '$last_name', '$first_name', 'Y', 'N', '0', '$ma_user_id')", $ma_con);
					
					$activation_key = md5($ma_user_id.$email_address)."-".sha1($ma_user_id.$email_address);
					
					$headers  = "MIME-Version: 1.0"."\r\n";
					$headers .= "Content-type: text/plain; charset=utf-8"."\r\n";
					$headers .= "From: GoToGo <contact@gotogo.com>"."\r\n";
					$headers .= "Bcc: apidev@gotoplus.com, webdev@gotoplus.com";
					
					$to = $email_address;
					$subject = "GoToGo Account Activation";
					
					$message = "Dear $first_name $last_name,\n\n";
					$message .= "We value your identity and privacy as much as you do!\n\n";
					$message .= "To authenticate and activate your account, please copy and paste the link below to your browser.\n\n";
					$message .= "http".(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on" ? "s" : "")."://".$_SERVER['SERVER_NAME'].dirname($_SERVER['PHP_SELF']).(dirname($_SERVER['PHP_SELF']) == "/" ? "" : "/")."account-activation.php?a=$activation_key\n\n\n";
					$message .= "GOTOGO\n\n\n";
					$message .= "© 2017 Online Travel Gotogo | All rights reserved";
					
					mail($to, $subject, $message, $headers);
					
					$message = "Successful. Please check your email to activate your account.";
					$success = true;
					$first_name=$last_name=$email_address="";
				}
			}
		}
	}
	
	if($_SESSION['is_logged']){
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
		<title>GoToGo | Sign Up</title> 
		<!-- Bootstrap Latest compiled and minified CSS -->
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous" />
		<!-- My Styles -->
		<link rel = "stylesheet" href="<?=DOMAIN;?>css/styles.css" />
		<!-- Fonts -->
		<link href="//fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" />
		<?php include_once "ssi/favicons.php";?>
		<!-- Wow Slider -->
		<link rel="stylesheet" type="text/css" href="<?=DOMAIN;?>slider/engine1/style.css" />
		<!-- Feather Light -->
		<link href="//cdn.rawgit.com/noelboss/featherlight/1.5.0/release/featherlight.min.css" type="text/css" rel="stylesheet" />
		<link rel="stylesheet" href="<?=DOMAIN;?>css/owl.carousel.css" />
		<link rel="stylesheet" href="<?=DOMAIN;?>css/owl.theme.css" />
	</head>
	<body>
		<!-- Google Tag Manager (noscript) -->
		<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-T82TQSK"
		height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
		<!-- End Google Tag Manager (noscript) -->

		<section id="navigation-wrapperBlue">
			<?php include_once "ssi/navbar-blue.php";?>
		</section>
        <!-- ******Signup Section****** --> 
        <section class="signup-section access-section section">
            <div class="container">
                <div class="row">
                    <div class="form-box col-md-8 col-sm-12 col-xs-12 col-md-offset-2 col-sm-offset-0 xs-offset-0">
                        <div class="form-box-inner" style="text-align:center">
                        	<?php if(isset($_POST['btn_su_gotogo']) && $_POST['btn_su_gotogo']!="" && trim($message)!=""){ ?>
							<div class="alert alert-<?=($success) ? "success" : "danger";?>" style="padding:15px; font-weight:bold; text-align:left;"><?=$message;?></div>
							<?php } ?>
							<h2>Create Your Profile</h2>
							<form method="post" action="" name="form_su_gotogo" class="signup-form">
								<div class="form-group user">
									<label class="sr-only" for="signup-fname">First Name</label>
									<input name="signup-fname" type="text" value="<?=$first_name;?>" class="form-control login-email" placeholder="First Name"/>
								</div>
								<div class="form-group user">
									<label class="sr-only" for="signup-lname">Last Name</label>
									<input name="signup-lname" type="text" value="<?=$last_name;?>" class="form-control login-email" placeholder="Last Name"/>
								</div>                
								<div class="form-group email">
									<label class="sr-only" for="signup-email">Your Email</label>
									<input name="signup-email" type="email" value="<?=$email_address;?>" class="form-control login-email" placeholder="Your email"/>
								</div>
								<div class="form-group password">
									<label class="sr-only" for="signup-password">Your Password</label>
									<input name="signup-password" type="password" class="form-control login-password" placeholder="Password"/>
								</div>
								<div class="form-group password">
									<label class="sr-only" for="signup-repassword">Confirm Password</label>
									<input name="signup-repassword" type="password" class="form-control login-password" placeholder="Confirm Password"/>
								</div>
								<input type="submit" name="btn_su_gotogo" class="btn btn-block btn-cta-primary" value="Sign Up"/>
								<p class="note">By signing up, you agree to our terms of services and privacy policy.</p>
								<p class="lead">Already have an account? <a class="login-link" id="login-link" href="<?=DOMAIN;?>signin.php">Sign in</a></p>  
							</form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
		<section id="footer-wrapper">
			<?php include_once "ssi/footer.php";?>
		</section>
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>    
		<script src="//use.fontawesome.com/b7ea8ae414.js"></script>
		<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
		<script src="//cdn.rawgit.com/noelboss/featherlight/1.5.0/release/featherlight.min.js" type="text/javascript" charset="utf-8"></script>
		<script src="<?=DOMAIN;?>js/subscribe.js" type="text/javascript"></script>
	</body>
</html>