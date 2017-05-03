<?php
	class JsFeature { 
		public $type; 
    	public $lat; 
    	public $lon ; 
    	public $timestamp;
    	public $key;
    	public $url;
    	public $ca;
    	public $username;
    	public $imageUrl;
	} 

 $txt = $_GET['lon'].','.$_GET['lat'];
 //echo file_get_contents("https://a.mapillary.com/v3/images/?closeto=".$txt."&radius=50&client_id=LXJVNHlDOGdMSVgxZG5mVzlHQ3ZqQTo0NjE5OWRiN2EzNTFkNDg4");
 $result = file_get_contents("https://a.mapillary.com/v3/images/?closeto=".$txt."&radius=50&client_id=LXJVNHlDOGdMSVgxZG5mVzlHQ3ZqQTo0NjE5OWRiN2EzNTFkNDg4");
 // $result = file_get_contents("cm_example.json");
 $json_res = json_decode($result);
 $arr = array();
 if($json_res) {
 	foreach($json_res->features as $feature ) {
 		$coordinates = $feature->geometry->coordinates;
 		
 		$e = new JsFeature;
 		$e->type = "mapilary-photo";
 		$e->timestamp = $feature->properties->captured_at;
 		$e->key = $feature->properties->key;
 		$e->ca = $feature->properties->ca;
 		$e->imageUrl = "https://osmand.net/api/get_photo.php?photo_id=".$e->key;
 		$e->url = "https://osmand.net/api/photo-viewier.php?photo_id=".$e->key;
 		$e->username = $feature->properties->username;
 		$e->lat = $coordinates[1];
 		$e->lon = $coordinates[0];
 	 	array_push($arr, $e); 
 	}
 }
 if(!empty($arr)) {
 		$e = new JsFeature;
 		$e->type = "mapilary-contribute";
 	 	array_push($arr, $e); 
 }
 $map = array();
 $map["features"] = $arr;
 echo json_encode($map, JSON_PRETTY_PRINT);
 
?>
