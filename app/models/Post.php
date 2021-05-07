<?php

class Post
{

    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getPosts($user_id = "")
    {
        $this->db->query(
            "SELECT *, p.id as 'postId', u.id as 'userId', p.created_at as 'postCreatedAt' FROM posts p JOIN users u on p.user_id = u.id ORDER BY p.created_at ASC"
        );
        $results = $this->db->resultSet();

        return $results;
    }
    public function getPostById($id){
        $this->db->query("SELECT *, p.id as 'postId', u.id as 'userId', p.created_at as 'postCreatedAt' FROM posts p JOIN users u on p.user_id = u.id WHERE p.id = :id");
        $this->db->bind(':id', $id);

        $row = $this->db->single();

        return $row;
    }
    public function titleExists($title)
    {
        $this->db->query("SELECT * FROM posts WHERE title = :title");
        $this->db->bind(':title', $title);

        $row = $this->db->single();

        // check rows
        return $this->db->rowCount() > 0;
    }
    public function addPost($data,  $uploadLocation = "", $tmpName = "")
    {
        $user_id = $_SESSION["user_id"];
        // $this->db->transactionStart();
        $this->db->query("INSERT INTO posts (
                user_id, title, image_path
            ) VALUES (
                :user_id, :title, :image_path
            )");
        $this->db->bind(':user_id', $user_id);
        $this->db->bind(':title', $data["title"]);
        $this->db->bind(':image_path', $data["image_path"]);

        $executed = $this->db->execute();
        $fileMoved = false;
        if($executed && $data["image_path"] !== "no_image.jpg"){
            $fileMoved = move_uploaded_file($tmpName, $uploadLocation);
            return $fileMoved ? "moved" : "error";
        }
        if($executed){
            return "executed";
        }
        return "error";
        
    }
    public function updatePostWithImage($data,  $uploadLocation = "", $tmpName = "")
    {
        // print_r($data);echo "<br>";
        // print_r($uploadLocation);echo "<br>";
        // print_r($tmpName);echo "<br>";
        // die("Update with image");
        // $this->db->transactionStart();
        $this->db->query("UPDATE posts SET title = :title, image_path = :image_path WHERE id = :id");
        $this->db->bind(':id', $data['post_id']);
        $this->db->bind(':title', $data["title"]);
        $this->db->bind(':image_path', $data["image_path"]);

        $executed = $this->db->execute();
        $fileMoved = false;
        if($executed){
            $fileMoved = move_uploaded_file($tmpName, $uploadLocation);
            return $fileMoved ? "moved" : "error";
        }
        if($executed){
            return "executed";
        }
        return "error";
        
    }
    public function updatePostWithoutImage($data)
    {
        die("Update without image");
        // $this->db->transactionStart();
        $this->db->query("UPDATE posts SET title = :title WHERE id = :id");
        $this->db->bind(':id', $data['post_id']);
        $this->db->bind(':title', $data["title"]);

        $success =  $this->db->execute();

        return $success ? 'executed' : 'error';
    }
    public function deletePost($id){
        $this->db->query('DELETE FROM posts WHERE id = :id');
        $this->db->bind(':id', $id);

        return $this->db->execute();
    }
}
