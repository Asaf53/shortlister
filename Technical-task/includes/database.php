<?php
$host = 'localhost:3308';
$db = 'shortlister';
$dsn = "mysql:host=$host;dbname=$db;";
$username = 'root';
$password = '';
$pdo = new PDO($dsn, $username, $password);
