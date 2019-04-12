<?php
    include_once '../libs/apiHeaders.php';
    include_once '../libs/db/questions.php';

    $quest = new Questions();

    if (isset($_GET['id'])) {
        echo json_encode($quest->getQuestionByID($_GET['id']));
    } elseif (isset($_GET['type'])) {
        if ($_GET['type'] == 0) {
            echo json_encode($quest->getAll());
        } else {
            echo json_encode($quest->getQuestionByType($_GET['type']));
        }
    } else {
        echo json_encode($quest->getAll());
    }