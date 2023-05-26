<?php
    interface UserRepository {
        public function create($user);
        public function search($email, $password);
    }