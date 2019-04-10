<?php
    header("Access-Control-Allow-Origin: *");
    include_once '../libs/db/users.php';

    $user = new Users();

    if (isset($_GET['id'])) {
        echo stripslashes(json_encode($user->getUserByID($_GET['id'])));
    } elseif (isset($_GET['name'])) {
        echo stripslashes(json_encode($user->getUserByID($_GET['name'])));
    } else {
        echo stripslashes(json_encode($user->getAll()));
    }

    if (empty($_GET) && !empty($_POST)) {
        if (isset($_POST['id']) && isset($_POST['score'])) {
            if (!empty($_POST['id']) && !empty($_POST['score'])) {
                echo $user->editUserScore($_POST['id'], $_POST['name']);
            } else {
                echo 'false';
            }
        } else {
            echo 'false';
        }
    }