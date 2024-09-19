<?php

    define('HOST', 'localhost');
    define('USER', 'root');
    define('PASS', '1234');
    define('BASE', 'dbempresa');

    $conn = new mysqli(HOST, USER, PASS, BASE);
    if ($conn -> connect_error){
        die("Conexão falhou: ". $conn->connect_error);
    }
?>