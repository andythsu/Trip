<?php

/**
* Utility class for DB connection
*/
class DB
{

  private $connection;

  function __construct()
  {
    $this->init();
  }

  public function init()
  {
    include 'config.php';
    extract($config);
    $this->connection = mysqli_connect($hostname, $database_user, $database_password, $database_name);
    if (mysqli_connect_error()) {
      die(mysqli_connect_error());
    }
  }
  public function query($sql)
  {
    if (!$result = mysqli_query($this->connection, $sql)) {
      die(mysqli_error($this->connection));
      return false;
    }
    return $result;
  }
}


?>
