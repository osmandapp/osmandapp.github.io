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
          src="https://developer.android.com/images/brand/en_generic_rgb_wo_45.png" />
          </a></li>
		  <li><a data-gatag="amazon" href="http://www.amazon.com/gp/product/B00D0SEGMC/ref=mas_pm_OsmAnd-Maps-Navigation">
          <img alt="Get it on Amazon"
          src="images/amazon-apps-store.png" />
		  
          </a></li>
          <li><a data-gatag="ios" class="appstoretopbadge" href="https://itunes.apple.com/app/apple-store/id934850257?pt=2123532&ct=WebSite&mt=8"><img src="images/app-store-badge.png"/></a></li> 
		   <li class="survey">
		  <span><a class="pd-embed surveylink" id="pd1439392361078" href="http://osmandapp.polldaddy.com/s/tell-us-about-you">Join OsmAnd Survey &#8594;</a></span>
<script type="text/javascript">
var _polldaddy = [] || _polldaddy;

_polldaddy.push( {
    type: 'button',
    title: 'Join OsmAnd Survey!',   
    domain: 'osmandapp.polldaddy.com/s/',
    id: 'tell-us-about-you',
    placeholder: 'pd1439392361078'
} );

(function(d,c,j){if(!document.getElementById(j)){var pd=d.createElement(c),s;pd.id=j;pd.src=('https:'==document.location.protocol)?'https://polldaddy.com/survey.js':'http://i0.poll.fm/survey.js';s=document.getElementsByTagName(c)[0];s.parentNode.insertBefore(pd,s);}}(document,'script','pd-embed'));
</script>

		  </li>
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
<!--
	  <div class="specialevent"  >     
      <div class="specialeventwrap">
        <div class="specialeventcontent">
          <div class="specialeventtext" style="height:600px">

        </div>
          
        </div>
      </div>     
    </div>
    -->

      	<div class="features">
	  
	    <div class="featurestitle"><h1>APP FEATURES</h1><p>Global Mobile Map Viewing and Navigation for Online and Offline OSM Maps</p></div>
		<div class="featurescontainer">
		<div class="featureblock noleftpadding">	
			<div class="featureblocktitle">	
				<img src="images/ic_navigation.png"/>
				<h1>Navigation <span class="warning">(Android only)</span></h1>
				<div style="clear:both;"></div>
			</div>
			<ul class="categorydescription">
				<li>Works totally offline (no roaming charges when you are abroad) but also has a (fast) online option </li>
				<li>Turn-by-turn voice guidance (recorded and synthesized voices)	</li>
				<li>Announce traffic warnings like stop signs, pedestrian crosswalks, or when you are exceeding the speed limit.	</li>		
				<li>Optional lane guidance, street name display, and estimated time of arrival</li>
				<li>Supports intermediate points on your itinerary</li>
				<li>Automatic re-routing whenever you deviate from the route</li>
				<li>Search for places by address, by type (e.g.: restaurant, hotel, gas station, museum), or by geographical coordinates</li>
			</ul>
		</div>
		
		<div class="featureblock">	
			<div class="featureblocktitle">	
				<img src="images/ic_map.png"/>			
				<h1>Map viewing</h1>
				<div style="clear:both;"></div>
			</div>
			<ul class="categorydescription">
				<li>Carry highly detailed, fully offline maps of any region world wide on your device!</li>
				<li>Display your position and orientation on the map</li>
				<li>Optionally align the map according to compass or your direction of motion	</li>
				<li>Save your most important places as Favorites</li>
				<li>Display POIs (points of interest) around you</li>
				<li>Can also display specialized online tile maps</li>
				<li>Can also display satellite view (from Bing)</li>
				<li>Can display different overlays like touring/navigation GPX tracks and additional maps with customizable transparency</li>
				<li>Optionally display place names in English, local, or phonetic spelling<br/>&nbsp;</li>
			</ul>
		</div>		
		
		<div class="featureblock noleftpadding">	
			<div class="featureblocktitle">	
				<img src="images/ic_bicycle.png"/>		
				<h1>Bicycle and pedestrian features</h1>
				<div style="clear:both;"></div>
			</div>
			<ul class="categorydescription">
				<li>The offline maps include foot, hiking, and bike paths, great for outdoor activities</li>
				<li>Map display and navigation mode for bicycle and pedestrian</li>
				<li>Optionally display public transport stops (bus, tram, train) including line names</li>
				<li>Optional trip recording to local GPX file or online service</li>
				<li>Optional speed and altitude display</li>
				<li>Display of contour lines and hill-shading (via additional plugin)</li>		
			</ul>
		</div>
		
		<div class="featureblock">	
			<div class="featureblocktitle">
				<img src="images/ic_open_source.png"/>	
				<h1>OpenStreetMap and Wikipedia data</h1>
				<div style="clear:both;"></div>
			</div>
			<ul class="categorydescription">
				<li>High quality information from the 2 best collaborative projects of the world</li>
						<li>Global maps from OpenStreetMap, available per country or region</li>
						<li>Wikipedia POIs, great for sightseeing (not available in free version)</li>
						<li>Unlimited free map downloads, directly from the app (download limit 10 map files in the free version)</li>
						<li>Always up-to-date maps (updated at least once a month)</li>
						<li>Compact offline vector maps</li>	
						<li>Select between complete map data and just road network (Example: All of Japan is 700 MB, or 200 MB for the road network only)</li>						
						<li>Also supports online or cached tile maps</li>
			</ul>
		</div>
		
	<div style="clear:both;"></div>
	</div>
	</div>
	
	<div class="screenshots">	 
	   <div class="slider">
	   <div class="sliderheader">
	   <h1>SCREENSHOTS</h1>
	  <div class="switch">
	       <div class="button left active" data-gatag="android_button">Android</div>
	       <div class="button right" data-gatag="ios_button">iOS</div>
		 
	  </div>
	  <div style="clear:both;"></div>
	  </div>
	  <div class="images">
	    <img class="left arrow" data-gatag="left_arrow" src="images/left_arrow_orange.png"/>	
	    <img class="screenshot first" id="screenshot1"  src="images/promo-1s.png"/>
		<img class="screenshot" id="screenshot2" src="images/promo-2s.png"/>
		<img class="screenshot" id="screenshot3" src="images/promo-3s.png"/>
		<img class="screenshot" id="screenshot4" src="images/promo-4s.png"/>
		<div style="clear:both;"></div>
		<img class="right arrow" data-gatag="right_arrow" src="images/right_arrow_orange.png"/>
	  </div>
	  
		  
	  </div>	
	</div>
	
	<div class="whatyousay">
		<div class="whatyousaycontainer">			
			<h1>WHAT YOU SAY</h1>
			<div class="whatyousayblock noleftpadding">
				<div class="whatyousaymessage">
				<span>"I use openstreetmap &amp; osmandapp for hiking. Their new iD map editor is easy, so I added a few missing local footpaths."</span>
				<img src="images/comment_arrow.png"/>
				</div>
				<div class="signature">
					<div class="name">Iain Cheyne</div>
					<div class="source">twitter: @Icheyne</div>
				</div>
			</div>					
			
			<div class="whatyousayblock ">
				<div class="whatyousaymessage">
				<span>"Saved me numerous times, I would not have survived the Philippines without it!"</span>
				<img src="images/comment_arrow.png"/>
				</div>
				<div class="signature">
					<div class="name">Michelle Ann Levine</div>
					<div class="source">Play Market</div>
				</div>
			</div>
			
			<div class="whatyousayblock noleftpadding">
				<div class="whatyousaymessage">
				<span>"Installed on a whim while on a cycling trip : I was very impressed by the amount of detail!"</span>
				<img src="images/comment_arrow.png"/>
				</div>
				<div class="signature">
					<div class="name">Fran&#231;ois-Xavier Thomas</div>
					<div class="source">Play Market</div>
				</div>
			</div>
			<div class="whatyousayblock">
				<div class="whatyousaymessage">
				<span>"Found osmandapp :) trip planning is incredible."</span>
				<img src="images/comment_arrow.png"/>
				</div>
				<div class="signature">
					<div class="name">Joanne Donn</div>
					<div class="source">twitter: @GearChic</div>
				</div>
			</div>
			
			<div class="whatyousayblock noleftpadding">
				<div class="whatyousaymessage">
				<span>"Whenever I travel I always use it. Very useful."</span>
				<img src="images/comment_arrow.png"/>
				</div>
				<div class="signature">
					<div class="name">Sonny Lacanlale</div>
					<div class="source">Play Market</div>
				</div>
			</div>
			
			<div class="whatyousayblock">
				<div class="whatyousaymessage">
				<span>"Great navigation app with offline maps from open street map with e.g. lane by lane navigation while driving, the UI is a bit difficult to navigate but it's a must app for vacation abroad."</span>
				<img src="images/comment_arrow.png"/>
				</div>
				<div class="signature">
					<div class="name">Jan Igerud</div>
					<div class="source">Play Market</div>
				</div>
			</div>
			<div style="clear:both;"></div>
			<div class="badgescontainer">
			 <ul class="badges">
				<li class="first">
					<a data-gatag="googleplay" href="https://play.google.com/store/apps/details?id=net.osmand.plus">
						<img alt="Get it on Google Play" src="https://developer.android.com/images/brand/en_generic_rgb_wo_45.png" />
					</a>
				</li>
				<li>
					<a data-gatag="amazon" href="http://www.amazon.com/gp/product/B00D0SEGMC/ref=mas_pm_OsmAnd-Maps-Navigation">
						<img alt="Get it on Amazon" src="images/amazon-apps-store.png" />
		           </a>
				</li>
				<li>
					<a data-gatag="ios" class="appstoretopbadge" href="https://itunes.apple.com/app/apple-store/id934850257?pt=2123532&ct=WebSite&mt=8">
						<img src="images/app-store-badge.png"/>
					</a>
				</li> 			
			</ul>
			<div style="clear:both;"></div>
			</div>
			
		</div>
	</div>
	
	<div class="mapexample">
	<div class="mapexampleheader">	
	<h1>MAP EXAMPLE</h1>
	</div>
	<div class="mapcontainer">
	<div class="selectbox">
		<div class="selecttitle first">MAP STYLE </div>
		<ul>
			<li><label><input data-gatag="osmand" type="radio" name="style" value="default" checked="true"/>OsmAnd</label></li>
			<li><label><input data-gatag="osmand_night" type="radio" name="style" value="night"/>OsmAnd - night</label></li>			
		</ul>
		
		<div class="selecttitle">SHOW</div>
		<ul>
			<li><label><input data-gatag="city_map" type="radio" name="show" value="citymap" checked="true"/>City map</label></li>
			<li><label><input data-gatag="cycling_routes" type="radio" name="show" value="cycling"/>Cycling routes</label></li>
			<li><label><input data-gatag="detailed_map" type="radio" name="show" value="detailedmap"/>Detailed map</label></li>
			<li><label><input data-gatag="hiking" type="radio" name="show" value="hiking"/>Hiking</label></li>
			<li><label><input data-gatag="public_transport" type="radio" name="show" value="subway" />Public transport</label></li>
			<li><label><input data-gatag="road_surface" type="radio" name="show" value="roadsurface"/>Road surface</label></li>
			<li><label><input data-gatag="nautical_sea" type="radio" name="show" value="nauticalsea"/>Nautical - sea</label></li>
			<li><label><input data-gatag="nautical_canals" type="radio" name="show" value="nauticalcanals"/>Nautical - canals</label></li>
		</ul>
		
	
	</div>
	</div>
	</div>


