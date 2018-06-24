<?php
include 'DB.class.php';

/**
* user backend interface
*/
class User
{

  public static function selectByID($id)
  {
    $sql = "SELECT * FROM User u WHERE u.user_id = ?";
    $data = array($id);
    $result = DB::select($sql, $data);
    return $result;
  }

  public static function selectAll(){
    $sql = "SELECT * FROM User";
    $result = DB::query($sql);
    return $result;
  }

  public static function updateName($name, $id)
  {
    $sql = "Update User SET user_name = ? WHERE user_id = ?";
    $data = array($name, $id);
    $result = DB::update($sql, $data);
    return $result;
  }

  public static function updateEmail($email, $id)
  {
    $sql = "Update User SET user_email = ? WHERE user_id = ?";
    $data = array($email, $id);
    $result = DB::update($sql, $data);
    return $result;
  }

  public static function checkNameExists($name)
  {
    $sql = "SELECT user_name FROM User u WHERE u.user_name = ?";
    $data = array($name);
    $result = DB::select($sql, $data);
    return $result;
  }

  public static function signUp($data){
    $sql = "INSERT INTO User (user_name, user_email) VALUES (?,?)";
    $result = DB::insert($sql, $data);
    return $result;
  }

}


?>
