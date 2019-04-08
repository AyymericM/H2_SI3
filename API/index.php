<?php 
echo('Hello world !');
include 'libs/Socket.php';

$socket = new Socket();
$socket->send('hello world');
?>