<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Welcome</title>

  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

  <!-- Optional theme -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

  <!-- Custom styles for this template -->
  <link href="css/sign_in.css" rel="stylesheet">
  <link href="css/util.css" rel="stylesheet">
</head>

<body>
  <div class="text-center">
    <img class="mb-4" src="img/index_logo.png" alt="" width="50%" height="50%">
  </div>
  <div class="text-center">
    <form class="form-signin" action="detail_confirmation.php" method="post">
      <h1 class="h3 mb-3 font-weight-normal">Please sign in with your user name listed below</h1>
      <select class="form-control" name="user_id">
        <?php
        include 'lib/User.class.php';
        $result = User::getAll();
        while($row = $result->fetch()){
          ?>
          <option value="<?php echo $row['user_id'] ?>"><?php echo $row['user_name'] ?></option>
          <?php
        }
        ?>
      </select>

      <button class="btn btn-primary form-control sign_in_btn" type="submit" name="button">Sign In</button>

    </form>
    <p>Not listed? <a href="sign_up.php">Sign up here</a></p>
  </div>
</body>
</html>

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
