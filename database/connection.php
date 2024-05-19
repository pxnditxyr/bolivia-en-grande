<?php

class DatabaseConnection {
  public static function getPDOConnection(): PDO {
    $host = 'bolivia_en_grande_mysql';
    $db   = 'bolivia_en_grande';
    $user = 'root';
    $pass = '';
    $charset = "utf8mb4";

    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    $options = [
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
      PDO::ATTR_EMULATE_PREPARES => false,
    ];
    return new PDO( $dsn, $user, $pass, $options );
  }
}
