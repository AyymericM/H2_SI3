<?php
    include_once '../libs/apiHeaders.php';
    include_once '../libs/db/questions.php';

    $quest = new Questions();

    if (isset($_GET['id'])) {
        echo stripslashes(json_encode($quest->getQuestionByID($_GET['id'])));
    } else {
        echo stripslashes(json_encode($quest->getAll()));
    }