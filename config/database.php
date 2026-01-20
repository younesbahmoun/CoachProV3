<?php
// namespace Config;
// use PDO;
// use PDOException;

class Database
{
   private static $instance = null;
   private $connection;

   private function __construct()
   {
      try {
         $this->connection = new PDO(
            "mysql:host=localhost;dbname=coach_platform;charset=utf8",
            "root",
            "",
            [
               PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
               PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]
         );
      } catch (PDOException $e) {
         die("Erreur de connexion : " . $e->getMessage());
      }
   }

   public static function getInstance()
   {
      if (self::$instance === null) {
         self::$instance = new self();
      }
      return self::$instance;
   }

   public function getConnection()
   {
      return $this->connection;
   }
}
// class Database
// {
//    private static ?Database $instance = null;
//    private PDO $connection;

//    private function __construct()
//    {
//       try {
//          $host = "127.0.0.1";
//          $port = "5432";
//          $db   = "coachprov3";
//          $user = "postgres";
//          $pass = "yns1234";

//          $dsn = "pgsql:host=$host;port=$port;dbname=$db";

//          $this->connection = new PDO($dsn, $user, $pass, [
//             PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
//             PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
//          ]);
//       } catch (PDOException $e) {
//          die("Erreur de connexion : " . $e->getMessage());
//       }
//    }

//    public static function getInstance(): self
//    {
//       if (self::$instance === null) {
//          self::$instance = new self();
//       }
//       return self::$instance;
//    }

//    public function getConnection(): PDO
//    {
//       return $this->connection;
//    }
// }