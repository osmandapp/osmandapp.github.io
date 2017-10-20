<?php
require './vendor/autoload.php';

use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

$serviceAccount = ServiceAccount::fromJsonFile('./private/service.json');

$firebase = (new Factory)
->withServiceAccount($serviceAccount)
->withDatabaseUri('https://osmand-1e236.firebaseio.com/')
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
  <?php
    include 'blocks/default_links.html';
  ?>
  <title>OsmAnd Survey</title>
  <!-- Bootstrap core CSS -->
    <link href="../../dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="../../assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="starter-template.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="../../assets/js/ie-emulation-modes-warning.js"></script>
</head>
<body>
  <style>
    .content {
     margin-top: 100px;
     margin-left: auto;
     margin-right: auto;
     width: 50em
    }

    .headline {
     font-size: 35px;
     font-style: bold;
     margin-left: 100px;
     margin-right: 100px;
     margin-top: 20px
     width: 80em
    }
    
  </style>
  <div class="content">
      <img src="./images/img_messages.png" alt="Message" align="left" style="width:200px;height:50%;margin-right:50px;">
      <div class="headline">
        <p>Thank you for the feedback!</p>
      </div>
      <div class="main_text">
        <?php
        if ($_GET["response"] == 'bad') {
          echo "<p>Oh no! Something went wrong and you did not receive proper help? Please email us (<a href=\"mailto:contactus@osmand.net\">contactus@osmand.net</a>) and we will check the issue as soon as possible.</p>";
        }
        else {
          echo "<p>We are striving to make our support service better and faster!</p>";
        }
        ?>
      </div>
      <img src="./images/logo-grey.png" alt="Logo" style="width:150px;height:50%;margin-top:20px">
  </div>
  <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="../../dist/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
</body>
</html>
