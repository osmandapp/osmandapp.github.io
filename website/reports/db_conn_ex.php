<?php
function db_conn() {
 if(isset($_GET['month'])) {
   date_default_timezone_set("UTC");
   $month = $_GET['month'];
   $cmonth = date("Y-m");
   $nmonth = date("Y-m", time() - 3*24*60*60);
   if(strlen($month) > 0 && $month != $cmonth && $month != $nmonth ){
     return pg_connect("host=localhost port=5432 dbname=changeset_".str_replace("-","_", $month)." user=*** password=***");
   }
 }
 return pg_connect("host=localhost port=5432 dbname=changeset user=*** password=***");
}
?>