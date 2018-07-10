<?php
require_once('DB.class.php');

/**
* Limit backend interface
*/
class Limit
{

  /**
  * insert into limit table
  * @param  array $data (constraint_id, trip_id)
  * @return int       newly inserted id
  */
  public static function insert($data)
  {
    $sql = "INSERT INTO limits(constraint_id, trip_id) VALUES (?, ?)";
    $result = DB::insert($sql, $data);
    return $result;
  }

}

?>
