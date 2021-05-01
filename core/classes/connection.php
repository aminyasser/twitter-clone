<?php

// try for connect with class

class Connect {
    protected static $servername = "localhost";
    protected static $db_name="twitter";
    protected static $username = "root";
    protected static $password = "";
    protected static $pdo;
    public function __construct() { }

      // this is try to use self function in connect to make login easier with :: operator

    public static function connect() {
         $servername =self::$servername;
         $db_name = self::$db_name;
        try {
            $conn = new PDO("mysql:host=$servername;dbname=$db_name", self::$username, self::$password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
          //   echo "Connected successfully";
            } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            }
        
            return $conn;
    }

}


