<?php
require_once('DB.class.php');

/**
* Location backend interface
* Author: Andy Su
*/
class Location
{

  /**
  * get all locations
  * @return object
  */
  public static function getAll()
  {
    $sql = "SELECT * FROM location";
    $result = DB::query($sql);
    return $result;
  }

}


?>
