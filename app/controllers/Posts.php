<?php

class Posts extends Controller
{

    public function __construct()
    {
        // All functionality for is now restricted to logged in user
        
        $this->postModel = $this->model('Post');
    }

    public function index()
    {
        // Get posts
        $posts = $this->postModel->getPosts();
        // $posts = ["hi" => "mööp"];
        $data = [
            "title" => "Beiträge",
            "posts" => $posts
        ];
        $this->view('posts/index', $data);
    }

    // ADD a post
    public function add()
    {
        if (!isLoggedIn()) {
            redirect('users/login');
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize post
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $fileEmpty = empty($_FILES["image"]['name']) ? 'no_image.jpg' : '';
            $uploadFileName = "";
            $uploadLocation = "";

            $data = [
                "title" => trim($_POST["title"]),
                "image_path" => $fileEmpty,
                "title_error" => "",
                "image_error" => ""
            ];

            // Check Title Errors
            if(empty($data["title"])){
                $data["title_error"] = "Bitte gib einen Text ein!";
            }

            // check image file
            if($data["image_path"] !== "no_image.jpg"){
                if(!isImage($_FILES["image"])){
                    // no image file
                    $data["image_error"] = "Die Datei ist keine Bilddatei";
                } else {
                    $fileExtension = strtolower(pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION));
                    $uploadFileName = getUploadFileName($_FILES["image"]);
                    $uploadLocation = getUploadLocation($uploadFileName);
                    if(file_exists($uploadLocation)){
                        $data["image_error"] = "Diese Datei existiert schon! Ändere eventuell vorher den Dateinamen.";
                    }
                    if(!isCorrectSize($_FILES["image"])){
                        $data["image_error"] = "Die Bilddatei ist zu groß.";
                    }
                    if(!isCorrectExtension($fileExtension)){
                        $data["image_error"] = "Nur .jpg, .jpeg, .png, .gif sind erlaubt!";
                    }

                    if(!$data["image_error"]){
                        $data["image_path"] = $uploadFileName;
                    }
                }
            }
            
            if(empty($data["title_error"]) && empty($data["image_error"])){
                $success = $this->postModel->addPost($data, $uploadLocation, $_FILES['image']['tmp_name']);
                // die($success);
                if($success === "executed" || $success === "moved"){
                    flash('post_message', 'Dein Beitrag wurde erstellt!');
                    redirect('posts');
                } else {
                    flash('post_message', 'Dein Beitrag konnte nicht erstellt werden, probiere es noch ein Mal, oder melde dich beim Administrator!', 'alert alert-danger');
                    redirect('posts');
                }
            } else {
                $this->view('posts/add', $data);
            }
            // Example output getimagesize: 
            // Array ( [0] => 1249 [1] => 927 [2] => 3 [3] => width="1249" height="927" [bits] => 8 [mime] => image/png )
        } else {
            $data = [
                "title" => ""
            ];
            $this->view('posts/add', $data);
        }
    }

    // show image oage
    public function show($id)
    {
        $post = $this->postModel->getPostById($id);

        $data = [
            "post" => $post
        ];

        $this->view('posts/show', $data);
    }

    public function edit($id)
    {
        if (!isLoggedIn()) {
            redirect('users/login');
        }
        $post = $this->postModel->getPostById($id);
        $oldImagePath = $post->image_path;

        if($post->user_id !== $_SESSION["user_id"]) redirect('posts');

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize post
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $isNewImage = false;
            $fileEmpty = empty($_FILES["image"]['name']) ? 'no_image.jpg' : '';
            $uploadFileName = "";
            $uploadLocation = "";
            $updateImage = FALSE;

            $data = [
                "post_id" => $post->postId,
                "user_id" => $post->userId,
                "title" => trim($_POST["title"]),
                "image_path" => $fileEmpty,
                "title_error" => "",
                "image_error" => ""
            ];

            // Check Title Errors
            if(empty($data["title"])){
                $data["title_error"] = "Bitte gib einen Text ein!";
            }

            // check image file
            if($data["image_path"] !== "no_image.jpg"){
                if(!isImage($_FILES["image"])){
                    // no image file
                    $data["image_error"] = "Die Datei ist keine Bilddatei";
                } else {
                    $fileExtension = strtolower(pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION));
                    $uploadFileName = getUploadFileName($_FILES["image"]);
                    $uploadLocation = getUploadLocation($uploadFileName);

                    if($oldImagePath !== $uploadFileName){
                        // update to new Image
                        // if(file_exists($uploadLocation)){
                        //     $data["image_error"] = "Diese Datei existiert schon! Ändere eventuell vorher den Dateinamen.";
                        // }
                        if(!isCorrectSize($_FILES["image"])){
                            $data["image_error"] = "Die Bilddatei ist zu groß.";
                        }
                        if(!isCorrectExtension($fileExtension)){
                            $data["image_error"] = "Nur .jpg, .jpeg, .png, .gif sind erlaubt!";
                        }

                        if(!$data["image_error"]){
                            $data["image_path"] = $uploadFileName;
                        }
                        $updateImage = TRUE;
                    } else {
                        // no image Update
                        $updateImage = FALSE;
                    }
                }
            }
            
            if(empty($data["title_error"]) && empty($data["image_error"])){
                if($updateImage){
                    $success = $this->postModel->updatePostWithImage($data, $uploadLocation, $_FILES['image']['tmp_name']);
                } else {
                    $success = $this->postModel->updatePostWithoutImage($data);
                }
                // $success = $this->postModel->addPost($data, $uploadLocation, $_FILES['image']['tmp_name']);
                // die($success);
                if($success === "executed" || $success === "moved"){
                    flash('post_message', 'Dein Beitrag wurde bearbeitet!');
                    redirect('posts');
                } else {
                    flash('post_message', 'Dein Beitrag konnte nicht bearbeitet werden, probiere es noch ein Mal, oder melde dich beim Administrator!', 'alert alert-danger');
                    redirect('posts');
                }
            } else {
                $this->view('posts/edit', $data);
            }
            // Example output getimagesize: 
            // Array ( [0] => 1249 [1] => 927 [2] => 3 [3] => width="1249" height="927" [bits] => 8 [mime] => image/png )
        } else {
            $data = [
                "post_id" => $post->postId,
                "user_id" => $post->userId,
                "title" => $post->title,
                "image_path" => $post->image_path 
            ];
            $this->view('posts/edit', $data);
        }
    }
    public function delete($id)
    {
        if (!isLoggedIn()) {
            redirect('users/login');
        }
        $post = $this->postModel->getPostById($id);
        if($post->user_id !== $_SESSION["user_id"]) redirect('posts');
        
        if($_SERVER["REQUEST_METHOD"] === 'POST'){
            if($this->postModel->deletePost($id)){
                flash('post_message', 'Der Beitrag wurde gelöscht', 'alert alert-warning');
                redirect('posts');
            } else {
                die("Something went wrong");
            }
        } else {
            redirect('posts');
        }
    }
}
