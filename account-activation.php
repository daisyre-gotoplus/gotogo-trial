<?php
	include_once "scripts/functions.php";
	include_once "scripts/query.php";
	
	$ma_con = db_connect(MA_DB);
	
	$activation_key = htmlentities($_GET['a']);
	
	if(trim($activation_key)!=""){
		$row="";
		$row = db_select("SELECT id FROM users WHERE CONCAT(MD5(CONCAT(id, email)), '-', SHA1(CONCAT(id, email)))='$activation_key' AND activated='0'", $ma_con);
		if($row){
			$user_id = stripslashes($row[0]['id']);
			
			execute_query("UPDATE ".MA_DB_PREFIX."member SET active='Y' WHERE user_id='$user_id'", $ma_con);
			execute_query("UPDATE users SET activated='1' WHERE id='$user_id'", $ma_con);
		}
		else{
			echo "<h1>HTTP Status - 400</h1>";
			exit();
		}
	}
	else{
		echo "<h1>HTTP Status - 400</h1>";
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
		<link rel="stylesheet" href="<?=DOMAIN;?>css/styles.css" />
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
                        <div class="form-box-inner" style="margin:0px; border:0px; text-align:center">
                        	<div class="alert alert-success" style="padding:15px; font-weight:bold;">
								<i class="fa fa-check" style="font-size:60px;"></i><br/>
								Congratulations! Your account has been successfully activated!<br/>
								Please click <a href="signin.php">here</a> to login.
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
		<script src="<?=DOMAIN;?>js/subscribe.js" type="text/javascript"></script>
	</body>
</html>