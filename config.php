<?php

$dbname = 'crud_php';
$host = 'localhost:4306';
$dbuser = 'root';
$dbpass = 'your_password';


try {
    $db = new PDO("mysql:dbname=" . $dbname . ";host=" . $host. ";port=4306", $dbuser, $dbpass);
} catch (PDOException $e) {
    echo "Erro" . $e->getMessage();
    exit();
}
define('BASE_URL', 'http://localhost/Locadora De Bikes/');
?>