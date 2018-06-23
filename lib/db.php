<?php

/**
* Utility class for DB connection
*/
class DB
{

  public static $connection;

  function __construct()
  {
    self::init();
  }

  public static function init()
  {
    include 'config.php';
    extract($config);
    self::$connection = mysqli_connect($hostname, $database_user, $database_password, $database_name);
    if (mysqli_connect_error()) {
      die(mysqli_connect_error());
    }
  }
  public static function getCon()
  {
    if(self::$connection !== null) {
      return self::$connection;
    }else{
      self::init();
      return self::$connection;
    }
  }
  public static function query($sql)
  {
    if (!$result = mysqli_query(self::$connection, $sql)) {
      die(mysqli_error(self::$connection));
      return false;
    }
    return $result;
  }

}


?>
