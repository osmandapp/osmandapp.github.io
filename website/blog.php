<?php
				if (empty($_GET['id'])) {
					$_GET['id'] ="osmand-ios";
		    	}	
		    	?>
<!DOCTYPE html>
<html>

<head>
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<title>OsmAnd - Offline Mobile Maps and Navigation
</title>

<link rel="stylesheet" type="text/css" href="site.css"/>
<script type="text/javascript" src="scripts/jquery-1.11.1.min.js"></script>

<!-- for google+-->
 <link rel="canonical"
 	<?php	echo 'href="http://osmand.net/blog?id='.$_GET['id'].'.html"'  ?>
 	/>
<script src="https://apis.google.com/js/platform.js" async defer>
</script>

<script type="text/javascript" src="scripts/ga-init.js"></script>
<script type="text/javascript" src="scripts/ga-blog.js"></script>
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
    <div class="simpleheader">
	<div class="shadowline"></div>	  
	  <div class="headerlogo"></div>
	  <ul class="menu">
	  <li><a data-gatag="header_home" href="http://www.osmand.net">HOME</a></li>
	  <li class="activeitem"><a data-gatag="header_blog" href="http://osmand.net/blog">BLOG</a></li>
	  <li><a data-gatag="header_help" href="http://osmand.net/help/">HELP</a></li>		
	  <li><a data-gatag="header_dvr" href="http://dvr.osmand.net">DVR</a></li>	  
	  </ul>
	  <div class="headertext">BLOG</div>
    </div> 
	<div class="articles">
	  <div class="articlescontainer">
	    <ul class="articlelist">
	      <li>
		    <div class="article">
		    <?php
		    	echo file_get_contents("blog_articles/".$_GET['id'].".html");
			?>
			
		    </div>
			<ul class="share_buttons">		       
		       <li class="fb">
		       	<div class="fb-like" 
		       	<?php	echo 'data-href="http://osmand.net/blog?id='.$_GET['id'].'.html"'  ?>
		       	data-width="75" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false">
		       </div></li> 
			   <li><a href="https://twitter.com/share" class="twitter-share-button" 
			   			<?php	echo 'data-url="http://osmand.net/blog?id='.$_GET['id'].'.html"'  ?>
			   	>Tweet</a></li>

			   <li><div class="g-plusone" data-size="medium"></div></li>
			</ul>
		  </li>
		  
	    </ul>
		<div class="acticlestitles">
		  <h1>LATEST ARTICLES</h1>
		  <div class="delimiter"></div>
		  <ul class="articlelinklist">
		  	<li><a data-gatag='osmand_ios' href="http://osmand.net/blog?id=osmand-ios" >OsmAnd for iPhone is released</a></li>
			<li><a data-gatag='nautical_charts' href="http://osmand.net/blog?id=nautical-charts" >Nautical charts</a></li>
			<li><a data-gatag='osmand_dvr_goes_live' href="http://osmand.net/blog?id=osmand-dvr-goes-live">OsmAnd DVR goes live</a></li>
			<li><a data-gatag='osmand_1_9' href="http://osmand.net/blog?id=osmand-1-9-released" >OsmAnd 1.9</a></li>
			<li><a data-gatag='osmand_1_8' href="http://osmand.net/blog?id=osmand-1-8-released" >OsmAnd 1.8</a></li>
			<li><a data-gatag='osmand_1_7' href="http://osmand.net/blog?id=osmand-1-7-released" >OsmAnd 1.7</a></li>
			<li><a data-gatag='osmand_1_6' href="http://osmand.net/blog?id=osmand-1-6-released" >OsmAnd 1.6</a></li>
			<li><a data-gatag='osmand_1_5' href="http://osmand.net/blog?id=osmand-1-5-released" >OsmAnd 1.5</a></li>
		  </ul>
		</div>
	  </div>
	</div>
	<div class="footer">
	  <div class="halvecolumn">
	    <img src="images/logo.png" class="footerlogo"/>	
		<div>&nbsp;</div>
	  </div>
	  <div class="halvecolumn">
	     <div class="narrow">
		  
		    <ul>
		    <div class="footerlinkstitle">WEBSITE</div>
		    <li><a data-gatag="home" href="http://www.osmand.net">Home</a></li>			
			<li><a data-gatag="blog" href="http://osmand.net/blog">Blog</a></li>							
			<li><a data-gatag="help" href="http://osmand.net/help/">Help</a></li>							
			<li><a data-gatag="dvr" href="http://dvr.osmand.net">DVR</a></li>					
		    </ul>
	    </div>
	    
	    <div class="wide">
	    
		  <ul>
		  <div class="footerlinkstitle">VERSIONS</div>  
		    <li><a data-gatag="releases" href="http://download.osmand.net/releases/">OsmAnd Releases</a></li>
			<li><a data-gatag="map_creator" href="http://download.osmand.net/latest-night-build/OsmAndMapCreator-main.zip">OsmAnd Map Creator</a></li>
			<li><a data-gatag="nightly_build" href="http://download.osmand.net/latest-night-build/OsmAnd-default.apk">OsmAnd Nightly Build
			</a></li>
		  </ul>
	    </div>
	    <div class="wide">
		 <ul>
		    <div class="footerlinkstitle">EXTERNAL LINKS</div>
		 	<li><a data-gatag="osm" href="http://www.openstreetmap.org/">Open Street Map</a></li>
		    <li><a data-gatag="source_code" href="https://github.com/osmandapp/Osmand">Source code (github)</a></li>
			<li><a data-gatag="google_groups" href="https://groups.google.com/forum/#!forum/osmand">Google groups (forum)</a></li>			
			<li><a data-gatag="osmand_cz" href="https://osmand.cz/">OsmAnd CZ Manuals</a></li>
		  </ul>
	    </div>
	  </div>
	</div>
  </div>
</div>

<!-- for twitter-->
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script></div>
</body>

</html>