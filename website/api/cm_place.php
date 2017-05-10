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
	    	public $distance;
    		public $bearing;
	    	public $imageUrl;
    		public $imageHiresUrl;
		public $topIcon;
		public $buttonIcon;
		public $buttonText;
		public $buttonIconColor; // example: #323232
		public $buttonColor; // example: #323232
		public $buttonTextColor; // example: #323232
	
	} 

	function angleDiff($angle, $diff) {
		if($angle > 360) {
			$angle -= 360;
		}
		if($angle < -360) {
			$angle += 360;
		}
		if(abs($angle) < $diff) {
			return true;
		}
		return false;
	}

	function distanceTime($obj1, $obj2){
		if($obj1->distance < $obj2->distance) {
			return -1;
		} else if($obj1->distance > $obj2->distance) {
			return 1;
		}
		return 0;
	}

	function initialBearing($lat1, $lon1, $lat2, $lon2) {
		$a = 6378137.0; // WGS84 major axis
        $b = 6356752.3142; // WGS84 semi-major axis
        $f = ($a - $b) / $a;
        $aSqMinusBSqOverBSq = ($a * $a - $b * $b) / ($b * $b);

        $L = deg2rad($lon2) - deg2rad($lon1);
        $A = 0.0;
        $U1 = atan((1.0 - $f) * tan(deg2rad($lat1)));
        $U2 = atan((1.0 - $f) * tan(deg2rad($lat2)));

        $cosU1 = cos($U1);
        $cosU2 = cos($U2);
        $sinU1 = sin($U1);
        $sinU2 = sin($U2);
        $cosU1cosU2 = $cosU1 * $cosU2;
        $sinU1sinU2 = $sinU1 * $sinU2;

        $lambda = $L; // initial guess
        $MAXITERS = 20	;
        for ($iter = 0; $iter < $MAXITERS; $iter++) {
            $lambdaOrig = $lambda;
            $cosLambda = cos($lambda);
            $sinLambda = sin($lambda);
            $t1 = $cosU2 * $sinLambda;
            $t2 = $cosU1 * $sinU2 - $sinU1 * $cosU2 * $cosLambda;
            $sinSqSigma = $t1 * $t1 + $t2 * $t2; // (14)
            $sinSigma = sqrt($sinSqSigma);
            $cosSigma = $sinU1sinU2 + $cosU1cosU2 * $cosLambda; // (15)
            $sigma = atan2($sinSigma, $cosSigma); // (16)
            $sinAlpha = ($sinSigma == 0) ? 0.0 :
                $cosU1cosU2 * $sinLambda / $sinSigma; // (17)
            $cosSqAlpha = 1.0 - $sinAlpha * $sinAlpha;
            $cos2SM = ($cosSqAlpha == 0) ? 0.0 :
                $cosSigma - 2.0 * $sinU1sinU2 / $cosSqAlpha; // (18)

            $uSquared = $cosSqAlpha * $aSqMinusBSqOverBSq; // defn
            $A = 1 + ($uSquared / 16384.0) * // (3)
                (4096.0 + $uSquared *
                 (-768 + $uSquared * (320.0 - 175.0 * $uSquared)));
            $B = ($uSquared / 1024.0) * // (4)
                (256.0 + $uSquared *
                 (-128.0 + $uSquared * (74.0 - 47.0 * $uSquared)));
            $C = ($f / 16.0) *
                $cosSqAlpha *
                (4.0 + $f * (4.0 - 3.0 * $cosSqAlpha)); // (10)
            $cos2SMSq = $cos2SM * $cos2SM;
            $deltaSigma = $B * $sinSigma * // (6)
                ($cos2SM + ($B / 4.0) *
                 ($cosSigma * (-1.0 + 2.0 * $cos2SMSq) -
                  ($B / 6.0) * $cos2SM *
                  (-3.0 + 4.0 * $sinSigma * $sinSigma) *
                  (-3.0 + 4.0 * $cos2SMSq)));

            $lambda = $L +
                (1.0 - $C) * $f * $sinAlpha *
                ($sigma + $C * $sinSigma *
                 ($cos2SM + $C * $cosSigma *
                  (-1.0 + 2.0 * $cos2SM * $cos2SM))); // (11)

            $delta = ($lambda - $lambdaOrig) / $lambda;
            if (abs($delta) < 1.0e-12) {
                break;
            }
        }
        $distance =  ($b * $A * ($sigma - $deltaSigma));
        $initialBearing = atan2($cosU2 * $sinLambda,
                $cosU1 * $sinU2 - $sinU1 * $cosU2 * $cosLambda);
        return array($distance, $initialBearing);
	}

 $txt = $_GET['lon'].','.$_GET['lat'];
 //echo file_get_contents("https://a.mapillary.com/v3/images/?closeto=".$txt."&radius=50&client_id=LXJVNHlDOGdMSVgxZG5mVzlHQ3ZqQTo0NjE5OWRiN2EzNTFkNDg4");
 $result = file_get_contents("https://a.mapillary.com/v3/images/?closeto=".$txt."&radius=50&client_id=LXJVNHlDOGdMSVgxZG5mVzlHQ3ZqQTo0NjE5OWRiN2EzNTFkNDg4");
 // $result = file_get_contents("cm_example.json");
 $json_res = json_decode($result);
 $arr = array();
 $halfvisarr = array();
 $nonvisarr = array();
 if($json_res) {
 	foreach($json_res->features as $feature ) {
 		$coordinates = $feature->geometry->coordinates;
 		
 		$e = new JsFeature;
 		$e->type = "mapillary-photo";
 		$e->timestamp = $feature->properties->captured_at;
 		
 		$e->key = $feature->properties->key;
 		$e->ca = $feature->properties->ca;
 		$e->imageUrl = "https://osmand.net/api/mapillary/get_photo.php?photo_id=".$e->key;
 		$e->imageHiresUrl = "https://osmand.net/api/mapillary/get_photo.php?hires=true&photo_id=".$e->key;
 		$e->url = "https://osmand.net/api/mapillary/photo-viewer.php?photo_id=".$e->key;
 		$e->username = $feature->properties->username;
 		$e->lat = $coordinates[1];
 		$e->lon = $coordinates[0];
		$e->topIcon = "ic_logo_mapillary";
		// To test
		$e->buttonText = "Test Mapillary";
		$e->buttonIcon = "ic_logo_mapillary";
		$e->buttonIconColor = "#333333";
		$e->buttonColor = "#aaaaaa";
		$e->buttonTextColor = "#000000";
		
 		$distBearing = initialBearing($e->lat, $e->lon, floatval($_GET['lat']), floatval($_GET['lon']));
 	 	$e->distance = $distBearing[0];
 	 	$e->bearing = rad2deg($distBearing[1]);
 	 	if($e->ca && angleDiff($e->bearing - $e->ca, 30)) {
 	 		array_push($arr, $e); 
 	 	} else if($e->ca && angleDiff($e->bearing - $e->ca, 60) || !$e->ca) {
 	 		array_push($halfvisarr, $e); 
 	 	} else {
 	 		array_push($nonvisarr, $e); 
 	 	}
 	}
 	usort($arr, "distanceTime");
 	usort($nonvisarr, "distanceTime");
 	if(empty($arr)) {
 		$arr = array_merge($arr, $halfvisarr);
 	}
 	if(empty($arr)) {
 		// don't add invisible area
 		// $arr = array_merge($arr, $nonvisarr);
 	}
 }
 if(!empty($arr)) {
// 	if(count($arr) > 5) {
// 		$arr = array_slice($arr, 0, 5) ;
// 	}
 	$e = array();
 	$e["type"] = "mapillary-contribute";
 	array_push($arr, $e); 
 }

 $map = array();
 $map["features"] = $arr;
 echo json_encode($map, JSON_PRETTY_PRINT);
 
?>
