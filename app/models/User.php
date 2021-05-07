<?php

    class User{

        private $db;

        public function __construct()
        {
            $this->db = new Database;
        }

        // Find user by email
        public function findUserByEmail($email){
            $this->db->query("SELECT id FROM users WHERE email = :email");
            $this->db->bind(':email', $email);

            $row = $this->db->single();

            // check rows
            return $this->db->rowCount() > 0;
        }

        public function register($data){
            $this->db->query("INSERT INTO users (
                name, email, password
            ) VALUES (
                :name, :email, :password
            )");

            $this->db->bind(':name', $data["name"]);
            $this->db->bind(':email', $data["email"]);
            $this->db->bind(':password', $data["password"]);

            return $this->db->execute();
        }

        public function login($email, $password)
        {
            $this->db->query(
                "SELECT * from users WHERE email = :email"
            );
            $this->db->bind(':email', $email);
            $row = $this->db->single();
            $password_verified = password_verify(
                $password, $row->password
            );
            if($password_verified){
                return $row;
            } else {
                return FALSE;
            }
        }
    }