<?php
include_once 'vendor/SocketIO.php';
define('SOCKET_URL', 'localhost');
define('SOCKET_PORT', '1337');

class Socket {
    public function send($data) {
        $client = new SocketIO();
        if ($client->send(SOCKET_URL, SOCKET_PORT, 'message', $data)) {
            return true;
        } else {
            return false;
        }
    }
}