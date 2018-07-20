<?php

/**
* Utility class for DB connection
* Author: Andy Su
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
    $dsn= "mysql:host=$hostname;dbname=$database_name";
    try{
      // create a PDO connection with the configuration data
      self::$connection = new PDO($dsn, $database_user, $database_password);

    }catch (PDOException $e){
      // report error message
      echo $e->getMessage();
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
    self::checkCon();
    try {
      $stmt = self::$connection->prepare($sql);
      if($stmt->execute()){
        return $stmt;
      }else{
        return $stmt->errorInfo();
      }
    } catch (Exception $e) {
      die($e->getMessage());
    }
  }

  public static function select($sql, $bind_param){
    self::checkCon();
    try{
      $stmt = self::$connection->prepare($sql);
      for ($i=0; $i < count($bind_param); $i++) {
        $stmt->bindParam($i+1, $bind_param[$i]);
      }
      if($stmt->execute()){
        return $stmt->fetchAll();
      }else{
        return $stmt->errorInfo();
      }
    }catch(Exception $e){
      // show message if error
      die("message: " . $e->getMessage());
    }finally{
      // close statement object
      unset($stmt);
    }
  }


  public static function insert($sql, $bind_param){
    self::checkCon();
    try{
      $stmt = self::$connection->prepare($sql);
      for ($i=0; $i < count($bind_param); $i++) {
        $stmt->bindParam($i+1, $bind_param[$i]);
      }
      if($stmt->execute()){
        // return the last inserted id if success
        return self::$connection->lastInsertId();
      }else{
        // return error info if no execution
        return $stmt->errorInfo();
      }
    }catch(Exception $e){
      // show message if error
      die("message: " . $e->getMessage());
    }finally{
      // close statement object
      unset($stmt);
    }
  }

  public static function update($sql, $bind_param)
  {
    self::checkCon();
    try{
      $stmt = self::$connection->prepare($sql);
      for ($i=0; $i < count($bind_param); $i++) {
        $stmt->bindParam($i+1, $bind_param[$i]);
      }
      if($stmt->execute()){
        // return true if success
        return true;
      }else{
        // return error info if no execution
        return $stmt->errorInfo();
      }
    }catch(Exception $e){
      // show message if error
      die("message: " . $e->getMessage());
    }finally{
      // close statement object
      unset($stmt);
    }
  }

  public static function delete($sql, $bind_param)
  {
    self::checkCon();
    try{
      $stmt = self::$connection->prepare($sql);
      for ($i=0; $i < count($bind_param); $i++) {
        $stmt->bindParam($i+1, $bind_param[$i]);
      }
      if($stmt->execute()){
        // return true if success
        return true;
      }else{
        // return error info if no execution
        return $stmt->errorInfo();
      }
    }catch(Exception $e){
      // show message if error
      die("message: " . $e->getMessage());
    }finally{
      // close statement object
      unset($stmt);
    }
  }

  public static function checkCon()
  {
    if(self::$connection === null){
      self::init();
    }
  }

}

?>
