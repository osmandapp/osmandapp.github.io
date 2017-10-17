<?php
/*
 * Parameters: name - description (example)
 * lat        - latitude (12.12345)
 * lon        - longitude (-2.12345)
 * myLocation - latitude and longitude of user's location (10.12345,-3.12345)
 * app        - type of app. Valid values: "paid" or "free".
 * lang       - app's locale (en) (ru) (be)
 * osm_image  - osm image tag value
 * osm_mapillary_key - osm mapillary key
 */
	class Place { 
		public $type; 

	    	public $lat; 
    		public $lon ; 
	    	public $timestamp;
    		public $key;
    		public $title;
	    	public $url;
	    	public $externalLink; // true if external browser should to be opened, open webview otherwise
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

	function parseMapillaryImage($feature) {
 		$coordinates = $feature->geometry->coordinates;

		$e = new Place;
 		$e->type = "mapillary-photo";
 		$e->timestamp = $feature->properties->captured_at;
 		
 		$e->key = $feature->properties->key;
 		$e->ca = $feature->properties->ca;
 		$e->imageUrl = "https://osmand.net/api/mapillary/get_photo.php?photo_id=".$e->key;
 		$e->imageHiresUrl = "https://osmand.net/api/mapillary/get_photo.php?hires=true&photo_id=".$e->key;
 		$e->url = "https://osmand.net/api/mapillary/photo-viewer.php?photo_id=".$e->key;
		$e->externalLink = false;
 		$e->username = $feature->properties->username;
 		$e->lat = $coordinates[1];
 		$e->lon = $coordinates[0];
		$e->topIcon = "ic_logo_mapillary";
		// To test
		//$e->buttonText = "Mapillary";
		//$e->buttonIcon = "ic_action_mapillary";
		//$e->buttonIconColor = "#ffffff";
		//$e->buttonColor = "#3db878";
		//$e->buttonTextColor = "#ffffff";

		return $e;
	}

	function processMapillaryData($lat, $lon, $primary_image_key) {

		global $arr, $halfvisarr, $nonvisarr;

		$txt = $lon.','.$lat;
	 	$result = file_get_contents("https://a.mapillary.com/v3/images/?closeto=".$txt."&radius=50&client_id=LXJVNHlDOGdMSVgxZG5mVzlHQ3ZqQTo0NjE5OWRiN2EzNTFkNDg4");
		$json_res = json_decode($result);

		$primary_image = null;
		if ($json_res) {
		 	foreach($json_res->features as $feature) {
		 		
		 		$e = parseMapillaryImage($feature);

				$distBearing = initialBearing($e->lat, $e->lon, floatval($lat), floatval($lon));
		 	 	$e->distance = $distBearing[0];
		 	 	$e->bearing = rad2deg($distBearing[1]);

		 	 	if ($primary_image_key && $e->key == $primary_image_key) {
		 	 		$primary_image = $e;
		 	 		continue;
		 	 	}

		 	 	if($e->ca && angleDiff($e->bearing - $e->ca, 30)) {
		 	 		array_push($arr, $e); 
		 	 	} else if($e->ca && angleDiff($e->bearing - $e->ca, 60) || !$e->ca) {
		 	 		array_push($halfvisarr, $e); 
		 	 	} else {
		 	 		array_push($nonvisarr, $e); 
		 	 	}
		 	}
		}

		if ($primary_image_key && !$primary_image) {
		 	$result = file_get_contents("https://a.mapillary.com/v3/images/".$primary_image_key."?client_id=LXJVNHlDOGdMSVgxZG5mVzlHQ3ZqQTo0NjE5OWRiN2EzNTFkNDg4");
			$json_res = json_decode($result);

			if ($json_res && !isset($json_res->missing_key)) {

				$e = parseMapillaryImage($json_res);
				$distBearing = initialBearing($e->lat, $e->lon, floatval($lat), floatval($lon));
		 	 	$e->distance = $distBearing[0];
		 	 	$e->bearing = rad2deg($distBearing[1]);

		 	 	$primary_image = $e;
			}
		}

		return $primary_image;
	}

	function parseWikimediaImage($lat, $lon, $file_name, $title, $image_info) {

		$e = new Place;
 		$e->type = "wikimedia-photo";
 		$e->timestamp = $image_info->timestamp;
 		
 		$e->key = $file_name;
 		$e->title = $title;
 		$e->imageUrl = $image_info->thumburl;
 		$e->imageHiresUrl = $image_info->url;
 		$e->url = $image_info->descriptionurl;
		$e->externalLink = false;
 		$e->username = $image_info->user;
 		$e->lat = $lat;
 		$e->lon = $lon;
		//$e->topIcon = "ic_logo_mapillary";

		return $e;
	}

	function processOsmImageData($lat, $lon, $osm_image) {

		global $arr, $halfvisarr, $nonvisarr;

		$primary_image = null;
		if ($osm_image) {
			// if wikimedia url
			if (strpos($osm_image, 'File:') === 0 || ((strpos($osm_image, 'wikimedia.org') !== false || strpos($osm_image, 'wikipedia.org') !== false) && strpos($osm_image, 'File:') !== false)) {
				$file_name = substr($osm_image, strpos($osm_image, 'File:'));
				if (!empty($file_name)) {
						$result = file_get_contents("https://commons.wikimedia.org/w/api.php?format=json&formatversion=2&action=query&prop=imageinfo&titles=".urlencode($file_name)."&iiprop=timestamp|user|url&iiurlwidth=576");
						$json_res = json_decode($result);

						if ($json_res && !isset($json_res->query->pages[0]->missing)) {

							$pages = $json_res->query->pages;
							if (!empty($pages)) {
								$image_info = $pages[0]->imageinfo[0];
								if ($image_info) {
									$pos = strpos($pages[0]->title, 'File:');
								    	if ($pos !== false) {
									    $title = substr($pages[0]->title, $pos + 5);
								    	} else {
									    $title = $pages[0]->title;
								    	}
									$primary_image = parseWikimediaImage($lat, $lon, $file_name, $title, $image_info);
								}
							}
						}
				}
			} else {
				$e = new Place;
		 		$e->type = "url-photo";
		 		$e->imageUrl = $osm_image;
		 		$e->url = $osm_image;
		 		$e->lat = $lat;
		 		$e->lon = $lon;
				//$e->topIcon = "ic_logo_mapillary";
				$primary_image = $e;
			}
		}

		return $primary_image;
	}

 $lat = $_GET['lat'];
 $lon = $_GET['lon'];

 if (isset($_GET['osm_image'])) {
   $osm_image = $_GET['osm_image'];
 }
 if (isset($_GET['osm_mapillary_key'])) {
   $osm_mapillary_key = $_GET['osm_mapillary_key'];
 }

 $arr = array();
 $halfvisarr = array();
 $nonvisarr = array(); 
  
 $primary_osm_image = processOsmImageData($lat, $lon, $osm_image);
 $primary_mapillary_place = processMapillaryData($lat, $lon, $osm_mapillary_key);

 usort($arr, "distanceTime");
 usort($nonvisarr, "distanceTime");
 if(empty($arr)) {
	 $arr = array_merge($arr, $halfvisarr);
 }
 if(empty($arr)) { 
    // don't add invisible area
    // $arr = array_merge($arr, $nonvisarr);
 }

 if ($primary_osm_image) {
	array_unshift($arr, $primary_osm_image);
 }
 if ($primary_mapillary_place) {
	array_unshift($arr, $primary_mapillary_place);
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
