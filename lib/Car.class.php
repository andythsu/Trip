<?php
require_once('DB.class.php');

/**
* Car backend interface
* Author: Andy Su
*/
class Car
{
  /**
  * get all cars
  * @return object
  */
  public static function getAll(){
    $sql = "SELECT * FROM car";
    $result = DB::query($sql);
    return $result;
  }

  public static function getByID($id){
    $sql = "SELECT * FROM car WHERE car_id = ?";
    $data = array($id);
    $result = DB::select($sql, $data);
    return $result;
  }
}


?>
