<?php
    require_once (dirname(__FILE__) . '../../user-repository.php');
    require_once (dirname(__FILE__) . '../../../../../exceptions/repository-exception.php');

    class UserRepositoryRelationalDb implements UserRepository {
        private $db = null;

        public function __construct($db) {
            $this->db = $db;
        }

        public function search($email, $password) {
            try {
                $sql = 'SELECT id, email FROM user WHERE email = ? and password = ?';

                $ps = $this->db->prepare($sql);

                $ps->execute([
                    $email,
                    $password
                ]);

                if($ps->rowCount() < 1) {
                    throw new RepositoryException('Email or password invalid', 400);    
                }

                return $ps->fetch(PDO::FETCH_ASSOC);
            } catch(RepositoryException $err) {
                throw new RepositoryException('Error when try to search an user', 500, $err);       
            }
        }

        public function create($user) {
            try {
                $sql = 'INSERT INTO user(email, password) values(?, ?)';

                $ps = $this->db->prepare($sql);

                $ps->execute([
                    $user->getEmail(),
                    $user->getPassword()
                ]);

                return true;
            } catch(PDOException $err) {
                throw new RepositoryException('Error when try to create a new user', 500, $err);
            }
        }
    }