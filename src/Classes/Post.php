<?php


namespace App\Classes;


class Post extends Db
{
    public function insertPost($post,$email) {
        $sql = "INSERT INTO posts (post, email) VALUES (?,?)";
        $stmt = $this->connect()->prepare($sql);
        $stmt->bindValue(1,$post);
        $stmt->bindValue(2, $email);
        $stmt->execute();
        return true;
    }

    public function viewAll(){
        $sql = "SELECT * FROM posts ORDER BY (id) DESC LIMIT 5";
        $stmt = $this->connect()->query($sql);
        return $stmt->fetchAll();
    }
}