        
<!DOCTYPE html>
<html>

<head>
<title>OsmAnd Help Pages</title>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<meta http-equiv="cleartype" content="on" />
<link href="help/style.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<div class="main">
        <?php
          echo file_get_contents("feature_articles/".$_GET['id'].".html");
      ?>
  </div>
</body>
</html>
