<?php
include 'calculate_ranking.php';
$ar = calculateRanking($_GET['month'], $_GET['region']);
$res = new stdClass();
$res->month = $month;
$res->rows = array();
for ($i = 0; $i < count($ar) ; ++$i) {
  $row = $ar[$i];
  $rw = new stdClass();
  array_push($res->rows, $rw);
  $rw->rank = $i + 1;
  $rw->countUsers = $row->count;
  $rw->minChanges = $row->min;
  $rw->maxChanges = $row->max;
  $rw->avgChanges = $row->changes / $row->count;
}
echo json_encode($res);
?>