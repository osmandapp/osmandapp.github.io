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
</head>
<body>

<div class="maincontainer">
  <div class="main">
    <div class="header">
	<div class="header-map"></div>
	<div class="shadowline">
	 <div class="menu-wrapper">
      <a href="/" class="headerlogo-link"><div class="headerlogo"></div></a>
	  </div>
	</div>	 
	<div class="header-caption">
	  <div class="headertext">OFFLINE MOBILE<br/> MAPS &amp; NAVIGATION</div>	  
	  <div class="badges">
		   <a data-gatag="googleplay" href="https://play.google.com/store/apps/details?id=net.osmand&amp;referrer=utm_source%3Dwebsite%26utm_medium%3Dtop"><img alt="Get it on Google Play" src="images/en-play-badge.png" /></a>
          <a data-gatag="amazon" href="http://www.amazon.com/gp/product/B00D0SEGMC/ref=mas_pm_OsmAnd-Maps-Navigation"><img alt="Get it on Amazon" src="images/amazon-apps-store.png" /></a>
          <a data-gatag="ios" class="appstoretopbadge" href="https://itunes.apple.com/app/apple-store/id934850257?pt=2123532&amp;ct=WebSite&amp;mt=8"><img src="images/app-store-badge.png"/></a>	 
	  </div>
     </div>
    </div>
  </div>
  	<?php 
  		include 'blocks/footer.html';
  	?>


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
