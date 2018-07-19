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

  public static function getAllRating(){
    $sql = "SELECT u.user_name, u.user_id, round(avg(r.rating_score),0) as avg from rating r, user u where r.user_id = u.user_id group by r.user_id";
    $result = DB::query($sql);
    return $result->fetchAll();
  }

  public static function getAllNoRating(){
    $sql = "SELECT user_id, user_name FROM user WHERE user_id NOT IN (SELECT user_id FROM rating)";
    $result = DB::query($sql);
    return $result->fetchAll();
  }

  public static function getHighestScore(){
    $sql = 'SELECT u1.user_name, round(avg(r1.rating_score),0) as average FROM rating r1, user u1 WHERE u1.user_id = r1.user_id  GROUP BY r1.user_id HAVING average >= all (SELECT avg(r2.rating_score) FROM rating r2 GROUP BY r2.user_id)';
    $result = DB::query($sql);
    return $result->fetchAll();
  }

  public static function getLowestScore(){
    $sql = 'SELECT u1.user_name, round(avg(r1.rating_score),0) as average FROM rating r1, user u1 WHERE u1.user_id = r1.user_id  GROUP BY r1.user_id HAVING average <= all (SELECT avg(r2.rating_score) FROM rating r2 GROUP BY r2.user_id)';
    $result = DB::query($sql);
    return $result->fetchAll();
  }

}


?>
