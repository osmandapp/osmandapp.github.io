<?php
  if (empty($_GET['id'])) {
    $_GET['id'] ="main";
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
      $simpleheader_header_id = "API";
      $simpleheader_header = "Use OsmAnd power<br/>for your needs";
      include 'blocks/simple_header.php';
    ?>
    <div class="articles api_main">
      <div class="articlescontainer">

        <div class="article">
          <section class="api-section" id="use">
            <h2>Use OsmAnd API</h2>
            <p>OsmAnd API allows you to control installed OsmAnd app and change it for specific needs. The advantage of integrating with OsmAnd API that it is pretty easy to kick off development, could be embedded in any specific application and there is no specific requirements about Licensing of the target app. The main disadvantage user should have OsmAnd installed on a device.</p>
            <p class="list-header">OsmAnd API features:</p>
            <ul class="list">
              <li>Adding favorites and markers to the map</li>
              <li>Navigation between locations</li>
              <li>Creating audio/video/photo notes</li>
              <li>Starting and stopping GPX track recording</li>
              <li>Importing GPX tracks into OsmAnd and navigatin along them</li>
              <li>Other non-documented features might be already present or implemented by request</li>
            </ul>
          </section>

          <section class="highlighted-box sidebar-merge" id="demo-holder">
            <h3>Start your project</h3>
            <p>You can build your own in any way your like. Integration with OsmAnd API is done using 2 types of intents - silent (doesn't keep OsmAnd open) and visible (brings OsmAnd to a specific screen). There are plans to add Android Interprocess Communication in future. Please take a look at source code of the OsmAnd API project.</p>
            <a href="https://github.com/osmandapp/osmand-api-demo" class="github-link">https://github.com/osmandapp/osmand-api-demo</a>

            <h3>License</h3>
            <p>Since there is no direct code usage from the core OsmAnd project, the License is different for the OsmAnd API and for the OsmAnd Core project. Most likely application using OsmAnd API will be written from scratch and this application provided as an example won't be used at all. For OsmAnd API the least restrictive license is used, MIT license.</p>
            https://github.com/osmandapp/osmand-api-demo/blob/master/LICENSE.md
            <a href="https://github.com/osmand-api-demo/Osmand/blob/master/LICENSE.md">https://github.com/osmand-api-demo/Osmand/blob/master/LICENSE.md</a>
            <div class="api-demo">
              <h2>Download Demo</h2>
              <div class="img-preview"></div>
              <a href="https://play.google.com/store/apps/details?id=net.osmand.osmandapidemo" class="api-download-btn google-play-demo"></a>
            </div>
          </section>

          <section class="api-section sidebar-merge" id="sample-holder">
            <h2>OsmAnd Sample</h2>
            <p>TODO</p>
            <p>TODO</p>
            <div class="api-sample">
              <h2>Download Sample</h2>
              <div class="img-preview"></div>
              <a href="http://download.osmand.net/latest-night-build/OsmAnd-qt-sample-armv7.apk" class="api-download-btn download-sample">Download</a>
            </div>
            <h3>License</h3>
            <p>TODO <a class="mail-link" href="mailto:business@osmand.net">business@osmand.net</a>TODO</p>
            <a href="https://github.com/osmandapp/Osmand/blob/master/LICENSE">https://github.com/osmandapp/Osmand/blob/master/LICENSE</a>
          </section>

          <section class="api-section" id="rendering">
            <h2>Create new rendering style</h2>
            <p>TODO</p>
            <p>TODO</p>
          </section>

          <section class="api-section" id="routing">
            <h2>Customize routing engine</h2>
            <p>TODO</p>
            <p>TODO</p>
          </section>

          <section class="api-section">
            <div class="highlighted-box">
              <h3>Contact us for development</h3>
              <p>In case you have are not sure which case fits you the most or you would like to ask help from developers who has experience in building application integrated with OsmAnd, please don't hesitate to contact us <a class="mail-link" href="mailto:business@osmand.net">business@osmand.net</a>!</p>
            </div>
          </section>
        </div>

        <div class="article-menu-wrapper">
          <div class="modal-menu-button"></div>
          <div class="article-menu">
            <div class="acticlestitles">
              <h2>Build It</h2>
              <ul class="articlelinklist">
                <li><a data-gatag='use' href="use">Use OsmAnd API</a></li>
                <li><a data-gatag='core' href="core">Build app using OsmAnd Core</a></li>
                <li><a data-gatag='rendering' href="rendering">Create new rendering style</a></li>
                <li><a data-gatag='routing' href="routing">Customize routing engine</a></li>
                <li><a data-gatag='license' href="license">License</a></li>
              </ul>
            </div>
          </div>
          <div class="sidebar-holder api-demo">
            <h2>Download Demo</h2>
            <div class="img-preview"></div>
            <a href="https://play.google.com/store/apps/details?id=net.osmand.osmandapidemo" class="api-download-btn google-play-demo"></a>
          </div>
          <div class="sidebar-holder api-sample">
            <h2>Download Sample</h2>
            <div class="img-preview"></div>
            <a href="http://download.osmand.net/latest-night-build/OsmAnd-qt-sample-armv7.apk" class="api-download-btn download-sample">Download</a>
          </div>
        </div>

      </div>
    </div>
    <?php include 'blocks/footer.html';  ?>
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
