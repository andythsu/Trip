<?php
include '../lib/User.class.php';
$name = $_POST['name'];
$email = $_POST['email'];

$result = User::checkNameExists($name);
if(!empty($result)){
  // there is record
  $rtn['msg'] = "User name has already been registered";
  $rtn['type'] = "fail";
}else{
  // insert
  $data = array($name, $email);
  $result = User::signUp($data);

  if($result > 0){
    $rtn['msg'] = "successfully registered";
    $rtn['type'] = "success";
  }else{
    $rtn['msg'] = "error when inserting data";
    $rtn['type'] = "fail";
  }

}

echo json_encode($rtn);

?>
