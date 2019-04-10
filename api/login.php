<?php
    include_once '../libs/apiHeaders.php';
    include_once '../libs/db/users.php';
    $user = new Users();

    if (!empty($_POST['username']) && !empty($_POST['password']) &&
        isset($_POST['username']) && isset($_POST['password']))
    {
        $try = $user->loginUser($_POST['username'], $_POST['password']);
        if ($try == 'USER_NOT_FOUND') {
            echo stripslashes(json_encode($user->createUser($_POST['username'], $_POST['password'])));
        } elseif ($try == 'WRONG_PASS') {
            echo 'false';
        } else {
            echo stripslashes(json_encode($user->loginUser($_POST['username'], $_POST['password'])));
        }
    } else {
        echo 'false';
    }