<?php
    namespace db;

    class Connection {
        private static $instance = null;

        private function __construct() {}

        public static function getInstance() {
            if(self::$instance) {
                return self::$instance;
            }

            try {
                self::$instance = new \PDO(
                    'mysql:host=localhost:3306;dbname=todolist;charset=utf8', 
                    'root',
                    'root',
                    [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION]
                );
    
                return self::$instance;
            } catch(\PDOException $_) {
                die();
            }
        } 
    }