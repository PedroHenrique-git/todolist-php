<?php
    require_once (dirname(__FILE__) . '../../task-repository.php');
    require_once (dirname(__FILE__) . '../../../../../exceptions/repository-exception.php');

    class TaskRepositoryRelationalDb implements TaskRepository {
        private $db = null;

        public function __construct($db) {
            $this->db = $db;
        }

        public function show($userId) {
            try {
                $sql = 'SELECT t.task as task, t.finish as finish from task t inner join user u on(u.id=t.user_id) where t.user_id = ?';

                $ps = $this->db->prepare($sql);
                
                $ps->execute([
                    $userId
                ]);

                return $ps->fetchAll(PDO::FETCH_ASSOC);
            } catch(RepositoryException $err) {
                throw new RepositoryException('Error when try to get tasks', 500, $err);
            }
        }

        public function create($task) {
            try {
                $sql = 'INSERT INTO task(user_id, task, finish) values(?, ?, ?)';    

                $ps = $this->db->prepare($sql);

                $ps->execute([
                    $task->getUser()->getId(),
                    $task->getTask(),
                    $task->getFinish()
                ]);

                return true;
            } catch(PDOException $err) {
                throw new RepositoryException('Error when try to create a new task', 500, $err);
            }
        }
    }