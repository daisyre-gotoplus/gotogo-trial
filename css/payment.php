<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1"/>
<style>
.grid-container{
max-width:inherit!important;
}
.poweredby{
color: #e7e7e7;
margin-bottom: 5px;
opacity: 0.39;
}
.footerlinks{
color:#c6c6c6;
}
.footerlinks a {
color:#c6c6c6;
}
.footerlinks a:hover{
color:#fff;
}
.greybg{
background: #333333;
font-size: 10px;
padding-bottom: 20px;
padding-top: 10px;
line-height:11px!important;
}
.whitebg{
	background: #fff;
}
.cardsecurity{
	padding-left: 0px;
}
.trustwave{
padding-left: 5px; padding-right: 0;
padding-bottom: 30px;
padding-top: 20px;
}
.trustwave a{
color: #333;
cursor: pointer;
font-size: 10px;
text-decoration: underline;
}
.cardsecuritylabel{
	line-height: 14px; text-align: center; padding-right: 0px; font-size: 11px; padding-top: 25px;color:#555555;
}
@media only screen and (min-device-width: 801px) and (max-device-width: 1920px) {
	.trustwave{
	border-left: 1px solid #ccc;
	padding-bottom: 30px;
	padding-top: 20px;
	}
	.modeofpayment{
	padding-bottom: 30px;
	padding-top: 20px;
	}
	.cardsecurity{
	padding-bottom: 30px;
	padding-top: 20px;
	}
}

.modeofpaymentlabel{
line-height: 14px; text-align: center; padding-right: 0px; font-size: 11px; padding-top: 25px;color:#555555;
}
@media only screen and (min-device-width: 1025px) {
	.modeofpaymentlabel{
	text-align:center!important;
	}

	.cardsecuritylabel{
	text-align:center!important;
	}
}

@media only screen and (min-device-width: 1024px) and (max-device-width: 1024px){
.trustwave{
border-left: none!important;
padding-bottom: 30px;
padding-top: 20px;
}

.modeofpayment{
padding-bottom: 0px;
padding-top: 0px;
}

.cardsecurity{
padding-bottom: 0px;
padding-top: 0px;
}

}
@media only screen and (min-device-width: 900px) and (max-device-width: 900px){
	.modeofpayment{
	padding-bottom: 0px;
	padding-top: 0px;
	}
	.cardsecurity{
	padding-bottom: 0px;
	padding-top: 0px;
	}
}
.mobile-grid-100{
	text-align:center;
}
.centralized-footer-wrapin, 
.greybg-wrapin{
	max-width:980px;
	margin:auto;
}
.centralized-footer-wrapall{
	border-top: 3px solid #ffcc00;line-height:11px!important;text-align:center;
}
 .flinks{ 
 	text-transform: uppercase; 
 } 
 .flinks:after{ 
 	content:" | "; 
 } 
 .flinks:last-child:after{ 
 	content: none; 
 } 

.centralized-footer-wrapall img{
	max-width: 100%;
}
 </style>
<div class="grid-container centralized-footer-wrapall">
	<div class="whitebg">
		<div class="centralized-footer-wrapin">
			<div class="grid-10 mobile-grid-100 modeofpaymentlabel">PAYMENTS ACCEPTED:</div>
			<div class="grid-25 modeofpayment">		
				<img style="padding-top:10px" alt="Mode of payment" src="http://assets.subicom.com/centralized_footer/modeofpayment.png">
			</div>
			<div class="grid-10 mobile-grid-100 cardsecuritylabel">PAYMENTS SECURED BY:</div>
			<div class="grid-20 mobile-grid-100 cardsecurity">
				<img style="padding-top:10px" alt="Card Security" onclick="window.open('https://sealserver.trustwave.com/cert.php?customerId=ffa9235228b748d78384e95a71b163bf&size=65x36&style=invert', 'newwindow', 'scrollbars=1,width=600, height=450'); return false;" style = "cursor:pointer;" src="http://assets.subicom.com/centralized_footer/cardsecurity.png" >
			</div>

			<div class="grid-35 mobile-grid-100 trustwave">
				<span onclick="window.open('http://www.gotodo.com/security/security.php', 'newwindow', 'scrollbars=1,width=800, height=500'); return false;" style = "cursor:pointer;"><img style="vertical-align: middle;" alt="Trustwave" src="http://assets.subicom.com/centralized_footer/trustwave.png"></span>
				<i class="fa fa-info-circle" style = "color:#f7bd06;"></i>
				<a onclick="window.open('http://www.gotodo.com/security/security.php', 'newwindow', 'scrollbars=1,width=800, height=500'); return false;">Learn more on how we protect your payment></a>
			</div>
		</div>
		<div class="clear-unsemantic"></div>
	</div> 
	
	<div class="greybg">
		<div class="greybg-wrapin">
			<div class="grid-100 mobile-grid-100">
			<div class = "poweredby">Powered by: <a style="color:#e7e7e7;" href="http://www.gotoplus.com/">GOTO PLUS</a></div>
			<div class = "footerlinks">

	
				<?php foreach ($flks as $flinkname => $flinkhref){ 
					echo "<a class='flinks flinksclass$flinkname' href='$flinkhref'>$flinkname</a>"; 
					}   ?>	
			</div>
			</div>
		</div>
	</div>
</div>

