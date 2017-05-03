<?php

 $txt = $_GET['lon'].','.$_GET['lat'];
 echo file_get_contents("https://a.mapillary.com/v3/images/?closeto=".$txt."&radius=50&client_id=LXJVNHlDOGdMSVgxZG5mVzlHQ3ZqQTo0NjE5OWRiN2EzNTFkNDg4");
?>
