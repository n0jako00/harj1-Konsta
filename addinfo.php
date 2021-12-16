<?php
session_start();
require('headers.php');
require('functions.php');

if(isset($_SESSION["user"])){
    $json = json_decode(file_get_contents('php://input'));
    $info = filter_var( $json->info, FILTER_SANITIZE_STRING );
    $dbcon = getDbConnection();
    $user = $_SESSION["user"];
    $sql = "INSERT INTO info (uname, infotext) VALUES (?, ?)";

    $prepare = $dbcon->prepare($sql);
    $prepare->execute(array($user, $info));

    echo "Tietoa lisätty!";
    exit;
    
}

header('WWW-Authenticate: Basic');
exit;


?>