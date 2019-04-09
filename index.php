<?php 
include 'libs/gotRequest.php';

include 'libs/Socket.php';

$socket = new Socket();
$socket->send('hello world');
?>