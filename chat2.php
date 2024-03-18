<?php
// chat2.php

$host = '127.0.0.1';
$port = 8080;

$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
socket_connect($socket, $host, $port);

while (true) {
    // Read message from chat.php
    $message = socket_read($socket, 1024) or die("Could not read input\n");
    echo "Chat: $message\n";

    // Get user input
    $userInput = readline("You: ");
    socket_write($socket, $userInput, strlen($userInput)) or die("Could not write input\n");
}
?>
