<?php
    interface TaskRepository {
        public function create($task);
        public function show($userId);
    }