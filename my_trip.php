<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- css -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

  <!-- Optional theme -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

  <title>My offered trips</title>

</head>
<body>
  <div class="container">
    <table class="table">
      <tr>
        <th>Depart Time</th>
        <th>Price</th>
        <th>Pick Up Location</th>
        <th>Drop Off Location</th>
        <th>Car</th>
      </tr>
      <?php
      require_once('lib/Post.class.php');
      require_once('lib/Location.class.php');
      session_start();
      $user_id = $_SESSION['user_id'];
      $results = Post::getByUserID($user_id);
      foreach ($results as $index => $result) {
        $pickup_location = Location::getByID($result['trip_pickup_location']);
        $pickup_location = $pickup_location[0]['location_city'] . '---' . $pickup_location[0]['location_name'];
        $dropoff_location = Location::getByID($result['trip_dropoff_location']);
        $dropoff_location = $dropoff_location[0]['location_city'] . '---' . $dropoff_location[0]['location_name'];
        ?>
        <tr>
          <td><?php echo $result['trip_depart_time']; ?></td>
          <td><?php echo $result['trip_price']; ?></td>
          <td><?php echo $pickup_location; ?></td>
          <td><?php echo $dropoff_location; ?></td>
          <td><?php echo $result['car_color'] . ' ' . $result['car_brand'] . ' ' . $result['car_model']; ?></td>
          <td><button class="btn btn-danger" onclick="remove(<?php echo $result['trip_id'] ?>)">Delete</button></td>
        </tr>
        <?php
      }
      ?>
    </table>
    <button class="btn btn-dark" onclick="window.location='route.php'">Back</button>
  </div>
</body>
</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<script type="text/javascript">
function remove(id){
  $.ajax({
    "url" : "daemon/delete_trip.php",
    "method" : "post",
    "data" : {
      "id" : id
    },
    success : function(json){
      var data = JSON.parse(json);
      if(data['success'] == true){
        location.reload();
      }
    }
  });
}
</script>
