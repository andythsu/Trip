<?php

require_once('../lib/util.php');
require_once('../lib/Trip.class.php');
$trip_id = $_POST['id'];
$result = Trip::deleteByID($trip_id);
$msg = array();
if($result){
  $msg['success'] = true;
  echo json_encode($msg);
}

?>
