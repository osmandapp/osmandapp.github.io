<?php
	if (empty($_GET['id'])) {
		$_GET['id'] ="main";
	}	
?>		    	
<!DOCTYPE html>
<html>

<head>
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<title>OsmAnd - Offline Mobile Maps and Navigation
</title>

 <?php include 'blocks/default_links.html';  ?>

<!-- for google+-->
 <link rel="canonical"	<?php	echo 'href="http://osmand.net'.$_SERVER['REQUEST_URI'].'"'  ?> />
<script src="https://apis.google.com/js/platform.js" async defer>
</script>

</head>
<body>

<!-- for FB-->
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.3";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<div class="maincontainer">
  <div class="main">
    <?php 
    	$simpleheader_header = "FEATURES";
        include 'blocks/simple_header.php';
    ?>
	<div class="articles">
	  <div class="articlescontainer">
	  
	   <?php if ($_GET['id'] != 'main') { ?>
		    <div class="article">
		    <?php echo file_get_contents("feature_articles/".$_GET['id'].".html"); ?>
		    </div>
			
			<div class="acticlestitles">
		  	<h1>FEATURES</h1>
		  	<div class="delimiter"></div>
		  	<ul class="articlelinklist">
		  		<li><a data-gatag='start' href="http://osmand.net/features?id=start">Begin with OsmAnd</a></li>
		  		<li><a data-gatag='navigation' href="http://osmand.net/features?id=navigation">Navigation</a></li>
		  		<li><a data-gatag='map-viewing' href="http://osmand.net/features?id=map-viewing">Map Viewing</a></li>
		  		<li><a data-gatag='search-on-map' href="http://osmand.net/features?id=find-something-on-map">Search on the map</a></li>
				<li><a data-gatag='trip-planning' href="http://osmand.net/features?id=trip-planning">Planning trip</a></li>
				<li><a data-gatag='troubleshooting' href="http://osmand.net/features?id=installation-and-troubleshooting">Installation &amp; troubleshoooting</a></li>
		  		
		  	</ul>
		  	<h1>PLUGINS</h1>
		  	<div class="delimiter"></div>
		  	<ul class="articlelinklist">
		  		<li><a data-gatag='online-maps-plugin' href="http://osmand.net/features?id=online-maps-plugin">Online maps</a></li>
		  		<li><a data-gatag='contour-lines-plugin' href="http://osmand.net/features?id=contour-lines-plugin" >Contour lines and Hillshade map</a></li>
		  		<li><a data-gatag='trip-recording-plugin' href="http://osmand.net/features?id=trip-recording-plugin" >Trip recording</a></li>
		  		<li><a data-gatag='ski-plugin' href="http://osmand.net/features?id=ski-plugin" >Ski maps</a></li>
		  		<li><a data-gatag='nautical_charts' href="http://osmand.net/features?id=nautical-charts" >Nautical charts</a></li>
		  		<li><a data-gatag='audio-video-notes-plugin' href="http://osmand.net/features?id=audio-video-notes-plugin" >Audio/video notes</a></li>
		  		<li><a data-gatag='osm-editing-plugin' href="http://osmand.net/features?id=osm-editing-plugin">OSM editing</a></li>
		  		<li><a data-gatag='distance-calculator-and-planning-tool' href="http://osmand.net/features?id=distance-calculator-and-planning-tool">Distance calculator and planning tool</a></li>
		  		<li><a data-gatag='parking-plugin' href="http://osmand.net/features?id=parking-plugin" >Parking place</a></li>
		  	</ul>
			</div>
		
		<?php } else { 
		        echo file_get_contents("feature_articles/".$_GET['id'].".html"); 
		  } ?>
	  </div>
	</div>
	 <?php include 'blocks/footer.html';	?>

  </div>
</div>

<!-- for twitter-->
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script></div>
</body>

</html>
