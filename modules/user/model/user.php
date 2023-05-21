<?php
    class User {
        private $id = 0;
        private $email = '';
        private $password = '';

        public function __construct($id, $email, $password) {
            $this->id = $id;
            $this->email = $email;
            $this->password = $password;
        }

        public function getId() {
            return $this->id;
        }

        public function getEmail() {
            return $this->email;
        }

        public function getPassword() {
            return $this->password;
        }

        public function setId($id) {
            $this->id = $id;
        }

        public function setEmail($email) {
            $this->email = $email;
        }

        public function setPassword($password) {
            $this->password = $password;
        }
    }