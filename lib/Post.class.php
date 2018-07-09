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

}


?>
