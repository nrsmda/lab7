<?php
class Database {
    private static $pdo = null;

    public static function connect() {
        if (self::$pdo === null) {
            try {
                self::$pdo = new PDO('mysql:host=localhost;dbname=crudsystem', 'matric', 'password');
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die('Error: ' . $e->getMessage());
            }
        }
        return self::$pdo;
    }
}

class crudsystem {
    private static $conn = null;

    public static function connect() {
        if (self::$conn === null) {
            try {
                self::$conn = new PDO('mysql:host=localhost;dbname=crudsystem', 'matric', 'password');
                self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo 'Connection failed: ' . $e->getMessage();
            }
        }
        return self::$conn;
    }
    public static function selectData() {
        $conn = Database::connect();
        $stmt = $conn->prepare('SELECT * FROM users');
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function delete($matric) {
        $conn = Database::connect();
        $stmt = $conn->prepare('DELETE FROM users WHERE matric = :matric');
        $stmt->bindParam(':matric', $matric);
        return $stmt->execute();
    }

    public function update($matric, $name, $password, $role) {
        $conn = Database::connect();
        $stmt = $conn->prepare('UPDATE users SET name = :name, password = :password, role = :role WHERE matric = :matric');
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':role', $role);
        $stmt->bindParam(':matric', $matric);
        return $stmt->execute();
    }
}
?>