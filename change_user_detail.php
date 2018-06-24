<?php
include 'lib/User.class.php';
$name = array_key_exists('name', $_POST) ? $_POST['name'] : null;
$email = array_key_exists('email', $_POST) ? $_POST['email'] : null;
$id = $_POST['id'];

// if user requests to change name
if($name !== null){
  $result = User::checkNameExists($name);
  if(!empty($result)){
    // there is record
    $rtn['msg'] = "User name has already been registered";
    $rtn['type'] = "fail";
  }else{
    // update user name
    if(User::updateName($name, $id)){
      $rtn['msg'] = "successfully updated";
      $rtn['type'] = "success";
    }
  }
}else
// if user requests to change email
{
  if(User::updateEmail($email, $id)){
    $rtn['msg'] = "successfully updated";
    $rtn['type'] = "success";
  }
}

echo json_encode($rtn);

?>
