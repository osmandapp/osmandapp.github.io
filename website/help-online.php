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
  </div>
</div>
</body>
</html>