<?php

 $txt = $_GET['lat'].','.$_GET['lon'];
 echo file_get_contents("https://a.mapillary.com/v3/images/?lookat=".$txt."&closeto=".$txt."&radius=20&client_id=LXJVNHlDOGdMSVgxZG5mVzlHQ3ZqQTo0NjE5OWRiN2EzNTFkNDg4");
?>
