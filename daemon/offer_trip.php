<?php
require_once('../lib/Trip.class.php');
require_once('../lib/Post.class.php');
require_once('../lib/Limit.class.php');

/* retrieve user id from session */
session_start();
$user_id = $_SESSION['user_id'];
/*********************************/

$car_id = $_POST['car'];
$pickup_time = $_POST['pickup_time'];
$price = $_POST['price'];
$dropoff_loc_id = $_POST['dropoff_location'];
$pickup_loc_id = $_POST['pickup_location'];
$constraints = $_POST['constraints'];

$trip_data = array($pickup_time, $price, $dropoff_loc_id, $pickup_loc_id);
$trip_id = Trip::insert($trip_data);

/* after trip is successfully inserted into DB, insert post info */
$post_data = array($car_id, $user_id, $trip_id);
$post_id = Post::insert($post_data);
/******************************************************************/

/* after post is successfully inserted into DB, insert into constraint info*/
foreach ($constraints as $index => $constraint_id) {
  $limit_data = array($constraint_id, $trip_id);
  $limit_id = Limit::insert($limit_data);
}
/********************************************************/

// redirect after everything is completed
header('Location:../offer_trip_after.php');

?>
