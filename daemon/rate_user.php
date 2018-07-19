<?php
require_once('../lib/Rating.class.php');

$user_id = $_POST['user_id'];
$rating = $_POST['rating'];

$result = Rating::insert($user_id, $rating);
if($result > 0){
  header("Location: ../rate_user.php");
}

?>
