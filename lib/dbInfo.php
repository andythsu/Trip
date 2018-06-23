<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
</html>
<body>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
<?php
include 'db.php';
include 'config.php';

$db_name = $config['database_name'];
$tables = array();

$sql = "SELECT TABLE_NAME FROM information_schema.TABLES WHERE TABLE_SCHEMA = '$db_name'";
$result = mysqli_query($connection, $sql);
if($result){
  while($row = mysqli_fetch_assoc($result)){
    output($row);
  }
}else{
  die(mysqli_error($connection));
}

foreach ($tables as $table_id => $table_name) {
  ?>
  <h2 ><?php echo $table_name; ?></h2>
  <button class ="btn btn-danger" name="button">DELETE</button>
  <button class = "btn btn-warning" type="button" name="button">INSERT</button>
  <?php
  $sql = "SELECT * FROM $table_name";
  $result = mysqli_query($connection, $sql);
  if ($result) {
    while($row = mysqli_fetch_assoc($result)){
      echo "<h3>";
      output($row);
      echo "</h3>";
    }
    output("<hr>");
  }else{
    die(mysqli_error($connection));
  }
}

?>
