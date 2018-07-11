<!DOCTYPE html>
<html>
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

  <form class="container">
    <!-- time -->
    <div class="form-group">
      <label>Choose a time range</label>
      <br>
      <span>From</span>
      <input class="form-control" type="datetime-local" name="pickup_time" max="9999-12-31T23:59">
      <span>To</span>
      <input class="form-control" type="datetime-local" name="pickup_time" max="9999-12-31T23:59">
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
      <input class="form-control" type="datetime-local" name="pickup_time" max="9999-12-31T23:59">
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

    <hr>

    <!-- sort -->
    <div class="form-group">
      <label>Sort By</label>
      <div class="radio">
        <label><input type="radio" name="time">Time</label>
      </div>
      <div class="radio">
        <label><input type="radio" name="price">Price</label>
      </div>
    </div>
  </form>

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
