<?php
require_once('DB.class.php');
/**
* Trip backend interface
* Author: Andy Su
*/
class Trip
{

  /**
  * insert a trip data into database
  * @param  array (pickup_time, price, dropoff_loc_id, $pickup_loc_id)
  * @return int   newly inserted id
  */
  public static function insert($data)
  {
    $sql = "INSERT INTO trip (trip_depart_time, trip_price, trip_dropoff_location, trip_pickup_location) VALUES (?, ?, ?, ?)";
    $result = DB::insert($sql, $data);
    return $result;
  }

  /**
  * get trip info by id
  * @param  int $id trip id
  * @return array   associated trip info
  */
  public static function getByID($id){
    $sql = "SELECT * FROM trip WHERE trip_id = ?";
    $data = array($id);
    $result = DB::select($sql, $data);
    return $result;
  }

  public static function getAll(){
    $sql = "SELECT * FROM trip";
    $result = DB::query($sql);
    return $result;
  }

  public static function deleteByID($id){
    $sql = "DELETE FROM trip WHERE trip_id = ?";
    $data = array($id);
    $result = DB::delete($sql, $data);
    return $result;
  }

}


?>
