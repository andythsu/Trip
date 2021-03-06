<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

  <!-- Optional theme -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

  <link href="css/index.css" rel="stylesheet">
  <link href="css/util.css" rel="stylesheet">

  <title>Route</title>

</head>
<body>
  <div class="text-center">
    <img class="mb-4" src="img/trip_logo.png" alt="" style="padding-top: 40px" width="35%" height="50%">
  </div>
  <div class="container">
    <div class="">
      <button class="btn btn-info custom_btn" onclick="window.location='offer_trip.php'">
        <p class="custom_text">
          Offer a ride
        </p>
      </button>
      <button class="btn btn-info custom_btn" onclick="window.location='search_trip.php'">
        <p class="custom_text">
          Look for a ride
        </p>
      </button>
      <br>
      <button class="btn btn-info custom_btn" onclick="window.location='rate_user.php'">
        <p class="custom_text">
          Rating center
        </p>
      </button>
      <button class="btn btn-info custom_btn" onclick="window.location='my_trip.php'">
        <p class="" style="font-size: 20px;">
          View my offered trips
        </p>
      </button>
      <br>
      <div class="text-center">
        <button class="btn btn-link" onclick="window.location='index.php'">
          <p>
            Sign out
          </p>
        </button>
      </div>
    </div>
  </div>
</body>
</html>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
