<?php
    include_once '../libs/apiHeaders.php';
    include_once '../libs/db/users.php';

    $u = new Users();

    echo json_encode($u->getLeaderboard());