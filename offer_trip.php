<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

  <!-- Optional theme -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

  <link rel="stylesheet" href="css/util.css">
  <title>Offer a trip</title>
</head>
<body>
  <div class="text-center">
    <img class="mb-4" src="img/trip_logo.png" alt="" style="padding-top: 40px" width="35%" height="50%">
  </div>
  <form class="container" action="daemon/offer_trip.php" method="POST">
    <h1>Offer A Trip</h1>
    <!-- select car  -->
    <div class="form-group">
      <label for="">Select your car</label>
      <select class="form-control" name="car">
        <?php
        require_once('lib/Car.class.php');
        $result = Car::getAll();
        while($row = $result->fetch()){
          ?>
          <option value="<?php echo $row['car_id'] ?>">
            <?php
            echo $row['car_color'] . ' ' .
            $row['car_brand'] . ' ' .
            $row['car_model'] . '. Seat limit: ' .
            $row['car_seats'] . ' people';
            ?>
          </option>
          <?php
        }
        ?>
      </select>
    </div>
    <!-- pick up location -->
    <div class="form-group">
      <label for="">Select pick-up location</label>
      <select class="form-control" name="pickup_location">
        <?php
        include 'lib/Location.class.php';
        $result = Location::getAll();
        while($row = $result->fetch()){
          ?>
          <option value="<?php echo $row['location_id'] ?>">
            <?php
            echo $row['location_city'] . '---'.
            $row['location_name']
            ?>
          </option>
          <?php
        }
        ?>
      </select>
    </div>
    <div class="form-group">
      <label for="">Select pick-up time</label>
      <input class="form-control" type="datetime-local" name="pickup_time" max="9999-12-31T23:59" required>
    </div>
    <!-- drop off location -->
    <div class="form-group">
      <label for="">Select drop-off location</label>
      <select class="form-control" name="dropoff_location">
        <?php
        $result = Location::getAll();
        while($row = $result->fetch()){
          ?>
          <option value="<?php echo $row['location_id'] ?>">
            <?php
            echo $row['location_city'] . '---'.
            $row['location_name']
            ?>
          </option>
          <?php
        }
        ?>
      </select>
    </div>
    <!-- price -->
    <div class="form-group">
      <label for="">Trip price</label>
      <select class="form-control" name="price">
        <option value="10">10 / person</option>
        <option value="15">15 / person</option>
        <option value="20">20 / person</option>
        <option value="25">25 / person</option>
        <option value="30">30 / person</option>
      </select>
    </div>
    <!-- constraints -->
    <div class="form-group">
      <label for="">Select constraint(s)</label>
      <select class="form-control" name="constraints[]" multiple>
        <?php
        include 'lib/Constraint.class.php';
        $result = Constraint::getAll();
        while($row = $result->fetch()){
          ?>
          <option value="<?php echo $row['constraint_id'] ?>">
            <?php echo $row['constraint_description'] ?>
          </option>
          <?php
        }
        ?>
      </select>
    </div>
    <div class="form-group text-center">
      <button class="btn btn-info">Submit</button>
    </div>
  </form>
  <div class="text-center">
    <button class="btn btn-dark" onclick="window.location='route.php'">Back</button>
  </div>
</body>
</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script src="js/util.js"></script>
<script type="text/javascript">
/* Set today as minimum value and default value */
$(document).ready(function(){
  var date = today();
  $("input[name=pickup_time]").attr("min", today);
  $("input[name=pickup_time]").attr("value", today);
});
</script>
