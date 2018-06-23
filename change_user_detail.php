<?php
include 'lib/util.php';
include 'lib/db.php';
$name = $_POST['name'];
$email = $_POST['email'];
$id = $_POST['id'];

$con = DB::getCon();

// if user requests to change name
if($name == "null"){
  $sql = "SELECT user_name FROM User u WHERE u.user_name = '$name'";
  $result = DB::query($sql);
  $rowcount = mysqli_num_rows($result);
  if($rowcount > 0){
    // there is record
    $rtn['msg'] = "User name has already been registered";
    $rtn['type'] = "fail";
  }else{
    // update
    $stmt = $con->prepare("Update User SET user_name = ? WHERE user_id = ?");
    $stmt->bind_param("si", $name, $id);
    if($stmt->execute()){
      $stmt->close();
      $rtn['msg'] = "successfully updated";
      $rtn['type'] = "success";
    }else{
      echo "failed: " . $stmt->error;
    }
  }
}else
// if user requests to change email
{
  $stmt = $con->prepare("Update User SET user_email = ? WHERE user_id = ?");
  $stmt->bind_param("si", $email, $id);
  if($stmt->execute()){
    $stmt->close();
    $rtn['msg'] = "successfully updated";
    $rtn['type'] = "success";
  }else{
    echo "failed: " . $stmt->error;
  }
}

echo json_encode($rtn);

?>
