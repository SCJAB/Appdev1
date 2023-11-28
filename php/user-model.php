<?php
require $_SERVER["DOCUMENT_ROOT"] . '/Appdev/config/database.php';

class UserModel {
    private $db;
    private $conn;

    public function __construct() {
        $this->db = Database::getInstance();
        $this->conn = $this->db->getConnection();
    }

    public function deleteUser($id) {
        try {
            $sql = "DELETE FROM users WHERE id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("s", $id);
    
            $success = $stmt->execute();
            $stmt->close();
            
            return $success;
        } catch (Exception $e) {
            error_log("An error occurred: " . $e->getMessage());
            return false;
        }
    }

    public function createUser($user) {
        try {
            $stmt = $this->conn->prepare("INSERT INTO users (first_name, last_name, age, email, total_score, depression_level) VALUES (?,?,?,?,?,?)");
            $stmt->bind_param("ssssss", $user->getFirstName(), $user->getLastName(), $user->getAge(), $user->getEmail(), $user->getTotalScore(), $user->getDepressionLvl());
            $success = $stmt->execute();
            $stmt->close();
            
            return $success;
        } catch (Exception $e) {
            error_log("An error occurred: " . $e->getMessage());
            return false;
        }
    } 

    public function viewUser($id) {
        $sql = "SELECT * FROM users WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return null;
        }
    }
    
    public function viewUsers() {
        $sql = "SELECT * FROM users";
        $result = $this->conn->query($sql);
    
        if (!$result) {
            error_log("Error: " . $this->conn->error);
            return [];
        }
    
        $data = [];
    
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    
        $result->close();
        return $data;
    }
}