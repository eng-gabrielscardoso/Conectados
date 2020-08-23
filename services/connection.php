<?php

class Connection
{
  private static $connection;

  private function __construct()
  {
  }

  public static function getConnection()
  {

    date_default_timezone_set('America/Sao_Paulo');

    define('DB_HOST', "locahost");

    define('DB_USER', "id14630259_dbconectados");

    define('DB_PASSWORD', "1-Recode2020");

    define('DB_NAME', "`id14630259_dbconectado`");

    define('DB_DRIVER', "mysql");

    $pdoConfig = DB_DRIVER . ":" . "Server=" . DB_HOST . ";";

    $pdoConfig .= "Database=" . DB_NAME . ";";

    try {

      if (!isset($connection)) {

        $connection = new PDO($pdoConfig, DB_USER, DB_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      }

      return $connection;
    } catch (PDOException $e) {

      $mensagem = "Drivers disponiveis: " . implode(",", PDO::getAvailableDrivers());

      $mensagem .= "\nErro: " . $e->getMessage();

      throw new Exception($mensagem);
    }
  }
}
