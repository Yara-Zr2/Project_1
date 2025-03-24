<?php
class DB {
    private $pdo;
    protected $stmt;

    public function __construct($db = "beyond_dnd", $host = "localhost", $user = "root", $pass = "") {
        try {
            $this->pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Connection error: " . $e->getMessage());
        }
    }

    public function execute($sql, $placeholders = []) {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($placeholders);
        return $stmt;
    }
    
    public function getPDO() {
        return $this->pdo;
    }
}
?>
