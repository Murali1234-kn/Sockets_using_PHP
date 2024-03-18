<?php

$Socket = socket_create(AF_INET, SOCK_STREAM, 0);

if ($Socket === false) {
    $errorcode = socket_last_error();
    $errormsg = socket_strerror($errorcode);
    die("Socket creation failed: [$errorcode] $errormsg\n");
}
echo "Socket created successfully\n";

if (!socket_bind($Socket, '127.0.0.1', 8085))
{
    $errorcode = socket_last_error();
    $errormsg = socket_strerror($errorcode);
    die("Socket bind failed: [$errorcode] $errormsg\n");
}
echo "socket binds";
if (!socket_listen($Socket)) {
    $errorcode = socket_last_error();
    $errormsg = socket_strerror($errorcode);
    die("Socket listen failed: [$errorcode] $errormsg\n");
}
echo "socket listining";
 // Accept a connection

    $Client_Socket = socket_accept($Socket);
    echo "socket_accept";
    if ($Client_Socket === false) {
        $errorcode = socket_last_error();
        $errormsg = socket_strerror($errorcode);
        die("Socket accept failed: [$errorcode] $errormsg\n");
    }

    // Get the remote address and port --clients addr and port
    if (socket_getpeername($Client_Socket, $Address, $Port)) {
        echo "Client connected from $Address:$Port\n";
    } else {
        echo "Failed cliient socket.\n";
    }

    // Get the local address and port--- server addr and port
    if (socket_getsockname($Socket, $Address, $Port)) {
        echo "Server bound to $Address:$Port\n";
    } else {
        echo "Failed  server socket.\n";
    }

    $welcomeMessage = "Welcome to the server!\n";
    socket_write($Client_Socket, $welcomeMessage, strlen($welcomeMessage));

    if (socket_set_nonblock($Client_Socket)) {
        echo "Client socket is in non-blocking mode.\n";

        //  non-blocking mode
        $Data = socket_read($Client_Socket, 1024);
        if ($Data === false) {
            $errorcode = socket_last_error();
            $errormsg = socket_strerror($errorcode);
            die("Non-blocking read failed [$errorcode] $errormsg\n");
        } else {
            echo "Non-blocking read data: $Data\n";
        }
        // Set the client socket back to blocking mode
        if (socket_set_block($Client_Socket)) {
            echo "Client socket is in blocking mode.\n";

            $Data = socket_read($Client_Socket, 1024);

            if ($Data === false) {
                $errorcode = socket_last_error();
                $errormsg = socket_strerror($errorcode);
                die("Blocking read failed: [$errorcode] $errormsg\n");
            } else {
                echo "Blocking read data: $Data\n";
            }
            socket_close($Client_Socket);
        }

}
socket_close($Socket);
?>
