<?php
require_once('DB.class.php');
/**
* Post backend interface
* Author: Andy Su
*/
class Post
{

  /**
  * insert data into post table
  * @param  array $data (car_id, user_id, trip_id)
  * @return int   newly inserted row id
  */
  public static function insert($data)
  {
    $sql = "INSERT INTO posts (car_id, user_id, trip_id) VALUES (?, ?, ?)";
    $result = DB::insert($sql, $data);
    return $result;
  }

  /**
  * get all trip + user + car info
  * @return array data found in all three tables
  */
  public static function getAllDetail(){
    date_default_timezone_set('America/Toronto');
    $current_time = date('Y-m-d h:i:s');
    $sql = "SELECT * FROM posts NATURAL JOIN user u NATURAL JOIN car c NATURAL JOIN trip t WHERE t.trip_depart_time >= '$current_time'";
    $result = DB::query($sql);
    return $result;
  }

  /**
  * get trip + user + car info with specific conditions
  * @return array data found in all three tables
  */
  public static function getAllDetailByCondition($data){
    date_default_timezone_set('America/Toronto');
    $current_time = date('Y-m-d h:i:s');
    $sql = "SELECT * FROM posts NATURAL JOIN user NATURAL JOIN car NATURAL JOIN trip WHERE trip_depart_time between ? AND ? AND trip_price between ? AND ? AND trip_pickup_location = ? AND trip_dropoff_location = ? AND trip_depart_time >= '$current_time'";
    $result = DB::select($sql, $data);
    return $result;
  }

  public static function getAllDetailSortTimeASC(){
    date_default_timezone_set('America/Toronto');
    $current_time = date('Y-m-d h:i:s');
    $sql = "SELECT * FROM posts NATURAL JOIN user u NATURAL JOIN car c NATURAL JOIN trip t WHERE t.trip_depart_time >= '$current_time' ORDER BY t.trip_depart_time ASC";
    $result = DB::query($sql);
    return $result;
  }

  public static function getAllDetailSortPriceASC(){
    date_default_timezone_set('America/Toronto');
    $current_time = date('Y-m-d h:i:s');
    $sql = "SELECT * FROM posts NATURAL JOIN user u NATURAL JOIN car c NATURAL JOIN trip t WHERE t.trip_depart_time >= '$current_time' ORDER BY t.trip_price ASC";
    $result = DB::query($sql);
    return $result;
  }

  public static function getAllDetailSortTimeDESC(){
    date_default_timezone_set('America/Toronto');
    $current_time = date('Y-m-d h:i:s');
    $sql = "SELECT * FROM posts NATURAL JOIN user u NATURAL JOIN car c NATURAL JOIN trip t WHERE t.trip_depart_time >= '$current_time' ORDER BY t.trip_depart_time DESC";
    $result = DB::query($sql);
    return $result;
  }

  public static function getAllDetailSortPriceDESC(){
    date_default_timezone_set('America/Toronto');
    $current_time = date('Y-m-d h:i:s');
    $sql = "SELECT * FROM posts NATURAL JOIN user u NATURAL JOIN car c NATURAL JOIN trip t WHERE t.trip_depart_time >= '$current_time' ORDER BY t.trip_price DESC";
    $result = DB::query($sql);
    return $result;
  }

  public static function getAllDetailByConditionSortASC($data){
    date_default_timezone_set('America/Toronto');
    $current_time = date('Y-m-d h:i:s');
    $sql = "SELECT * FROM posts NATURAL JOIN user NATURAL JOIN car NATURAL JOIN trip WHERE trip_depart_time between ? AND ? AND trip_price between ? AND ? AND trip_pickup_location = ? AND trip_dropoff_location = ? AND trip_depart_time >= '$current_time' ORDER BY ? ASC";
    $result = DB::select($sql, $data);
    return $result;
  }

  public static function getAllDetailByConditionSortDESC($data){
    date_default_timezone_set('America/Toronto');
    $current_time = date('Y-m-d h:i:s');
    $sql = "SELECT * FROM posts NATURAL JOIN user NATURAL JOIN car NATURAL JOIN trip WHERE trip_depart_time between ? AND ? AND trip_price between ? AND ? AND trip_pickup_location = ? AND trip_dropoff_location = ? AND trip_depart_time >= '$current_time' ORDER BY ? DESC";
    $result = DB::select($sql, $data);
    return $result;
  }

  public static function getByUserID($id){
    $sql = "SELECT * FROM posts NATURAL JOIN car NATURAL JOIN user NATURAL JOIN trip WHERE user.user_id = ?";
    $data = array($id);
    $result = DB::select($sql, $data);
    return $result;
  }

}


?>
