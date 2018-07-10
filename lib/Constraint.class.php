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

  /**
  * get info from table by id
  * @param  int $id
  * @return array     info returned from SQL query
  */
  public static function getByID($id){
    $sql = "SELECT * FROM constraints WHERE constraint_id = ?";
    $data = array($id);
    $result = DB::select($sql, $data);
    return $result;
  }

}

?>
