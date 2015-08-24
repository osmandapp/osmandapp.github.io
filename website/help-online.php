<!DOCTYPE html>
<html>

<head>
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<title>OsmAnd - Offline Mobile Maps and Navigation
</title>

<link rel="stylesheet" type="text/css" href="site.css"/>
<script type="text/javascript" src="scripts/jquery-1.11.1.min.js"></script>
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
    	$simpleheader_header = "HELP";
        include 'blocks/simple_header.php';
    ?>

  <?php 
      include 'blocks/footer.html';
    ?>
  </div>
  <div class="articles">
        <div class="articlescontainer">
        </div>
        <ul class="articlelinklist">          
          <li><a data-gatag='faq' href="http://osmand.net/help-online?id=faq">FAQ</a></li>
          <li><a data-gatag='versions' href="http://osmand.net/help/changes.html">Versions</a></li>
          <!-- 
          <li><a data-gatag='versions' href="http://osmand.net/features">Features</a></li>
        -->
          <li><a data-gatag='map-legend' href="http://osmand.net/help/Map-Legend_default.html">Map Legend</a></li>
          <li><a data-gatag='howto' href="http://osmand.net/help/Map-Legend_default.html">How to</a></li>
          <li><a data-gatag='technical' href="http://osmand.net/help/Map-Legend_default.html">Techincal articles</a></li>
          <li><a data-gatag='about' href="http://osmand.net/help-online?id=about">About</a></li>
        </ul>
  </div>
</div>
</body>
</html>