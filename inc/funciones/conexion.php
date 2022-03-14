<?php

$conn = new mysqli('localhost', 'root', '', 'bookmarks');

if($conn->connect_error) echo "Hay un error en la conexión a la base de datos: " . $conn->connect_error ;

$conn->set_charset('utf8');
