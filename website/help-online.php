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

    <?php     	
        include 'blocks/default_links.html';
    ?>
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
        <div class="delimiter"></div>
        <ul class="articlelinklist">          
          <li><a data-gatag='faq' href="http://osmand.net/help-online?id=faq">FAQ</a></li>
          <li><a data-gatag='versions' href="http://osmand.net/help-online?id=changes">Versions</a></li>
          <!-- 
          <li><a data-gatag='features' href="http://osmand.net/features">Features</a></li>
          <li><a data-gatag='howto' href="http://osmand.net/help-online?id=HowToArticles">How to articles</a></li>
        -->
          <li><a data-gatag='map-legend' href="http://osmand.net/help-online?id=Map-Legend_default">Map legend</a></li>
          
          <li><a data-gatag='technical' href="http://osmand.net/help-online?id=TechnicalArticles">Technical articles</a></li>
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
