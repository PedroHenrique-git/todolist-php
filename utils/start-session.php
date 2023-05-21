<?php
    namespace utils;

    function startSession() {
        session_set_cookie_params(1 * 60 * 60 * 24 * 7, '/', 'localhost', true, true);
        session_start();
    }