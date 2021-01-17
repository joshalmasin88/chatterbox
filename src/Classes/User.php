<?php


namespace App\Classes;


class User extends Db
{
    public function userExist($email) {
        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->bindValue(1,$email);
        $stmt->execute();
        return $stmt->rowCount();
    }
    public function register($email, $password, $profileImg) {
        $checkUser = $this->userExist($email);
        if($checkUser > 0){
            $_SESSION['registerErrors'] = "User already exists";
            return false;
        }
        $hashpass = password_hash($password, PASSWORD_BCRYPT);
        $sql = "INSERT INTO users (email, password, profileImg) VALUES (?,?,?)";
        $stmt = $this->connect()->prepare($sql);
        $stmt->bindValue(1, $email);
        $stmt->bindValue(2, $hashpass);
        $stmt->bindValue(3, $profileImg);
        if($stmt->execute()) return true;
        return false;
    }

    public function login($email, $password) {

        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->bindValue(1, $email);
        $stmt->execute();
        $row = $stmt->fetch();
        if(!$row){
            $_SESSION['loginErrors'] = "No such user";
            return false;
        }
        if(password_verify($password, $row['password'])){
            $_SESSION['userActive'] = true;
            $_SESSION['email'] = $email;
            $_SESSION['userId'] = $row['id'];
            header("Location: home.php");
        } else {
            $_SESSION['loginErrors']  = "Incorrect Credentials";
            return false;
        }
    }

    public function getUser($email) {
        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->bindValue(1,$email);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function deleteUser($email) {
        $sql = "DELETE users , posts FROM users INNER JOIN posts ON posts.email = users.email WHERE users.email = ? ";
        $stmt = $this->connect()->prepare($sql);
        $stmt->bindValue(1,$email);
        $stmt->execute();
    }
}