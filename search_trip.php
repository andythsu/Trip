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

  <title>Search Trip</title>

  <link rel="stylesheet" href="css/util.css">
</head>
<body>
  <div class="text-center">
    <img src="img/index_logo.png" alt="" style="padding-top: 40px;" width="50%">
  </div>
  <form class="container" action="daemon/search_trip.php" method="post">
    <!-- time -->
    <div class="form-group">
      <label>Choose a time range</label>
      <br>
      <span>From</span>
      <input class="form-control" type="datetime-local" name="from_time" max="9999-12-31T23:59">
      <span>To</span>
      <input class="form-control" type="datetime-local" name="to_time" max="9999-12-31T23:59">
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
        <label><input type="radio" name="sort_time">Time</label>
      </div>
      <div class="radio">
        <label><input type="radio" name="sort_price">Price</label>
      </div>
    </div>
    <hr>
    <div class="form-group text-center">
      <button class="btn btn-primary">Search</button>
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
  $("input[type=datetime-local]").attr("min", today);
  $("input[type=datetime-local").attr("value", today);
});
</script>
