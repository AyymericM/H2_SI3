<?php

    // define('DB_HOST', 'localhost');
    // define('DB_PORT', '8889');
    // define('DB_NAME', 'h2si3');
    // define('DB_USER', 'root');
    // define('DB_PASS', '');

    define('DB_HOST', 'localhost');
    define('DB_PORT', '3306');
    define('DB_NAME', 'h2si3');
    define('DB_USER', 'phpmyadmin');
    define('DB_PASS', 'phpccaca');

    class Users
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

        public function createUser(String $username, String $password)
        {
            if ($username && $password) {
                $query = $this->db()->prepare('INSERT INTO users(username, password) VALUES (:username, :password)');
                $query->bindValue('username', $username);
                $query->bindValue('password', md5($password));
                $query->execute();
                return $this->getUserByName($username);
            } else {
                return false;
            }
        }

        public function loginUser(String $username, String $password)
        {
            $hashedpass = md5($password);
            $query = $this->db()->query("SELECT * FROM users WHERE username='$username'");
            $user = $query->fetch();
            if (!empty($user->id)) {
                if ($user->password == $hashedpass) {
                    return [
                        "id" => $user->id,
                        "username" => $user->username,
                        "progression_1" => $user->progression_1,
                        "progression_2" => $user->progression_2,
                        "unlocked_badges" => json_decode($user->unlocked_badges)
                    ];
                } else {
                    return 'WRONG_PASS';
                }
            } else {
                return 'USER_NOT_FOUND';
            }
        }

        public function getAll()
        {
            $query = $this->db()->query("SELECT id, username, progression_1, progression_2, unlocked_badges FROM users");
            return $query->fetchAll();
        }

        public function getUserByID(Int $uid)
        {
            $query = $this->db()->query("SELECT id, username, progression_1, progression_2, unlocked_badges FROM users WHERE id=$uid");
            return $query->fetch();
        }

        public function getUserByName(String $uname)
        {
            $query = $this->db()->query("SELECT id, username, progression_1, progression_2, unlocked_badges FROM users WHERE username='$uname'");
            return $query->fetch();
        }

        public function editUserScore(Int $uid, Int $score)
        {
            if ($uid && $score) {                
                $query = $this->db()->prepare("UPDATE users SET progression=? WHERE id=? ");
                $query->execute([$score, $uid]);
                return true;
            } else {
                return false;
            }
        }

        public function getLeaderboard()
        {
            $query = $this->db()->query("SELECT
                username, SUM(progression_1+progression_2)
            FROM
                users
            ORDER BY
                SUM(progression_1+progression_2)");
            return $query->fetchAll();
        }
    }
