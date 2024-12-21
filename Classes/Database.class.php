<?php
final class Database
{
    private static $driver = 'mysql';  
    private static $host = "localhost"; 
    private static $dbName = "produto"; 
    private static $username = "root";
    private static $password = "root"; 
    private static $charset = 'utf8mb4';  

    public static $port = 3306; 
    private static $pdo = null; 
    private static $error; 
    
    private static function connect()
    {
        if (self::$pdo === null) {
            if (self::$driver === 'mysql') {
                $dsn = "mysql:host=" . self::$host . ";port=" . self::$port . ";dbname=" . self::$dbName . ";charset=" . self::$charset;
            } elseif (self::$driver === 'pgsql') {
                $dsn = "pgsql:host=" . self::$host . ";port=" . self::$port . ";dbname=" . self::$dbName;
            } else {
                throw new Exception("Driver de banco de dados não suportado: " . self::$driver);
            }

            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, 
                PDO::ATTR_PERSISTENT => false, 
                PDO::ATTR_EMULATE_PREPARES => false 
            ];

            try {
                self::$pdo = new PDO($dsn, self::$username, self::$password, $options);
            } catch (PDOException $e) {
                self::$error = $e->getMessage();
                echo "Erro na conexão: " . self::$error;
            }
        }
        return self::$pdo;
    }

    public static function query($sql)
    {
        $pdo = self::connect();
        if ($pdo) {
            return $pdo->query($sql);
        }

        return false;
    }

    public static function prepare($sql)
    {
        $pdo = self::connect();
        if ($pdo) {
            return $pdo->prepare($sql);
        }

        return false;
    }

    public static function setDriver($driver)
    {
        self::$driver = $driver;
    }
}
