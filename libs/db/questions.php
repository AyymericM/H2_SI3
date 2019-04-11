<?php

    define('DB_HOST', 'localhost');
    define('DB_PORT', '8889');
    define('DB_NAME', 'h2si3');
    define('DB_USER', 'root');
    define('DB_PASS', '');

    class Questions
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

        public function getAll()
        {
            $query = $this->db()->query("SELECT * FROM questions");
            return $query->fetchAll();
        }

        public function getQuestionByID(Int $qid)
        {
            $query = $this->db()->query("SELECT * FROM questions WHERE id=$qid");
            return $query->fetch();
        }

        public function getQuestionByType(Int $type)
        {
            $query = $this->db()->query("SELECT * FROM questions WHERE type=$type");
            return $query->fetchAll();
        }
    }