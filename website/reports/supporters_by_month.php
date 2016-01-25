<?php

include 'db_conn.php';
include 'default_vars.php';
$dbconn = db_conn();
if (!$dbconn) {
	echo "{'error':'No db connection'}";
	exit;
}
if(!isset($_GET['month'])) {
  $month = date("Y-m");	
} else {
  $month = $_GET["month"];
}

$result = pg_query($dbconn, "
	select s.userid, s.visiblename, s.preferred_region, s.useremail, 
	t.sku, t.checktime, t.expiretime, t.starttime, t.autorenewing from supporters s left join 
	(select distinct userid, sku, 
	 first_value(checktime) OVER(partition by userid, sku order by checktime desc) checktime,
	 first_value(starttime) OVER(partition by userid, sku order by checktime desc) starttime,
	 first_value(expiretime) OVER(partition by userid, sku order by checktime desc) expiretime,
	 first_value(autorenewing) OVER(partition by userid, sku order by checktime desc) autorenewing
	 from supporters_subscription ) t on  
	s.userid = t.userid;
	");
if (!$result) {
  echo "{'error':'No result'}";
  exit;
}



$res = new stdClass();
$res->month = $month;
$res->rows = array();
$cnt = 0;
$active = 0;
while ($row = pg_fetch_row($result)) {
  $rw = new stdClass();
  array_push($res->rows, $rw);
  $visiblename = $row[1];
  if(!$visiblename || strlen($visiblename) == 0) {
  	  $visiblename = "User ".$row[0];
  }
  $status = "Not purchased";
  $checked = 0;
  if($row[4] && strlen($row[4]) > 0) {
	  $status = "Pending verification";
	  if($row[6])) {
		 $checked = $row[5];
		 if(time() * 1000 > $row[6]) {
		 	$status = "Expired";
		 } else {
		 	$status = "Active";
		 	$active++;
		 }
	  }	
  }
  $cnt++;
  $rw->user = $visiblename;
  $rw->status = $status;
  $rw->checked = $checked;
}
$res->count = $cnt;
$res->activeCount = $active;

echo json_encode($res);
?>