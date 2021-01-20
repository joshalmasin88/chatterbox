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
        $sql = "SELECT * FROM posts INNER JOIN users ON posts.email=users.email ORDER BY posts.post_id DESC";
        $stmt = $this->connect()->query($sql);
        return $stmt->fetchAll();
    }

    public function deletePost($id,$email) {
        $sql = "DELETE FROM posts WHERE post_id = ? AND email = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->bindValue(1,$id);
        $stmt->bindValue(2, $email);
        $stmt->execute();
        return true;
    }

    public function editpost($post, $id, $username) {
        $sql = "UPDATE posts SET post = ? WHERE post_id = ? AND username = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->bindValue(1, $post);
        $stmt->bindValue(2, $id);
        $stmt->bindValue(3, $username);
        $stmt->execute();
        return true;
    }
}