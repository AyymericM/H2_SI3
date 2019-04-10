<?php

    include_once '../libs/db/users.php';

    $user = new Users();

    if (!empty($_POST['username']) && !empty($_POST['password']) &&
        isset($_POST['username']) && isset($_POST['password']))
    {
        echo stripslashes(json_encode($user->loginUser($_POST['username'], $_POST['password'])));
    } else {
        echo 'false';
    }
    