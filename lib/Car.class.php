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
}


?>
