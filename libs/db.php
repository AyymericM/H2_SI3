<?php

    define('DB_HOST', 'localhost');
    define('DB_PORT', '8889');
    define('DB_NAME', 'h2si3');
    define('DB_USER', 'root');
    define('DB_PASS', '');

    class DB
    {   
        public function db()
        {
            try {
                $pdo = new PDO(
                    'mysql:dbname='.DB_NAME.';host='.DB_HOST.';post='.DB_PORT,
                    DB_USER,
                    DB_PASS
                );
                $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return $pdo;
            } catch (PDOException $e) {
                die('Sa marche pas, tpeu maider ???<br /><br />vla mon erreur:<br /><br />'.$e);
            }
        }

        public function createUser(String $name, Int $score)
        {
            if ($name && $score) {
                $query = $this->db()->prepare('INSERT INTO users(username, best_score) VALUES (:name, :score)');
                $query->bindValue('name', $name);
                $query->bindValue('score', $score);
                $query->execute();
                return true;
            } else {
                return false;
            }
        }

        public function getUsers()
        {
            $query = $this->db()->query("SELECT * FROM users");
            return $query->fetchAll();
        }

        public function getUserByID(Int $uid)
        {
            $query = $this->db()->query("SELECT * FROM users WHERE id=$uid");
            return $query->fetch();
        }

        public function getUserByName(String $uname)
        {
            $query = $this->db()->query("SELECT * FROM users WHERE username='$uname'");
            return $query->fetch();
        }

        public function editUserScore(Int $uid, Int $score)
        {
            if ($uid && $score) {                
                $query = $this->db()->prepare("UPDATE users SET best_score=? WHERE id=? ");
                $query->execute([$score, $uid]);
                return true;
            } else {
                return false;
            }
        }
    }
