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
    <img class="mb-4" src="img/trip_logo.png" alt="" style="padding-top: 40px" width="35%" height="50%">
  </div>
  <form class="container" action="search_trip_result.php" method="POST">
    <h1>Search Your Trip</h1>
    <!-- time -->
    <div class="form-group">
      <label>Choose a time range</label>
      <br>
      <span>From</span>
      <input class="form-control" type="datetime-local" name="from_time" max="9999-12-31T23:59" required>
      <span>To</span>
      <input class="form-control" type="datetime-local" name="to_time" max="9999-12-31T23:59" required>
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
      <label for="">Trip price range</label>
      <select class="form-control" name="price">
        <option value="10-20">10 ~ 20</option>
        <option value="20-30">20 ~ 30</option>
      </select>
    </div>
    <hr>
    <input type="checkbox" name="view_all" checked='false'>View All
    <hr>
    <!-- sort -->
    <div class="form-group">
      <label>Sort By</label>
      <br>
      <input class="single-checkbox" type="checkbox" name="sort_time_asc"> Time ASC
      <br>
      <input class="single-checkbox" type="checkbox" name="sort_price_asc"> Price ASC
      <br>
      <input class="single-checkbox" type="checkbox" name="sort_time_desc"> Time DESC
      <br>
      <input class="single-checkbox" type="checkbox" name="sort_price_desc"> Price DESC
    </div>
    <hr>
    <div class="form-group text-center">
      <button class="btn btn-primary">Search</button>
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
$(document).ready(function(){
  /* Set today as minimum value and default value */
  var date = today();
  $("input[type=datetime-local]").attr("min", today);
  $("input[type=datetime-local").attr("value", today);

  /* set all checkboxes to unchecked */
  var inputs = document.getElementsByTagName('input');
  for (var i=0; i<inputs.length; i++)  {
    if (inputs[i].type == 'checkbox') {
      inputs[i].checked = false;
    }
  }
});
</script>

<script type="text/javascript">

var inputs = [$("input[name=from_time]"),$("input[name=to_time]"),$("select[name=pickup_location]"),$("select[name=dropoff_location]"),$("select[name=price]")];

$("input[name=view_all]").on("click", function(){
  if($(this).is(":checked")){
    disableAll();
  }else{
    enableAll();
  }
});

// limit to 1 checkbox selection
$("input.single-checkbox").on("change", function(){
  if($(this).siblings(":checked").length >= 1) {
    this.checked = false;
  }
});

function disableAll(){
  for(var i=0; i<inputs.length;i++){
    inputs[i].prop("disabled", true);
  }
}

function enableAll(){
  for(var i=0; i<inputs.length;i++){
    inputs[i].prop("disabled", false);
  }
}

</script>
