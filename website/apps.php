<!DOCTYPE html>
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<title>OsmAnd - Offline Mobile Maps and Navigation
</title>

 <?php     	
        include 'blocks/default_links.html';
    ?>
<script type="text/javascript" src="scripts/slider.js?v=1"></script>
<script type="text/javascript" src="scripts/mapselector.js"></script>
<script type="text/javascript" src="scripts/poll.js"></script>
<script type="text/javascript" src="scripts/ga-init.js"></script>
<script type="text/javascript" src="scripts/ga-home.js?v=2"></script>
</head>
<body>

<div class="maincontainer">
  <div class="main">
    <div class="header">
	<div class="shadowline"></div>
	 <!-- <img src="images/logo.png" class="headerlogo"/>-->
	 <div class="headerlogo"></div>
	  <div class="headertext">OFFLINE MOBILE<br/> MAPS &amp; NAVIGATION</div>
	  <ul class="badges">
		<li class="first"><a data-gatag="googleplay" href="https://play.google.com/store/apps/details?id=net.osmand.plus">
          <img alt="Get it on Google Play"
          src="https://play.google.com/intl/en_us/badges/images/generic/en-play-badge.png" />
          </a></li>
		  <li><a data-gatag="amazon" href="http://www.amazon.com/gp/product/B00D0SEGMC/ref=mas_pm_OsmAnd-Maps-Navigation">
          <img alt="Get it on Amazon"
          src="images/amazon-apps-store.png" />
		  
          </a></li>
          <li><a data-gatag="ios" class="appstoretopbadge" href="https://itunes.apple.com/app/apple-store/id934850257?pt=2123532&ct=WebSite&mt=8"><img src="images/app-store-badge.png"/></a></li> 
	  </ul>
	  <ul class="menu">
	  <!-- 	<nav class="menu"> -->
	  <li class="activeitem"><a data-gatag="header_home" href="http://www.osmand.net">HOME</a></li>	  
	  <li><a data-gatag="header_features" href="http://osmand.net/features">FEATURES</a></li>		
	  <li><a data-gatag="header_blog" href="http://osmand.net/blog" >BLOG</a></li>
	  <li><a data-gatag="header_help" href="http://osmand.net/help-online">HELP</a></li>		
	  <li><a data-gatag="header_dvr" href="http://dvr.osmand.net">DVR</a></li>
	  </ul>
     </div>
    </div>

  	<?php 
  		include 'blocks/footer.html';
  	?>

  </div>
</div>

<script type="text/javascript">
var sl;
var mapsel;
var timeout = 50;

$( document ).ready(function() {
 sl = new slider($(".slider"));
 mapsel = new mapselector($(".mapcontainer"));

 $(".specialevent").height($(".specialeventcontent").height() - 60);
 $(window).on('resize', function(){
    $(".specialevent").height($(".specialeventcontent").height()- 60);
 });

 
 setTimeout(applyPolStyles, timeout);

});
 
</script>
</body>

</html>
