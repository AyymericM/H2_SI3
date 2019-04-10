<?php

    include_once '../libs/db/users.php';

    $user = new Users();

    if (!empty($_POST['username']) && !empty($_POST['password']) &&
        isset($_POST['username']) && isset($_POST['password']))
    {
        if (empty($user->loginUser($_POST['username'], $_POST['password']))) {
            echo stripslashes(json_encode($user->createUser($_POST['username'], $_POST['password'])));
        } else {
            echo stripslashes(json_encode($user->loginUser($_POST['username'], $_POST['password'])));
        }
    } else {
        echo 'false';
    }