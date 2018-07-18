<?php
require_once('lib/util.php');
require_once('lib/Trip.class.php');
require_once('lib/Location.class.php');
require_once('lib/Post.class.php');

if(!empty($_POST)){
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

}

if(!empty($_GET)){
  $view_all = array_key_exists("view_all", $_GET) ? $_GET['view_all'] : "";
}

if($view_all == 'on'){
  $trip_result = Post::getAllDetail();
  $results = array();
  $counter = 0;
  while($row = $trip_result->fetch()){
    // reformat the output so all data looks the same for future use
    $results[$counter]['trip_depart_time'] = $row['trip_depart_time'];
    $results[$counter]['trip_price'] = $row['trip_price'];
    $results[$counter]['trip_dropoff_location'] = $row['trip_dropoff_location'];
    $results[$counter]['trip_pickup_location'] = $row['trip_pickup_location'];
    $results[$counter]['user_name'] = $row['user_name'];
    $results[$counter]['user_email'] = $row['user_email'];
    $results[$counter]['car_color'] = $row['car_color'];
    $results[$counter]['car_brand'] = $row['car_brand'];
    $results[$counter]['car_model'] = $row['car_model'];
    $counter++;
  }
}else{
  $data = array($from_time, $to_time, $price, $pickup_loc_id, $dropoff_loc_id);
  $results = Post::getAllDetailByCondition($data);
  // output($results);
}

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">


  <!-- Optional theme -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

  <link rel="stylesheet" href="css/util.css">
  <title>Result</title>
</head>
<body>
  <div class="container">
    <?php
    if(empty($results)){
      ?>
      <h1>No matching rows</h1>
      <?php
    }else{
      ?>
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
          <td><button class="btn btn-primary" onclick='custom_alert(<?php echo json_encode($result); ?>)'>Contact Info</button></td>
        </tr>
        <?php
      }
    }
    ?>
  </table>
  <button class="btn btn-info" onclick="window.location.href='search_trip.php'">Re-search</button>
</div>
</body>
</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script src="js/modal.js"></script>
<script type="text/javascript">
function custom_alert(json_obj){
  var modal_data = {
    "header" : {
      "content" : "Provider Detail"
    },
    "body" : {
      "content" : `
      <table class="table">
      <tr>
      <th>Name</th>
      <th>Email</th>
      <th>Car</th>
      </tr>
      <tr>
      <td>`+json_obj['user_name']+`</td>
      <td>`+json_obj['user_email']+`</td>
      <td>`+json_obj['car_color'] + " " + json_obj['car_brand'] + " " + json_obj['car_model']+`</td>
      </tr>
      </table>
      `
    }
  };
  var modal = getModal(modal_data);
  appendModal(modal);
}
</script>
