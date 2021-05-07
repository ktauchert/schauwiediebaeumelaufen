<?php

class Pages extends Controller {
    
    public function __construct()
    {
        // $this->postModel = $this->model('Post');
    }

    public function index()
    {
        if(isLoggedIn()){
            redirect('posts');
        }
        $data = [
            "title" => "Welcome"
        ];
        $this->view('pages/index', $data);
    }
    public function impressum()
    {
        $data = [
            "title" => "Impressum"
        ];
        $this->view('pages/impressum', $data);
    }
}