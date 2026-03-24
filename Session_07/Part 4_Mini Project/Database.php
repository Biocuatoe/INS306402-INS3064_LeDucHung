<?php
class Database {
    private static $instance = null;
    private $connection;

    private function __construct() {
        $dsn = "mysql:host=localhost;dbname=ecommerce_db;charset=utf8mb4";
        $options =[
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];
        
        // Complete the PDO connection logic here
        try {
            // Update 'root' and '' to match your local database credentials if needed
            $this->connection = new PDO($dsn, 'root', '', $options);
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }

    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->connection;
    }
}
?>