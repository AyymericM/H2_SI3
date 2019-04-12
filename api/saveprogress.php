<?php
    include_once '../libs/apiHeaders.php';
    include_once '../libs/db/db.php';
    
    if (isset($_POST['type']) &&
        isset($_POST['answer']) &&
        isset($_POST['userid']))
    {
        $uprep = null;
        if ($_POST['type'] == 1) {
            $uprep = $pdo->prepare("UPDATE users SET progression_1 = progression_1 + :answer WHERE id=:userid");
        } else {
            $uprep = $pdo->prepare("UPDATE users SET progression_2 = progression_2 + :answer WHERE id=:userid");
        }

        
        $uprep->bindValue('answer', (int)$_POST['answer']);
        $uprep->bindValue('userid', $_POST['userid']);
        $uprep->execute();

        echo 'true';
    } else {
        echo 'false';
    }