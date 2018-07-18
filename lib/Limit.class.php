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

  /**
  * returns all constraint ids associated with trip id
  * @param  int $trip_id
  * @return array all constraints
  */
  public static function getConstraintsByTripID($trip_id){
    $sql = "SELECT * FROM limits NATURAL JOIN constraints WHERE trip_id = ?";
    $data = array($trip_id);
    $result = DB::select($sql, $data);
    return $result;
  }
  
}

?>
