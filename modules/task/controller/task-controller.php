<?php
    require_once(dirname(__FILE__) . '../../../../utils/start-session.php');
    require_once(dirname(__FILE__) . '../../../../exceptions/repository-exception.php');
    require_once(dirname(__FILE__) . '../../model/task.php');
    require_once(dirname(__FILE__) . '../../../user/model/user.php');
    require_once(dirname(__FILE__) . '../../repository/relational-db/task-repository-relational-db.php');
    require_once(dirname(__FILE__) . '../../../../db/connection.php');

    class TaskController {
        private $action = '';
        private $repository = null;

        public function __construct($action, $repository) {
            $this->action = $action;
            $this->repository = $repository;

            $this->init();
        }

        public function init() {
            if($this->action === 'create') {
                $this->create();
            }

            if($this->action === 'showTasks') {
                $this->showTasks();
            }
        }

        public function showTasks() {
            \utils\startSession();

            try {
                $tasks = $this->repository->show();

                $_SESSION['tasks'] = $tasks;

                http_response_code(200);
                header('Location: /modules/task/view/show-tasks.php');
            } catch(RepositoryException $err) {
                http_response_code(500);

                $_SESSION['show-tasks']['errors']['catch'] = $err->getMessage();

                header('Location: /index.php');
            }
        }

        public function create() {
            \utils\startSession();

            try {
                $task = htmlspecialchars($_POST['task']);
                $finish = htmlspecialchars($_POST['finish']);
                $userId = $_SESSION['user_id'];

                $user = new User(intval($userId), '', '');
                $task = new Task(0, $user, $task, $finish);

                $this->repository->create($task);

                http_response_code(200);
                header('Location: /index.php');
            } catch(RepositoryException $err) {
                http_response_code(500);

                $_SESSION['create-task']['errors']['catch'] = $err->getMessage();

                header('Location: /modules/task/view/create-task.php');
            }
        }
    }

    $action = $_GET['action'];
    $pdo = \db\Connection::getInstance();
    $repository = new TaskRepositoryRelationalDb($pdo);

    new TaskController($action, $repository);