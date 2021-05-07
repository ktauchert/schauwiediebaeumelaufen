<?php

/**
 * Base Controller
 * Loads the Models and views
 */

    class Controller{
        
        // load model
        public function model($model){
            // require model file
            require_once $_SERVER['DOCUMENT_ROOT'] . '/app/models/'.$model.'.php';

            // // Instantiate model
            return new $model();
        }

        // load view
        public function view($view, $data = []){
            // Check for view file
            if(file_exists($_SERVER['DOCUMENT_ROOT'] . '/app/views/'.$view.'.php')){
                require_once $_SERVER['DOCUMENT_ROOT'] . '/app/views/'.$view.'.php';
            } else {
                // View does not exist
                die("View does not exist");
            }
        }
    }