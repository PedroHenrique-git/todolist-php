<?php
    function createAccountValidation($email, $password) {
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['create-account']['errors']['email'] = 'Email invalid'; 
        }

        if(mb_strlen($password) < 8) {
            $_SESSION['create-account']['errors']['password'] = 'Password must be at least eight characters long'; 
        }

        return isset($_SESSION['create-account']['errors']) && count($_SESSION['create-account']['errors']) > 0;
    }