<?php
  if (empty($_GET['id'])) {
    $_GET['id'] ="changes";
  } 
?>
<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="X-UA-Compatible" content="IE=Edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>OsmAnd - Offline Mobile Maps and Navigation</title>
  <?php
    include 'blocks/default_links.html';
  ?>
</head>
<body>
  <div class="maincontainer">
    <div class="main">
      <?php 
        $simpleheader_header = "DOWNLOADS";
        include 'blocks/simple_header.php';
      ?>
      <div class="articles">
        <div class="articlescontainer">
          <div class="article"><?php echo file_get_contents("help/".$_GET['id'].".html");?></div>
          <div class="article-menu-wrapper">
            <div class="modal-menu-button"></div>
            <div class="article-menu">
              <div class="acticlestitles">
                <h2>Downloads</h2>
                <ul class="articlelinklist">
                  <li><a data-gatag='map_creator' href="http://download.osmand.net/latest-night-build/OsmAndMapCreator-main.zip">OsmAnd Map Creator (Desktop)</a></li>
                  <li><a data-gatag="nightly_build" href="http://download.osmand.net/latest-night-build/OsmAnd-default.apk">OsmAnd Nightly Build (Android)</a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php 
        include 'blocks/footer.html';
      ?>
    </div>
  </div>
  <script>
    $('.modal-menu-button').on('click', function(e) {
      e.preventDefault();
      $(this).toggleClass('active');
      $('.article-menu').slideToggle();
    });

    $('body').on('click', function() {
      if ($('.modal-menu-button').hasClass('active')) {
        $('.modal-menu-button').toggleClass('active');
        $('.article-menu').slideToggle();
      }
    });

    $(window).on('resize', function() {
      if ($(document).width() > 900) {
        $('.article-menu').attr('style', false);
        $('.question').removeClass('active');
        $('.question .content').attr('style', false);
      }
    });

    $('.article-menu-wrapper').on('click', function(e) {
      e.stopPropagation();
    });

    $('.question .subtitle').on('click', function(e) {
      e.preventDefault();

      if ($(document).width() < 900) {
        $(this).parent().toggleClass('active');
        $(this).next().slideToggle();
      }
    });
    
    $('.download-btn').on('click', function(e) {
      e.stopPropagation();
    });
  </script>
</body>
</html>
