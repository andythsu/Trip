<?php
require_once('DB.class.php');

/**
* user backend interface
* Author: Andy Su
*/

class User
{

  public static function getByID($id)
  {
    $sql = "SELECT * FROM user u WHERE u.user_id = ?";
    $data = array($id);
    $result = DB::select($sql, $data);
    return $result;
  }

  public static function getAll(){
    $sql = "SELECT * FROM user";
    $result = DB::query($sql);
    return $result;
  }

  public static function updateName($name, $id)
  {
    $sql = "Update user SET user_name = ? WHERE user_id = ?";
    $data = array($name, $id);
    $result = DB::update($sql, $data);
    return $result;
  }

  public static function updateEmail($email, $id)
  {
    $sql = "Update user SET user_email = ? WHERE user_id = ?";
    $data = array($email, $id);
    $result = DB::update($sql, $data);
    return $result;
  }

  public static function checkNameExists($name)
  {
    $sql = "SELECT user_name FROM user u WHERE u.user_name = ?";
    $data = array($name);
    $result = DB::select($sql, $data);
    return $result;
  }

  public static function signUp($data){
    $sql = "INSERT INTO user (user_name, user_email) VALUES (?,?)";
    $result = DB::insert($sql, $data);
    return $result;
  }

  public static function getAllSumRating(){
    $sql = "SELECT u.user_name, u.user_id, sum(r.rating_score) as sum from rating r, user u where r.user_id = u.user_id group by r.user_id";
    $result = DB::query($sql);
    return $result->fetchAll();
  }

  public static function getAllNoRating(){
    $sql = "SELECT user_name FROM user WHERE NOT EXISTS ( SELECT user_id FROM rating)";
    $result = DB::query($sql);
    return $result->fetchAll();
  }

  public static function getHighestScore(){
    $sql = 'SELECT DISTINCT user_id, MAX(rating_score) FROM rating';
    $result = DB::query($sql);
    return $result->fetchAll();
  }

  public static function getLowestScore(){
    $sql = 'SELECT DISTINCT user_id, MIN(rating_score) FROM rating';
    $result = DB::query($sql);
    return $result->fetchAll();
  }

}


?>
