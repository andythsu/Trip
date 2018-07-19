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

  <link rel="stylesheet" href="css/util.css">

  <title>Rating Center</title>
</head>
<body>
  <?php
  require_once('lib/User.class.php');
  require_once('lib/util.php');
  ?>
  <div class="container">
    <form method = "POST" action = "daemon/rate_user.php">
      <!-- banner area -->
      <div class="alert alert-success" style="display: none"></div>
      <div class="alert alert-danger" style="display: none"></div>
      <!-- ///// -->
      <h1>Rate Users</h1>
      <!-- return average rating for all users -->
      <div class="" >
        <div class="" style="display: inline-block">
          <h4>Who do you want to rate</h4>
          <select class="" name="user_id">
            <?php
            $users = User::getAll();
            while($row = $users->fetch()){
              ?>
              <option value=<?php echo $row['user_id']; ?>><?php echo $row['user_name']; ?></option>
              <?php
            }
            ?>
          </select>
        </div>
        <div class="pl-1em" style="display: inline-block">
          <h4>What's your rating?</h4>
          <select class="" name="rating">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
          </select>
        </div>
        <div class="pl-1em" style="display: inline-block">
          <button class="btn btn-primary rate_btn">Submit</button>
        </div>
      </form>
      <button class="btn btn-dark" type="button" name="button" onclick="window.location='route.php'">Back</button>
    </div>

    <hr>

    <h1>Statistics</h1>

    <!-- return users that have not been rated -->
    <h4>Users that have not been rated</h4>
    <table class="table">
      <tr>
        <th>User Name</th>
      </tr>
      <?php
      $no_ratings = User::getAllNoRating();
      if(!empty($no_ratings)){
        foreach ($no_ratings as $index => $no_rating) {
          ?>
          <tr>
            <td><?php echo $no_rating['user_name']; ?></td>
          </tr>
          <?php
        }
      }else{
        ?>
        <tr>
          <td>No matching result</td>
        </tr>
        <?php
      }
      ?>
    </table>
    <h4>User rated with highest score</h4>
    <table class="table">
      <tr>
        <th>Name</th>
        <th>Score</th>
      </tr>
      <?php
      $scores = User::getHighestScore();
      if(empty($scores)){
        ?>
        <tr>
          <td>No matching result</td>
        </tr>
        <?php
      }else{
        foreach ($scores as $index => $score) {
          ?>
          <tr>
            <td><?php echo $score['user_name']; ?></td>
            <td><?php echo $score['average'] ?></td>
          </tr>
          <?php
        }
      }
      ?>
    </table>
    <h4>User rated with lowest score</h4>
    <table class="table">
      <tr>
        <th>Name</th>
        <th>Score</th>
      </tr>
      <?php
      $scores = User::getLowestScore();
      if (empty($scores)) {
        ?>
        <tr>
          <td>No matching result</td>
        </tr>
        <?php
      }else{
        foreach ($scores as $index => $score) {
          ?>
          <tr>
            <td><?php echo $score['user_name']; ?></td>
            <td><?php echo $score['average'] ?></td>
          </tr>
          <?php
        }
      }
      ?>
    </table>
    <h4>User rated more than 3 scores</h4>
    <table class="table">
      <tr>
        <th>Name</th>
      </tr>
      <?php
      $users = User::getMoreThanThreeScore();
      if(empty($users)){
        ?>
        <tr>
          <td>No matching results</td>
        </tr>
        <?php
      }else{
        foreach ($users as $index => $user) {
          ?>
          <tr>
            <td><?php echo $user['user_name'] ?></td>
          </tr>
          <?php
        }
      }
      ?>
    </table>
  </div>
</body>
</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
