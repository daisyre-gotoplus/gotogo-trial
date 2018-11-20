<?php if($_SESSION['is_logged'] && trim($_SESSION['si_using']) == "google"){ ?>
<script src="//apis.google.com/js/platform.js?onload=renderButton" async defer></script>
<script>
	function onSignIn(googleUser){
		var id_token = googleUser.getAuthResponse().id_token;
		var profile = googleUser.getBasicProfile();
	}
	function signOut(){
		var auth2 = gapi.auth2.getAuthInstance();
		auth2.signOut().then(function(){
			window.location = "signout.php";
		});
	}
</script>
<?php } ?>
<div class="container">
	<div class="row">
		<nav class="navbar">
			<div class="container">
				<div class="logo">
					<a href="<?=DOMAIN;?>" style="padding-top: 14px;"><img src="<?=DOMAIN;?>images/gotogo-logo-2.png"></a>
				</div>
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar top-bar"></span>
						<span class="icon-bar middle-bar"></span>
						<span class="icon-bar bottom-bar"></span>
					</button>
				</div>
				<div id="navbar" class="navbar-collapse collapse">
					<ul class="nav navbar-nav navbar-right">
						<?php if($_SESSION['is_logged']){ ?>
						<li class="nav-item nav-item-cta last mainmenulast"><a class="btn btn-cta btn-cta-secondary" id="sign-in" href=""><?=$_SESSION['first_name']." ".$_SESSION['last_name'];?></a></li>
						<li class="nav-item nav-item-cta mainmenulast">
							<?php if(trim($_SESSION['si_using']) == "google"){ ?>
							<div class="g-signin2" style="display:none;" data-onsuccess="onSignIn" data-theme="dark" data-longtitle="true"></div>
							<a class="btn btn-cta btn-cta-secondary" onclick="signOut()" style="text-transform:none;"><i class="fa fa-sign-out"></i>&nbsp;Sign Out</a>
							<?php }else{ ?>
							<a class="btn btn-cta btn-cta-secondary" href="<?=DOMAIN;?>signout.php" style="text-transform:none;"><i class="fa fa-sign-out"></i>&nbsp;Sign Out</a>
							<?php } ?>
						</li>
						<?php }else{ ?>
						<li class="nav-item nav-item-cta mainmenulast"><a class="btn btn-cta btn-cta-secondary" href="<?=DOMAIN;?>signup.php" style="text-transform:none;"><i class="fa fa-pencil-square-o"></i>&nbsp;Sign Up</a></li>
						<li class="nav-item nav-item-cta last mainmenulast"><a class="btn btn-cta btn-cta-secondary" id="sign-in" href="<?=DOMAIN;?>signin.php" style="text-transform:none;"><i class="fa fa-user"></i>&nbsp;Sign In</a></li>
						<?php } ?>
						<!-- WITH MODAL
						<li class="nav-item nav-item-cta"><a class="btn btn-cta btn-cta-secondary" id="sign-in" href="#" data-toggle="modal" data-target="#login-modal"><i class="fa fa-pencil-square-o"></i>&nbsp;Sign Up</a></li>
						<li class="nav-item nav-item-cta last mainmenulast"><a class="btn btn-cta btn-cta-secondary" id="sign-in" href="#" data-toggle="modal" data-target="#login-modal"><i class="fa fa-user"></i>&nbsp;Sign In</a></li> 
						-->
					</ul>
					<!-- <ul class="nav navbar-nav navbar-right">
						<li class="active">
							<a class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="0" data-close-others="false" href="#">Menu&nbsp;<i class="fa fa-angle-down"></i></a>
							<ul class="dropdown-menu">
								<li><a href="destinations.php">Destinations Page Sample</a></li>
								<li><a href="search.php">Search Results Page Sample</a></li>
								<li><a href="hotel-profile.php">Hotel Profiles Page Sample</a></li>
							</ul>  
						</li>
						<li class="nav-item dropdown mainmenu">
							<a class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="0" data-close-others="false" href="#">USD&nbsp;<i class="fa fa-angle-down"></i></a>
							<ul class="dropdown-menu">
								<li class="choices"><a href="#">Destinations Page Sample</a></li>
								<li class="choices"><a href="#">Search Results Page Sample</a></li>
								<li class="choices"><a href="#">Hotel Profiles Page Sample</a></li>
							</ul>                            
						</li>
						<li class="nav-item nav-item-cta last mainmenulast"><a class="btn btn-cta btn-cta-secondary" id="sign-in" href="#" data-toggle="modal" data-target="#login-modal"><i class="fa fa-user"></i>&nbsp;Sign In</a></li>
					</ul> -->
				</div><!--/.nav-collapse -->
			</div>
		</nav>        
	</div>
</div>