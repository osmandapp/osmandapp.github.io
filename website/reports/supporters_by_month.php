<?php
include 'supporters_by_month_base.php';
$res = getSupporters();
echo json_encode($res);
?>