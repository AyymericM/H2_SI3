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