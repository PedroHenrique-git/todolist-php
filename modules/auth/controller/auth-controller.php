<?php
    require_once(dirname(__FILE__) . '../../../user/repository/relational-db/user-repository-relational-db.php');
    require_once(dirname(__FILE__) . '../../../../utils/hash.php');
    require_once(dirname(__FILE__) . '../../../../utils/start-session.php');
    require_once(dirname(__FILE__) . '../../../../db/connection.php');
    require_once(dirname(__FILE__) . '../../../user/repository/relational-db/user-repository-relational-db.php');
    require_once(dirname(__FILE__) . '../../../../db/connection.php');

    class AuthController {
        private $action = '';
        private $repository = null;

        public function __construct($action, $repository) {
            $this->action = $action;
            $this->repository = $repository;

            $this->init();
        }

        public function init() {
            if($this->action === 'login') {
                $this->login();
            }

            if($this->action === 'logout') {
                $this->logout();
            }
        }

        public function login() {
            \utils\startSession();

            try {
                $email = htmlspecialchars($_POST['email']);
                $password = htmlspecialchars($_POST['password']);

                $user = $this->repository->search($email, \utils\hash($password));

                $_SESSION['user_id'] = $user['id'];
                $_SESSION['email'] = $user['email'];

                http_response_code(200);
                header('Location: /index.php');
            } catch(RepositoryException $err) {
                http_response_code(500);

                $_SESSION['auth']['errors']['catch'] = $err->getMessage();

                header('Location: /modules/auth/view/login.php');
            }
        }

        public function logout() {
            \utils\startSession();

            session_unset();
            session_destroy();

            header('Location: /index.php');
        }
    }

    $action = $_GET['action'];
    $pdo = \db\Connection::getInstance();
    $repository = new UserRepositoryRelationalDb($pdo);

    new AuthController($action, $repository);