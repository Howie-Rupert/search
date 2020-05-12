<?php
$dbname = 'test';
$dbuser = 'root';
$dbpwd = 'Ww@123456';
$charset = 'utf8mb4';

$pdo = new PDO('mysql:host=localhost;dbname=' . $dbname . ';charset=' . $charset, $dbuser, $dbpwd, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
]);
return $pdo;