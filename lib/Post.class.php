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
    $sql = "SELECT * FROM posts NATURAL JOIN user u NATURAL JOIN car c NATURAL JOIN trip t";
    $result = DB::query($sql);
    return $result;
  }

  /**
  * get trip + user + car info with specific conditions
  * @return array data found in all three tables
  */
  public static function getAllDetailByCondition($data){
    $sql = "SELECT * FROM posts NATURAL JOIN user NATURAL JOIN car NATURAL JOIN trip WHERE trip_depart_time between ? AND ? AND trip_price = ? AND trip_pickup_location = ? AND trip_dropoff_location = ?";
    $result = DB::select($sql, $data);
    return $result;
  }

  public static function getAllDetailSortTimeASC(){
    $sql = "SELECT * FROM posts NATURAL JOIN user u NATURAL JOIN car c NATURAL JOIN trip t ORDER BY t.trip_depart_time ASC";
    $result = DB::query($sql);
    return $result;
  }

  public static function getAllDetailSortPriceASC(){
    $sql = "SELECT * FROM posts NATURAL JOIN user u NATURAL JOIN car c NATURAL JOIN trip t ORDER BY t.trip_price ASC";
    $result = DB::query($sql);
    return $result;
  }

  public static function getAllDetailSortTimeDESC(){
    $sql = "SELECT * FROM posts NATURAL JOIN user u NATURAL JOIN car c NATURAL JOIN trip t ORDER BY t.trip_depart_time DESC";
    $result = DB::query($sql);
    return $result;
  }

  public static function getAllDetailSortPriceDESC(){
    $sql = "SELECT * FROM posts NATURAL JOIN user u NATURAL JOIN car c NATURAL JOIN trip t ORDER BY t.trip_price DESC";
    $result = DB::query($sql);
    return $result;
  }

  public static function getAllDetailByConditionSortASC($data){
    $sql = "SELECT * FROM posts NATURAL JOIN user NATURAL JOIN car NATURAL JOIN trip WHERE trip_depart_time between ? AND ? AND trip_price = ? AND trip_pickup_location = ? AND trip_dropoff_location = ? ORDER BY ? ASC";
    $result = DB::select($sql, $data);
    return $result;
  }

  public static function getAllDetailByConditionSortDESC($data){
    $sql = "SELECT * FROM posts NATURAL JOIN user NATURAL JOIN car NATURAL JOIN trip WHERE trip_depart_time between ? AND ? AND trip_price = ? AND trip_pickup_location = ? AND trip_dropoff_location = ? ORDER BY ? ASC";
    $result = DB::select($sql, $data);
    return $result;
  }

}


?>
