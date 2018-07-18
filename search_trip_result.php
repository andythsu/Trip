<?php
require_once('lib/util.php');
require_once('lib/Trip.class.php');
require_once('lib/Location.class.php');
if(array_key_exists("from_time", $_POST)){
  $from_datetime = explode("T", $_POST['from_time']);
  $from_time = $from_datetime[0] . " " . $from_datetime[1] . ":00";
}else{
  $from_time = "";
}
if(array_key_exists("to_time", $_POST)){
  $to_datetime = explode("T", $_POST['to_time']);
  $to_time = $to_datetime[0] . " " . $to_datetime[1] . ":00";
}else{
  $to_time = "";
}

$pickup_loc_id = array_key_exists("pickup_location", $_POST) ? $_POST['pickup_location'] : "";
$dropoff_loc_id = array_key_exists("dropoff_location", $_POST) ? $_POST['dropoff_location'] : "";
$price = array_key_exists("price", $_POST) ? $_POST['price'] : "";
$sort_time = array_key_exists("sort_time", $_POST)? $_POST['sort_time'] : "";
$sort_price = array_key_exists("sort_price", $_POST)? $_POST['sort_price'] : "";
$view_all = array_key_exists("view_all", $_POST) ? $_POST['view_all'] : "";

// output($_POST);

if($view_all == 'on'){
  $trip_result = Trip::getAll();
  $results = array();
  $counter = 0;
  while($row = $trip_result->fetch()){
    $results[$counter]['trip_depart_time'] = $row['trip_depart_time'];
    $results[$counter]['trip_price'] = $row['trip_price'];
    $results[$counter]['trip_dropoff_location'] = $row['trip_dropoff_location'];
    $results[$counter]['trip_pickup_location'] = $row['trip_pickup_location'];
    $counter++;
  }
}else{
  $data = array($from_time, $to_time, $price, $pickup_loc_id, $dropoff_loc_id);
  $results = Trip::getByCondition($data);
}

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <!-- Optional theme -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
  <title>Result</title>
</head>
<body>
  <div class="container">
    <table class="table">
      <tr>
        <th>Depart Time</th>
        <th>Price</th>
        <th>Pick up location</th>
        <th>Drop off Location</th>
      </tr>
      <?php
      foreach ($results as $index => $result) {
        ?>
        <tr>
          <td><?php echo $result['trip_depart_time']; ?></td>
          <td><?php echo $result['trip_price']; ?></td>
          <td><?php
          $loc_result = Location::getByID($result['trip_pickup_location']);
          echo $loc_result[0]['location_city'] . '---' . $loc_result[0]['location_name'];
          ?>
        </td>
        <td>
          <?php
          $loc_result = Location::getByID($result['trip_dropoff_location']);
          echo $loc_result[0]['location_city'] . '---' . $loc_result[0]['location_name'];
          ?>
        </td>
      </tr>
      <?php
    }
    ?>
  </table>
</div>
</body>
</html>

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