<div class="blogcontainerwrap">
	<div class="blogcontainer">
        <div class="leftcolumn">
	     
	       <?php 
  		include 'blocks/main_news.html';
  	?>
	   
	</div> <!-- leftcolumn -->
      
	   <div class="rightcolumn">

	  <?php 
  		include 'blocks/main_poll.html';
  	?>
		</div>  <!-- rightcolumn -->
	</div> <!-- blogcontainer -->
    </div>   <!-- blogcontainerwrap -->
	   
	   	   
	   	 <div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_EN/sdk.js#xfbml=1&version=v2.3";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

	<div class="blogcontainerwrap">
	<div class="blogcontainer">
        <div class="leftcolumn">
	   		<h1>FACEBOOK</h1>
			<div class="fb-page" data-href="https://www.facebook.com/osmandapp" 
	data-hide-cover="false" data-show-facepile="true" data-show-posts="true"  data-width="500" ><div class="fb-xfbml-parse-ignore"><blockquote cite="https://www.facebook.com/osmandapp"><a href="https://www.facebook.com/facebook">OsmAnd</a></blockquote></div></div>
		
		</div> <!-- leftcolumn -->
	  	<div class="rightcolumn">
   	   		<h1>TWITTER</h1>
          	<a class="twitter-timeline" href="https://twitter.com/osmandapp" data-widget-id="598236050113372160" height="502">Tweets by @osmandapp</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>


		</div>  <!-- rightcolumn -->
	</div> <!-- blogcontainer -->
  	</div>   <!-- blogcontainerwrap -->

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


function contactus() {
  var link = "m" + "ail" + "to" + ':';
  link = link + "contactus" + "@" + "osmand.net";
  window.location = link;
}
 
</script>
</body>

</html>
