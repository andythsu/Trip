<?php
include 'lib/util.php';
include 'lib/db.php';
$name = $_POST['name'];
$email = $_POST['email'];

$con = DB::getCon();

$sql = "SELECT user_name FROM User u WHERE u.user_name = '$name'";
$result = DB::query($sql);
$rowcount = mysqli_num_rows($result);
if($rowcount > 0){
  // there is record
  $rtn['msg'] = "it has already been registered";
  $rtn['type'] = "fail";
}else{
  // insert
  $stmt = $con->prepare("INSERT INTO User (user_name, user_email) VALUES (?,?)");
  $stmt->bind_param("ss", $name, $email);
  $stmt->execute();
  $rtn['msg'] = "successfully registered";
  $rtn['type'] = "success";
}

echo json_encode($rtn);

?>
