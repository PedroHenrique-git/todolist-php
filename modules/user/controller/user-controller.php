<?php
    require_once(dirname(__FILE__) . '../../repository/relational-db/user-repository-relational-db.php');
    require_once(dirname(__FILE__) . '../../../../exceptions/repository-exception.php');
    require_once(dirname(__FILE__) . '../../validation/create-user-validation.php');
    require_once(dirname(__FILE__) . '../../../../utils/start-session.php');
    require_once(dirname(__FILE__) . '../../../../db/connection.php');
    require_once(dirname(__FILE__) . '../../../../utils/hash.php');
    require_once(dirname(__FILE__) . '../../model/user.php');

    class UserController {
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
        }

        public function create() {
            \utils\startSession();

            unset($_SESSION['create-account']['errors']);

            try {
                $email = htmlspecialchars($_POST['email']);
                $password = htmlspecialchars($_POST['password']);

                $hasErrors = createAccountValidation($email, $password);

                if($hasErrors) {
                    header('Location: /modules/user/view/create-account.php');

                    return;
                }

                $this->repository->create(
                    new User(0, $email, \utils\hash($password))
                );

                http_response_code(200);
                header('Location: /index.php');
            } catch(RepositoryException $err) {
                http_response_code(500);

                $_SESSION['create-account']['errors']['catch'] = $err->getMessage();

                header('Location: /modules/user/view/create-account.php');
            }
        }
    }

    $action = $_GET['action'];
    $pdo = \db\Connection::getInstance();
    $repository = new UserRepositoryRelationalDb($pdo);

    new UserController($action, $repository);