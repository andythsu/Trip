<?php
require_once('DB.class.php');

/**
* Rating backend interface
* Author: Andy Su
*/
class Rating
{

  public static function insert($user_id, $score){
    $sql = "INSERT INTO rating (rating_score, user_id) VALUES (?, ?)";
    $data = array($score, $user_id);
    $result = DB::insert($sql, $data);
    return $result;
  }

}


?>
