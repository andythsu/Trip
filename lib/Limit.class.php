<?php
require_once('DB.class.php');

/**
* Limit backend interface
*/
class Limit
{

  public static function insert($data)
  {
    $sql = "INSERT INTO limits(constraint_id, trip_id) VALUES (?, ?)";
    $result = DB::insert($sql, $data);
    return $result;
  }

}

?>
