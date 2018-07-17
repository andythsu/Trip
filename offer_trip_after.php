<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

  <!-- Optional theme -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
  <title></title>
</head>
<body>
  <div class="container">
    <h1>Thank you for offering a trip.</h1>
    <h2>Your trip information is: </h2>
    <?php
    require_once('lib/Car.class.php');
    require_once('lib/Trip.class.php');
    require_once('lib/Location.class.php');
    require_once('lib/Limit.class.php');

    $car_id = $_GET['car_id'];
    $user_id = $_GET['user_id'];
    $trip_id = $_GET['trip_id'];

    $car_info = Car::getByID($car_id);
    $car_info = $car_info[0];
    $trip_info = Trip::getByID($trip_id);
    $trip_info = $trip_info[0];
    $pickup_loc_id = $trip_info['trip_pickup_location'];
    $dropoff_loc_id = $trip_info['trip_dropoff_location'];
    $pickup_loc_info = Location::getByID($pickup_loc_id);
    $pickup_loc_info = $pickup_loc_info[0];
    $dropoff_loc_info = Location::getByID($dropoff_loc_id);
    $dropoff_loc_info = $dropoff_loc_info[0];
    $constraints = Limit::getConstraintsByTripID($trip_id);
    ?>
    <table class="table table-hover">
      <thead>
        <tr>
          <th>Car</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>Brand</td>
          <td><?php echo $car_info['car_brand']; ?></td>
        </tr>
        <tr>
          <td>Model</td>
          <td><?php echo $car_info['car_model']; ?></td>
        </tr>
        <tr>
          <td>Color</td>
          <td><?php echo $car_info['car_color']; ?></td>
        </tr>
      </tbody>
      <thead>
        <tr>
          <th>Trip</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>Pick up location</td>
          <td><?php echo $pickup_loc_info['location_city'] . '---' . $pickup_loc_info['location_name'] ?></td>
        </tr>
        <tr>
          <td>Drop off location</td>
          <td><?php echo $dropoff_loc_info['location_city'] . '---' . $pickup_loc_info['location_name'] ?></td>
        </tr>
        <tr>
          <td>Pick up Time</td>
          <td><?php echo $trip_info['trip_depart_time']; ?></td>
        </tr>
        <tr>
          <td>Price</td>
          <td><?php echo $trip_info['trip_price']; ?></td>
        </tr>
        <tr>
          <td>Constraints</td>
          <td>
            <?php
            if(!empty($constraints)) echo $constraints[0]['constraint_description'];
            ?>
          </td>
        </tr>
        <?php
        for ($i=1; $i < count($constraints); $i++) {
          ?>
          <tr>
            <td></td>
            <td><?php echo $constraints[$i]['constraint_description']; ?></td>
          </tr>
          <?php
        }
        ?>
      </tbody>
    </table>
    <h3>You will be redirected soon...</h3>
  </div>
</body>
</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script type="text/javascript">
$(document).ready(function(){
  setTimeout(function() {
    window.location.href = 'dashboard.php';
  }, 3000);
});
</script>
