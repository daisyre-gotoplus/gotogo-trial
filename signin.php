<?php
	include_once "scripts/functions.php";
	include_once "scripts/query.php";
	
	if(isset($_POST['btn_si_gotogo']) && $_POST['btn_si_gotogo']!=""){
		include_once "scripts/password-hash.php";
		
		$ma_con = db_connect(MA_DB);
		
		$email_address = addslash($_POST['signin-email']);
		$password = addslash($_POST['signin-password']);
		
		if(trim($email_address)=="" || trim($password)==""){
			$message = "Email address and password are required";
		}
		else{
			$message="";
			$error_occured = true;
			$password_hash = new PasswordHash(8, FALSE);
			
			$row="";
			$row = db_select("SELECT users.id, users.password, member.last_name, member.first_name FROM users INNER JOIN ".MA_DB_PREFIX."member AS member ON users.id=member.user_id WHERE users.email='$email_address' AND users.activated='1' AND member.active='Y' AND member.deleted='0'", $ma_con);
			if($row){
				for($ctr = 0; $ctr < count($row); $ctr++){
					if($password_hash->CheckPassword($password, stripslashes($row[$ctr]['password']))){
						$_SESSION['ma_user_id'] = stripslashes($row[$ctr]['id']);
						$_SESSION['first_name'] = stripslashes($row[$ctr]['first_name']);
						$_SESSION['last_name'] = stripslashes($row[$ctr]['last_name']);
						$_SESSION['email'] = $email_address;
						$_SESSION['token'] = "";
						
						$_SESSION['is_logged'] = true;
						$_SESSION['si_using'] = "gotogo";
						
						$error_occured = false;
					}
				}
			}
			
			if($error_occured){
				$message = "Invalid email address and/or password";
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
		<title>GoToGo | Sign In</title> 
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
		<style>
			/*
				Note: It is best to use a less version of this file ( see http://css2less.cc
				For the media queries use @screen-sm-min instead of 768px.
				For .omb_spanOr use @body-bg instead of white.
			*/
			@media (min-width: 768px) {
				.omb_row-sm-offset-3 div:first-child[class*="col-"] {
					margin-left: 25%;
				}
			}
			.omb_login .omb_authTitle {
				text-align: center;
				line-height: 300%;
			}
			.omb_login .omb_socialButtons a {
				color: white; // In yourUse @body-bg 
				opacity:0.9;
			}
			.omb_login .omb_socialButtons a:hover {
				color: white;
				opacity:1;    	
			}
			.omb_login .omb_socialButtons .omb_btn-facebook {background: #3b5998;}
			.omb_login .omb_socialButtons .omb_btn-twitter {background: #00aced;}
			.omb_login .omb_socialButtons .omb_btn-google {background: #c32f10;}
			.omb_login .omb_loginOr {
				position: relative;
				font-size: 1.5em;
				color: #aaa;
				margin-top: 1em;
				margin-bottom: 1em;
				padding-top: 0.5em;
				padding-bottom: 0.5em;
			}
			.omb_login .omb_loginOr .omb_hrOr {
				background-color: #cdcdcd;
				height: 1px;
				margin-top: 0px !important;
				margin-bottom: 0px !important;
			}
			.omb_login .omb_loginOr .omb_spanOr {
				display: block;
				position: absolute;
				left: 50%;
				top: -0.6em;
				margin-left: -1.5em;
				background-color: white;
				width: 3em;
				text-align: center;
			}
			.omb_login .omb_loginForm .input-group.i {
				width: 2em;
			}
			.omb_login .omb_loginForm  .help-block {
				color: red;
			}
			@media (min-width: 768px) {
				.omb_login .omb_forgotPwd {
					text-align: right;
					margin-top:10px;
				}		
			}
			.btn {
				display: inline-block;
				padding: 6px 12px;
				margin-bottom: 0;
				font-size: 14px;
				font-weight: 400;
				line-height: 1.42857143;
				text-align: center;
				white-space: nowrap;
				vertical-align: middle;
				-ms-touch-action: manipulation;
				touch-action: manipulation;
				cursor: pointer;
				-webkit-user-select: none;
				-moz-user-select: none;
				-ms-user-select: none;
				user-select: none;
				background-image: none;
				border: 1px solid transparent;
				border-radius: 4px;
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
        <!-- ******Signup Section****** --> 
        <section class="signup-section access-section section">
            <div class="container">
                <div class="row">
                    <div class="form-box col-md-8 col-sm-12 col-xs-12 col-md-offset-2 col-sm-offset-0 xs-offset-0">     
                        <div class="form-box-inner">
							<?php if(isset($_POST['btn_si_gotogo']) && $_POST['btn_si_gotogo']!="" && trim($message)!=""){ ?>
							<div class="alert alert-danger" style="padding:15px; font-weight:bold;"><?=$message;?></div>
							<?php } ?>
                            <h2 class="title text-center">Sign In With Us</h2>  
							<!-- <p class="intro text-center">It only takes 3 minutes!</p> -->
                            <div class="row">
                                <div class="social-btns col-md-6 col-sm-12 col-xs-12 col-md-offset-3 col-sm-offset-0 col-sm-offset-0">  
									<!-- <div class="divider"><span>Or</span></div> -->
                                    <ul class="list-unstyled social-login">
                                        <!-- <li><button class="facebook-btn btn" type="button"><i class="fa fa-facebook"></i>Sign in with Facebook</button></li>
                                        <li><button class="twitter-btn btn" type="button"><i class="fa fa-twitter"></i>Sign in with Twitter</button></li>
										<li><button class="github-btn btn" type="button"><i class="fa fa-github-alt"></i>Sign in with Github</button></li>
                                        <li><button class="google-btn btn" type="button"><i class="fa fa-google-plus"></i>Sign in with Google</button></li> -->
										<li>
											<div id="siwfb" style="cursor:pointer;">
												<div style="float:left; padding-top:2px; border:1px solid #354c8c; background-color:#ffffff; font-size:25px;">
													<i class="fa fa-facebook" style="padding:0px 10px; color:#354c8c;"></i>
												</div>
												<div style="padding:10px 0px; background-color:#354c8c; color:#ffffff; font-family:Arial; font-size:14px;">
													Sign in with Facebook
												</div>
											</div>
										</li>
										<li>
											<div class="g-signin2" data-width="190" data-onsuccess="onSignIn" data-theme="dark" data-longtitle="true"></div>
										</li>
                                    </ul>
                                    <p class="note">Don't worry, we won't post anything without your permission.</p>
                                    <div class="form-container">
										<div class="divider"><span>Or</span></div>         
                                        <form method="post" action="" name="form_si_gotogo" class="signup-form">
                                            <div class="form-group email">
												<label class="sr-only" for="signup-email">Your email</label>
												<input name="signin-email" type="email" class="form-control login-email" placeholder="Your email"/>
                                            </div>
                                            <div class="form-group password">
                                                <label class="sr-only" for="signup-password">Your password</label>
                                                <input name="signin-password" type="password" class="form-control login-password" placeholder="Password"/>
                                            </div>
                                            <input type="submit" name="btn_si_gotogo" class="btn btn-block btn-cta-primary" value="Sign In"/>
											<!-- <p class="note">By signing up, you agree to our terms of services and privacy policy.</p> -->
                                            <p class="lead">New to Gotogo? <a class="login-link" id="login-link" href="<?=DOMAIN;?>signup.php">Sign Up</a></p>  
                                        </form>
                                    </div>
                                </div>
							</div>
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
		<script src="//apis.google.com/js/platform.js?onload=renderButton" async defer></script>
		<script src="<?=DOMAIN;?>js/subscribe.js" type="text/javascript"></script>
		<script>
			$("#siwfb").click(function(){
				fb_login();
			});
			
			window.fbAsyncInit = function(){
				FB.init({
					appId	: '1205013172900173',
					cookie	: true,  // enable cookies to allow the server to access the session
					xfbml	: true,  // parse social plugins on this page
					version	: 'v2.8' // use graph api version 2.8
				});
				
				FB.getLoginStatus(function(response){
					if(response.status === 'connected'){
						// Logged into your app and Facebook.
						//document.getElementById('status').innerHTML = 'Connected.';
					}
					else if(response.status === 'not_authorized'){
						// The person is logged into Facebook, but not your app.
					}
					else{
						// The person is not logged into Facebook, so we're not sure if they are logged into this app or not.
					}
				});
			};
			
			// Load the SDK asynchronously
			(function(d, s, id){
				var js, fjs = d.getElementsByTagName(s)[0];
				if(d.getElementById(id)) return;
				js = d.createElement(s);
				js.id = id;
				js.src = "//connect.facebook.net/en_US/sdk.js";
				fjs.parentNode.insertBefore(js, fjs);
			}(document, 'script', 'facebook-jssdk'));
			
			function fb_login(){
				FB.login(function(response){
					if(response.authResponse){
						var access_token = response.authResponse.accessToken; //get access token
						var user_id = response.authResponse.userID; //get FB UID
						
						FB.api('/me', 'GET', {fields: 'first_name, last_name, email'}, function(response){
							var post_string = "token="+access_token+"&uid="+user_id+"&fname="+response.first_name+"&lname="+response.last_name+"&email="+response.email+"&siusing=facebook";
							
							var xhr = new XMLHttpRequest();
							xhr.open("POST", "scripts/si-validation.php");
							xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
							xhr.onload = function(){
								if(xhr.responseText == "passed"){
									window.location = location.href;
								}
							};
							xhr.send(post_string);
						});
					}
					else{
						//user hit cancel button
						//console.log('User cancelled login or did not fully authorize.');
					}
				},{
					scope: 'public_profile,email'
				});
			}
			
			function onSignIn(googleUser){
				var id_token = googleUser.getAuthResponse().id_token;
				var profile = googleUser.getBasicProfile();
				
				//console.log('Image URL: '+profile.getImageUrl());
				var post_string = "token="+id_token+"&uid="+profile.getId()+"&fname="+profile.getGivenName()+"&lname="+profile.getFamilyName()+"&email="+profile.getEmail()+"&siusing=google";
				
				var xhr = new XMLHttpRequest();
				xhr.open("POST", "scripts/si-validation.php");
				xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
				xhr.onload = function(){
					if(xhr.responseText == "passed"){
						window.location = location.href;
					}
				};
				xhr.send(post_string);
			}
			function signOut(){
				var auth2 = gapi.auth2.getAuthInstance();
				auth2.signOut().then(function(){
					//console.log('User signed out.');
				});
			}
		</script>
	</body>
</html>