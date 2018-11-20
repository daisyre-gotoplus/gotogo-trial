<?php 
	include_once "scripts/functions.php";
	
    $contact_message=$name=$visitor_email=$user_message="";
	
    $your_email = "contact@gotogo.com"; // <<=== update to your email address
	$success = false;

    if(isset($_POST['submit'])){
        $name = $_POST['name'];
        $visitor_email = $_POST['email'];
        $user_message = $_POST['message'];
        
        ///------------Do Validations-------------
        if(empty($name) || empty($visitor_email) || empty($user_message)){
            $contact_message .= "Fields with * are required";
        }
		
        if(IsInjected($visitor_email)){
			$contact_message .= (!empty($contact_message)) ? "<br/>" : "";
            $contact_message .= "Invalid email address";
        }
		
        if(empty($_SESSION['6_letters_code'] ) || strcasecmp($_SESSION['6_letters_code'], $_POST['6_letters_code']) != 0){
            //Note: the captcha code is compared case insensitively. If you want case sensitive match, update the check above to strcmp()
			
			$contact_message .= (!empty($contact_message)) ? "<br/>" : "";
            $contact_message .= "The captcha code does not match";
        }
		
        if(empty($contact_message)){
            $to = $your_email;
            $subject = "GoToGo | Contact Us";
            $from = $name;
            $ip = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : "";

            $body = "Message Content:\n\n".
					"Name: $name\n".
					"Email: $visitor_email \n".
					"Message: \n ".
					"$user_message\n".
					"IP: $ip\n".
					"Url: http".(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on" ? "s" : "")."://".$_SERVER['SERVER_NAME'].$_SERVER['PHP_SELF'];    
			
			$headers  = "MIME-Version: 1.0"."\r\n";
			$headers .= "Content-type: text/plain; charset=utf-8"."\r\n";
			$headers .= "From: $from <$visitor_email>"."\r\n";
            $headers .= "Reply-To: $visitor_email"."\r\n";

            mail($to, $subject, $body, $headers);
			
			$name=$visitor_email=$user_message="";
			
            $contact_message = "<strong>Success!</strong> Thank you for your message. We will be in touch with you very soon.";
			$success = true;
        }
    }

    // Function to validate against any email injection attempts
    function IsInjected($str){
        $injections = array('(\n+)', '(\r+)', '(\t+)', '(%0A+)', '(%0D+)', '(%08+)', '(%09+)');
        
        $inject = join('|', $injections);
        $inject = "/$inject/i";
        
        if(preg_match($inject,$str)){
            return true;
        }
        else{
            return false;
        }
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
		<title>GoToGo | Contact Us</title> 
		<!-- Bootstrap Latest compiled and minified CSS -->
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous" />
		<!-- Font Awesome -->
		<!-- <link rel = "stylesheet" href="css/font-awesome/css/font-awesome.min.css" -->
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
			.txt-design {
				padding: 15px 16px;
				border: 1px solid #ccc;
				width: 100%;
				height: 50px;
				display: block;
				border-radius: 4px;
				font-size: 15px;
				color: #aaa;
				font-family: 'Open Sans', sans-serif;
				margin: 0 0 15px 0;
				transition: all 0.3s ease-in-out;
				-moz-transition: all 0.3s ease-in-out;
				-webkit-transition: all 0.3s ease-in-out;
			}
			.contactus-contact i{
				margin-right:10px;
			}
			.contactus-contact h3{
				float:left;
				margin: 0 0 5px 0;
				margin-right: 12px;
				font-size:15px;
				line-height: 28px;
				width:102px;
			}
			.contactus-contact span{
				line-height: 28px;
				display: block;
				overflow: hidden;
				font-family: 'Open Sans', sans-serif;
			}
			.social-link {
				padding: 35px 0;
				margin: 0 0 0 68px;
				display: block;
				overflow: hidden;
				list-style: none;
			}
			.social-link li {
				float: left;
				margin-right: 8px;
			}
			.social-link li a:hover, .social-link li a:focus {
				text-decoration: none;
			}
			.twitter a:hover {
				background: #55acee;
			}
			.facebook a:hover {
				background: #3b5998;
			}
			.gplus a:hover {
				background: #dd4b39;
			}
			.linkedin a:hover {
				background: #0077b5;
			}
			.instagram a:hover {
				background: #f09433;                                   
			   /* background: -moz-linear-gradient(45deg, #f09433 0%, #e6683c 25%, #dc2743 50%, #cc2366 75%, #bc1888 100%);
				background: -webkit-linear-gradient(45deg, #f09433 0%,#e6683c 25%,#dc2743 50%,#cc2366 75%,#bc1888 100%);
				background: linear-gradient(45deg, #f09433 0%,#e6683c 25%,#dc2743 50%,#cc2366 75%,#bc1888 100%);*/
				/*filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#f09433', endColorstr='#bc1888',GradientType=1 );*/
				/*color: #fff;*/
			   /* transition: .3s ease-in;
				-webkit-transition: .3s ease-in;
				-moz-transition: .3s ease-in;*/
			}
			.social-link li a {
				display: block;
				width: 50px;
				height: 50px;
				text-align: center;
				line-height: 50px;
				font-size: 25px;
				color: #fff;
				background: #222222;
				border-radius: 50%;
				transition: all 0.3s ease-in-out;
			}
			.social-link li i{
				margin-right:0;
			}
			.inpt-btn {
				width: 175px;
				height: 50px;
				background: #7cc576;
				border-radius: 4px;
				color: #ffffff;
				font-size: 14px;
				text-transform: uppercase;
				font-family: 'Montserrat', sans-serif;
				font-weight: 400;
				border: 0px;
				transition: all 0.3s ease-in-out;
				-moz-transition: all 0.3s ease-in-out;
				-webkit-transition: all 0.3s ease-in-out;
			}
			.header-wrapper{
				position:relative;
				background:#333333 url('images/Banners/contact.jpg') no-repeat center center;
				-webkit-background-size: cover;
				-moz-background-size: cover;
				-o-background-size: cover;
				background-size: cover;
				padding-top: 76px;
			}
			#contact-wrapper{
				margin-top: 50px;
				margin-bottom: 50px;
			}
		</style>
	</head>
	<body>
		<!-- Google Tag Manager (noscript) -->
		<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-T82TQSK"
		height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
		<!-- End Google Tag Manager (noscript) -->

		<div class="header-wrapper">
			<section id="navigation-wrapperBlue">
				<?php include_once "ssi/navbar-blue.php";?>
			</section>
			<section id="banner-wrapper"></section>
		</div>
		<section id="contact-wrapper" class="main-section contact" id="contact">
			<div class="container">
				<div class="row">
					<div id="msg_container"></div>
					<?php if(!empty($contact_message)){ ?>
					<div class="alert alert-<?=($success) ? "success" : "danger";?>" style="padding:15px; font-weight:bold; text-align:left; margin:5px 0 0 0;"><?=$contact_message;?></div>
					<?php } ?>
					<div class="col-md-6">
						<div class="form contactus-form">
							<h2 style="color: #ec6952;">Contact Us</h2>
							<form method="post" name="contact_form" action=""> 
								<p>
									<label for="name">Full Name: * </label><br/>
									<input class="txt-design" type="text" name="name" value="<?=htmlentities($name);?>"/>
								</p>
								<p>
									<label for="email">Email: * </label><br/>
									<input class="txt-design" type="text" name="email" value="<?=htmlentities($visitor_email);?>"/>
								</p>
								<p>
									<label for="message">Message: *</label><br/>
									<textarea class="txt-design" style="height:85px; resize:none;" name="message" rows="8" cols="30"><?=htmlentities($user_message);?></textarea>
								</p>
								<p>
									<img src="captcha_code_file.php?rand=<?=rand();?>" id="captchaimg"/><br/>
									<label for="6_letters_code">Enter the code above here :</label><br/>
									<input class="txt-captcha" id="6_letters_code" name="6_letters_code" type="text"/><br/>
									<small>Can't read the image? click <a href="javascript:refreshCaptcha();">here</a> to refresh</small>
								</p>
								<input type="submit" value="Send Message" name="submit" class="inpt-btn" style="background:#7dbc00;">
							</form>
							<script language="javascript" type="text/javascript">
								function refreshCaptcha(){
									var img = document.images['captchaimg'];
									img.src = img.src.substring(0,img.src.lastIndexOf("?"))+"?rand="+Math.random()*1000;
								}
							</script>
						</div>  
					</div>
					<div class="col-md-6 contactus-contact" style="margin-top:60px;">
						<div class="contact-info-box address clearfix">
							<h3><i class="fa fa-map-marker"></i>Address:</h3>
							<span>2nd Floor, Donghyup Bldg., Lot 18-20 Manila Avenue, Central Business District,<br>Subic Bay Freeport Zone, 2222 Philippines</span>
						</div>
						<div class="contact-info-box phone clearfix" id="contact-b">
							<h3><i class="fa fa-phone" aria-hidden="true"></i>Phone:</h3>
							<span>+63.47.252.9978 <br/>+63.922.8585858 <br/>+63.2.404.4784</span>
						</div>
						<div class="contact-info-box email clearfix">
							<h3><i class="fa fa-envelope"></i>email:</h3>
							<span>contact@gotogo.com</span>
						</div>
						<div class="contact-info-box hours clearfix">
							<h3><i class="fa fa-clock-o"></i>Hours:</h3>
							<span><strong>Monday - Sunday:</strong> 7am - 11pm</span>
						</div>
						<ul class="social-link">
							<li class="facebook"><a href="https://www.facebook.com/gotogodotcom"><i class="fa fa-facebook"></i></a></li>
							<li class="instagram"><a href="https://www.instagram.com/gotogodotcom/"><i class="fa fa-instagram" style="color:#ffffff;"></i></a></li>
							<li class="twitter"><a href="https://twitter.com/gotogodotcom"><i class="fa fa-twitter"></i></a></li>
						</ul>
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
					itemsMobile : false, 
					autoplayHoverPause : true,
					loop : true
				});
			});
			
			<?php if(isset($_POST['submit'])){ ?>
			$("html, body").animate({
				scrollTop:Math.round($("#msg_container").offset().top)
			}, 1000);
			<?php } ?>
		</script>
	</body>
</html>
