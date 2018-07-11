<?php
require_once('../lib/util.php');
$from_datetime = explode("T", $_POST['from_time']);
$to_datetime = explode("T", $_POST['to_time']);

$from_time = $from_datetime[0] . " " . $from_datetime[1] . ":00";
$to_time = $to_datetime[0] . " " . $to_datetime[1] . ":00";
$pickup_loc_id = $_POST['pickup_location'];
$dropoff_loc_id = $_POST['dropoff_location'];
$price = $_POST['price'];

$sort_time = array_key_exists("sort_time", $_POST) ? true : false;
$sort_price = array_key_exists("sort_price", $_POST) ? true : false;

output($_POST);
?>
