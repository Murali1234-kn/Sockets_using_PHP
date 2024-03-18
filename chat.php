<?php
// chat.php

$host = '127.0.0.1';
$port = 8080;

$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
socket_connect($socket, $host, $port);

while (true) {
    // Get user input
    $userInput = readline("You: ");
    socket_write($socket, $userInput, strlen($userInput)) or die("Could not write input\n");

    // Read response from chat2.php
    $response = socket_read($socket, 1024) or die("Could not read output\n");
    echo "Chat2: $response\n";
}
?>
