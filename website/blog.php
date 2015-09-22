<?php
	if (empty($_GET['id'])) {
		$_GET['id'] ="osmand-ios-1.2.2-released";
	}	
?>		    	
<!DOCTYPE html>
<html>

<head>
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta property="og:url"        <?php	echo 'content="http://osmand.net'.$_SERVER['REQUEST_URI'].'"'  ?>	/> 
<meta property="og:type"          content="website" />
<meta property="og:title"         content="OsmAnd - Offline Mobile Maps and Navigation" />
<meta property="og:description"   content="" />
<meta property="og:image"         content="http://osmand.net/images/logo-grey.png" />
	
<title>OsmAnd - Offline Mobile Maps and Navigation</title>

 <?php include 'blocks/default_links.html'; ?>

<!-- for google+-->
<link rel="canonical" <?php	echo 'href="http://osmand.net'.$_SERVER['REQUEST_URI'].'"'  ?>	/>
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
  
  	  <?php
        if ($_GET['id'] != '5_years') {
        	$simpleheader_header = "BLOG";
        	include 'blocks/simple_header.php';
        } else {
?>
             <iframe src="http://cdn.knightlab.com/libs/timeline/latest/embed/index.html?source=13SophOj2oI_AO1lb9aAOWrZiZiW1saaPgseZdijtuEE&font=Bevan-PotanoSans&maptype=toner&lang=en&start_at_slide=1&height=450" style="width:100%;height:450px">
             	</iframe>
<?php   } ?>

	<div class="articles">
	  <div class="articlescontainer">
	    
		<div class="article">
		    <?php echo file_get_contents("blog_articles/".$_GET['id'].".html"); ?>			
		</div>		
		
		<div class="acticlestitles">		
		  <h1>LATEST ARTICLES</h1>
		  <div class="delimiter"></div>
		  <ul class="articlelinklist">
		  	<li><a data-gatag='osmand-ios-1.2.2-released' href="http://osmand.net/blog?id=osmand-ios-1.2.2-released" >OsmAnd 1.2.2 (iOS)</a></li>
		  	<li><a data-gatag='osmand-ios-1.1.1-released' href="http://osmand.net/blog?id=osmand-ios-1.1.1-released" >OsmAnd 1.1.1 (iOS)</a></li>
		  	<li><a data-gatag='osmand-5-years' href="http://osmand.net/blog?id=5_years" >5 years!</a></li>
		  	<li><a data-gatag='osmand-2-1-released' href="http://osmand.net/blog?id=osmand-2-1-released" >OsmAnd 2.1</a></li>
		  	<li><a data-gatag='osmand_ios_1_0_2' href="http://osmand.net/blog?id=osmand-ios-1.0.2" >OsmAnd 1.0.2 (iOS)</a></li>
		  	<li><a data-gatag='osmand_2_0' href="http://osmand.net/blog?id=osmand-2-0-released" >OsmAnd 2.0</a></li>
		  	<li><a data-gatag='osmand_ios' href="http://osmand.net/blog?id=osmand-ios" >OsmAnd for iPhone is released</a></li>
			<li><a data-gatag='nautical_charts' href="http://osmand.net/blog?id=nautical-charts" >Nautical charts</a></li>
			<li><a data-gatag='osmand_dvr_goes_live' href="http://osmand.net/blog?id=osmand-dvr-goes-live">OsmAnd DVR goes live</a></li>
			<li><a data-gatag='osmand_1_9' href="http://osmand.net/blog?id=osmand-1-9-released" >OsmAnd 1.9</a></li>
			<li><a data-gatag='osmand_1_8' href="http://osmand.net/blog?id=osmand-1-8-released" >OsmAnd 1.8</a></li>
			<li><a data-gatag='osmand_1_7' href="http://osmand.net/blog?id=osmand-1-7-released" >OsmAnd 1.7</a></li>
			<li><a data-gatag='osmand_1_6' href="http://osmand.net/blog?id=osmand-1-6-released" >OsmAnd 1.6</a></li>
			<li><a data-gatag='osmand_1_5' href="http://osmand.net/blog?id=osmand-1-5-released" >OsmAnd 1.5</a></li>

			<li><a data-gatag='osmand_rss' href="http://osmand.net/rss.xml" >RSS</a></li>
		  </ul>
		</div>
		<div class="clear"> </div>
		
		<div class="share_buttons">			  
		       <div class="social_network_button fb">
		       	  <div class="fb-like" <?php	echo 'data-href="http://osmand.net'.$_SERVER['REQUEST_URI'].'"'  ?>
					data-width="75" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false">
		          </div>
			   </div>
			   <div  class="social_network_button twitter">
			      <a href="https://twitter.com/share" class="twitter-share-button" <?php	echo 'data-url="http://osmand.net'.$_SERVER['REQUEST_URI'].'" data-count-url="http://osmand.net'.$_SERVER['REQUEST_URI'].'.html"'  ?> >Tweet</a>
				</div>

			   <div  class="social_network_button gplus"><div class="g-plusone" data-size="medium"></div></div>
			   <div class="clear"></div>
		 </div>
	  </div>
	</div>
	<?php 
  		include 'blocks/footer.html';
  	?>
  </div>
</div>

<!-- for twitter-->
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script></div>
</body>

</html>
