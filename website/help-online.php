<?php
  if (empty($_GET['id'])) {
    $_GET['id'] ="faq";
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
<body>


<div class="maincontainer">
  <div class="main">
    <?php 
    	$simpleheader_header = "HELP";
        include 'blocks/simple_header.php';
    ?>

  
  <div class="articles">
      <div class="articlescontainer">
        <ul class="articlelist">        
        <li>
        <div class="article">
        <?php
          echo file_get_contents("help/".$_GET['id'].".html");
      ?>
        </div>
        </li>
      </ul>
      
      <div class="acticlestitles">
        <h1>HELP</h1>
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
      </div> <!-- acticlestitles -->
    </div>  <!-- articlescontainer -->
  </div> <!-- articles -->
  <?php 
      include 'blocks/footer.html';
    ?>
  </div>
</div>
</body>
</html>