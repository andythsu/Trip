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
  <form class="container" action="search_trip_result.php" method="POST">
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
    <input type="checkbox" name="view_all" checked='false'>View All
    <hr>
    <!-- sort -->
    <div class="form-group">
      <label>Sort By</label>
      <br>
      <input type="checkbox" name="sort_time" checked='false'>Time
      <br>
      <input type="checkbox" name="sort_price">Price
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

<!-- <script type="text/javascript">
$("form").submit(function(e){
e.preventDefault();
var data = {
"from_time" : $("input[name=from_time]").val(),
"to_time" : $("input[name=to_time]").val(),
"all_time" : $("input[name=all_time_checkbox]").is(":checked"),
"pickup_loc_id" : $("select[name=pickup_location]").val(),
"all_pickup_loc" : $("input[name=all_pickup_loc_checkbox]").is(":checked"),
"dropoff_loc_id" : $("select[name=dropoff_location]").val(),
"all_dropoff_loc" : $("input[name=all_dropoff_loc_checkbox]").is(":checked"),
"price" : $('select[name=price]').val(),
"all_price" : $("input[name=all_price_checkbox]").is(":checked"),
"sort_time" : $("input[name=sort_time]").is(":checked"),
"sort_price" : $("input[name=sort_price]").is(":checked")
};
$.ajax({
"url" : 'daemon/search_trip.php',
"type" : 'post',
"data" : data,
success : function(json){
console.log(json);
}
});
// console.log(data);
});
</script> -->
