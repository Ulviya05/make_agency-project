<?php
include_once __DIR__ . '/../Config/database.php';

class Authorization {
    private $conn;
    public function __construct($conn) {
        $this->conn = $conn;
    }
    public function registerUser($login, $password, $name, $phone) {
        $hashed_password = sha1($password);
        $stmt = $this->conn->prepare("INSERT INTO mydb.users (name, login, phone, password) VALUES (?, ?, ?, ?)");
        if (!$stmt) {
            error_log("prepare failed: " . $this->conn->error);
            return false;
        }
        $stmt->bind_param("ssss", $name, $login, $phone, $hashed_password);
        if ($stmt->execute()) {
            return true;
        } else {
            error_log("execute failed: " . $stmt->error);
            return false;
        }
    }

    public function createProfile($userId, $lang, $firstName, $lastName, $bio, $phoneNumber, $city, $gender, $birthdate, $profileImage) {
        

        $stmt = $this->conn->prepare("INSERT INTO mydb.user_profiles (user_id, lang, first_name, last_name, about_me, phone_number, city, gender, birthdate, profile_image) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        
        $stmt->bind_param("isssssssss", $userId, $lang, $firstName, $lastName, $bio, $phoneNumber, $city, $gender, $birthdate, $profileImage);
        
        if (!$stmt->execute()) {
            error_log("Error inserting new profile: " . $stmt->error);
            return false;
        }
        
        return $stmt->insert_id;
    }

    public function createProduct($title, $category, $price, $old_price, $image_url, $link, $date) {
        $stmt = $this->conn->prepare("INSERT INTO mydb.product_info (product_name, category, price, old_price, main_image,link,date) VALUES (?, ?, ?, ?, ?,?,?)");
        
        $stmt->bind_param("ssdssss", $title, $category, $price, $old_price, $image_url, $link, $date);
        
        if (!$stmt->execute()) {
            error_log("Error inserting new product: " . $stmt->error);
            return false;
        }
        
        return $stmt->insert_id;
    }
    
    

    public function loginUser($login, $password) {
        // $hashed_password = sha1($password);
        $stmt = $this->conn->prepare("SELECT user_id, password FROM mydb.users WHERE login = ?");
        $stmt->bind_param("s", $login);
        $stmt->execute();
        $stmt->bind_result($userId, $hashed_password);
        $stmt->fetch();
        if (isset($hashed_password)) {
            // if (password_verify($password, $hashed_password)) {
            //     return true;
            // } else {
            //     return false;
            // }
            // echo "hashed password: $hashed_password<br>";
            if ($hashed_password == sha1($password)) {
                // echo "hashed password: $hashed_password<br>";
                $_SESSION['user_id'] = $userId;
                error_log("login success");
                return true;
            } else {
                // echo "hashed password: $hashed_password<br>";
                error_log("login failed");
                return false;
            }
        } else {
            return false;
        }
    }
    
    
}
?>





