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

  <title>Rating Center</title>
</head>
<body>
  <?php
  require_once('lib/User.class.php');
  require_once('lib/util.php');
  ?>
  <div class="container">
    <!-- return average rating for all users -->
    <div class="">
      <table class="table">
        <tr>
          <th>User Name</th>
          <th>Sum</th>
        </tr>
        <?php
        $all_ratings = User::getAllSumRating();
        if(!empty($all_ratings)){
          foreach ($all_ratings as $index => $rating) {
            ?>
            <tr>
              <td><?php echo $rating['user_name']; ?></td>
              <td><?php echo $rating['sum']; ?></td>
              <td><button class="btn btn-default">Rate now</button></td>
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
    <h4>User rated with highest score:
      <?php
      $highest_score = User::getHighestScore();
      output($highest_score);
      ?>
    </h4>
    <h4>User rated with loest score:

      <?php
      $lowest_score = User::getLowestScore();
      ?>
    </h4>
  </div>
</body>
</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
