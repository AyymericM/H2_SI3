<?php
    include_once '../libs/apiHeaders.php';
    include_once '../libs/db/questions.php';

    $quest = new Questions();

    if (isset($_GET['id'])) {
        echo json_encode($quest->getQuestionByID($_GET['id']));
    } else {
        echo json_encode($quest->getAll());
    }