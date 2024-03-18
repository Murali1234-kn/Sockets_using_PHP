<?php
//socket created----------------------------------------------------->
$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);

if ($socket === false)
{
    $error_code = socket_last_error();
    $error_msg = socket_strerror($error_code);
    die("Socket Error: $error_code Message: $error_msg");
}
echo "Socket created successfully\n";
//connect to server-----------------------------------
$socket_connect = socket_connect($socket, '127.0.0.1', 80);

if ($socket_connect === false)
{
    $error_code1 = socket_last_error();
    $error_msg1 = socket_strerror($error_code1);
    die("Socket Error: $error_code1 Message: $error_msg1");
}

echo "Connection Established\n";

// Close the socket
//socket_close($socket);
$message = "GET / HTTP/8.8\r\n\r\n";

//Sending  data---------------------------------------------
$socket_send = socket_send( $socket , $message , strlen($message) , 0);

if($socket_send === FALSE)
{
    $errorcode = socket_last_error();
    $errormsg = socket_strerror($errorcode);

    die("Could not send data: [$errorcode] $errormsg \n");
}

echo "send successfully \n";

$socket_recv = socket_recv($socket,$var,2045,MSG_WAITALL);
if($socket_recv === FALSE)
{

    $errorcode = socket_last_error();
    $errormsg = socket_strerror($errorcode);

    die("Could not Receive data: [$errorcode] $errormsg \n");

}
print_r($var);
socket_close($socket);
?>
