<?php
//$Socket = socket_create_listen(8080);
//
//if ($Socket === false) {
//    $error_code = socket_last_error();
//    $error_msg = socket_strerror($error_code);
//    die("Error creating listening socket: : $error_code Message: $error_msg");
//}
//
//echo "Socket created and listening on port 8080\n";
//
//$Client_Socket = socket_accept($Socket);
//
//if ($Client_Socket === false) {
//    $error_code = socket_last_error();
//    $error_msg = socket_strerror($error_code);
//    die("Error acceptt listening socket: : $error_code Message: $error_msg");
//}
//
//echo "Connection accepted from client\n";
//
//socket_close($Client_Socket);
//socket_close($Socket);


socket_create_pair(AF_INET, SOCK_STREAM, 0, $Sockets);
list($socket1, $socket2) = $Sockets;

$data = "Hello, sockets!";
socket_write($socket1, $data, strlen($data));

$Data1 = socket_read($socket2, 1024);
echo "Received data from socket pair: $Data1\n";

socket_close($socket1);
socket_close($socket2);

?>
