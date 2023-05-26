<?php
    require_once(dirname(__FILE__) . '../../../user/model/user.php');

    class Task {
        private $id = 0;
        private $user = null;
        private $task = '';
        private $finish = 'no';

        public function __construct($id, $user, $task, $finish) {
            $this->id = $id;
            $this->user = $user;
            $this->task = $task;
            $this->finish = $finish;
        }

        public function getId() {
            return $this->id;
        }

        public function getUser() {
            return $this->user;
        }

        public function getTask() {
            return $this->task;
        }

        public function getFinish() {
            return $this->finish;
        }

        public function setId($id) {
            $this->$id;
        }

        public function setUser($user) {
            $this->user = $user;
        }

        public function setTask($task) {
            $this->task = $task;
        }

        public function setFinish($finish) {
            $this->finish = $finish;
        }
    }