<?php
    include_once '../libs/db/db.php';
    include_once '../libs/db/users.php';
    include_once '../libs/db/question.php';

    $user = new Users();
    $question = new Questions();

    if (isset($_POST['type']) &&
        isset($_POST['index']) &&
        isset($_POST['answer']) &&
        isset($_POST['questid']) &&
        isset($_POST['userid']))
    {
        $u = $user->getUserByID($_POST['userid']);
        if (json_decode($u->progression)) {
            # code...
        }
        $uprep = $pdo->prepare('UPDATE progression FROM users WHERE id=?');

        echo 'true';
    } else {
        echo 'false';
    }