<?php
$user = 'user'; 
$psw = 'root';
$host = 'mysql';
$dbname = 'Mvc'; 

try {
    
    $dbh = new PDO("mysql:host=$host;dbname=$dbname", $user, $psw); 
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
} catch (PDOException $e) {
    echo 'Connexion impossible : ' . $e->getMessage();
}
?>