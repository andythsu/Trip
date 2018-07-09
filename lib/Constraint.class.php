<?php
require_once('DB.class.php');

/**
* Constraint backend interface
*/
class Constraint
{

  /**
  * get all constraints
  * @return object
  */
  public static function getAll(){
    $sql = "SELECT * FROM constraints";
    $result = DB::query($sql);
    return $result;
  }

}

?>
