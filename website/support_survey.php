<?php
require './vendor/autoload.php';

use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

$serviceAccount = ServiceAccount::fromJsonFile('./service.json');

$firebase = (new Factory)
->withServiceAccount($serviceAccount)
->withDatabaseUri('https://supportsurvey-72364.firebaseio.com/')
->create();

$database = $firebase->getDatabase();

$date = date('M Y');

if ($_GET["response"] == 'good') {
  $newPost = $database
  ->getReference($date)
  ->push([
     'response' => 'good',
     'timestamp' => time()
  ]);
}
elseif ($_GET["response"] == 'average') {
  $newPost = $database
  ->getReference($date)
  ->push([
     'response' => 'average',
     'timestamp' => time()
  ]);
}
elseif ($_GET["response"] == 'bad') {
  $newPost = $database
  ->getReference($date)
  ->push([
     'response' => 'bad',
     'timestamp' => time()
  ]);
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="X-UA-Compatible" content="IE=Edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>OsmAnd - Offline Mobile Maps and Navigation</title>
  <?php include 'blocks/default_links.html';  ?>
  <!-- for google+-->
  <link rel="canonical"  <?php echo 'href="http://osmand.net'.$_SERVER['REQUEST_URI'].'"'  ?> />
  <script src="https://apis.google.com/js/platform.js" async defer></script>
</head>
<body>
  <!-- for FB-->
  <div id="fb-root"></div>
  <script>
    (function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.3";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
  </script>

  <div class="maincontainer">
    <div class="main">
    <?php
      $simpleheader_header_id = "SURVEY";
      $simpleheader_header = "SURVEY";
      include 'blocks/simple_header.php';
    ?>
    <div class="articles api_main">
      <div class="articlescontainer">

        <div class="article">
          <section class="api-section" id="use">
            <script>
                if ($_GET["response"] = 'bad') {
                    <?php echo '<p>Thank you for completing our survey!</p>'?>
                }
            </script>
            <p>Thank you for completing our survey!</p>
          </section>
      </div>
    </div>
    </div>
  </div>
</div>

<!-- for twitter-->
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
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
      setDemoSidebarPosition();
      setSampleSidebarPosition();
    }
  });

  $('.article-menu-wrapper').on('click', function(e) {
    e.stopPropagation();
  });

  function setDemoSidebarPosition() {
    var demo = $('.sidebar-holder.api-demo'),
        demoHeight = demo.height(),
        demoHolder = $('#demo-holder'),
        demoHolderHeight = demoHolder.height(),
        demoHolderTop = demoHolder.offset().top,
        sidebarTop = $('.article-menu-wrapper').offset().top,
        demoTop = sidebarTop;

    if (demoHolderTop > demoTop) {
      demo.css({'top': demoHolderTop - demoTop })
    }
    if (demoHeight > demoHolderHeight) {
      demoHolder.css({'min-height': demoHeight + 30})
    } else {
      demo.css({'min-height':demoHolderHeight + 40})
    }
  }

  function setSampleSidebarPosition() {
    var sample = $('.sidebar-holder.api-sample'),
        sampleHeight = sample.height(),
        sampleHolder = $('#sample-holder'),
        sampleHolderHeight = sampleHolder.height(),
        sampleHolderTop = sampleHolder.offset().top,
        sidebarTop = $('.article-menu-wrapper').offset().top,
        sampleTop = sidebarTop;

    if (sampleHolderTop > sampleTop) {
      sample.css({'top': sampleHolderTop - sampleTop })
    }
    if (sampleHeight > sampleHolderHeight) {
      sampleHolder.css({'min-height': sampleHeight + 30})
    }
  }

  if ($(document).width() > 900) {
    setDemoSidebarPosition();
    setSampleSidebarPosition();
  }
</script>
</body>
</html>
