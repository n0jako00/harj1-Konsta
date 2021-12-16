<?php
session_start();
require('headers.php');
require('functions.php');

if(isset($_SESSION["user"])){
    $dbcon = getDbConnection();
    $user = $_SESSION["user"];
    $sql = "SELECT infotext FROM info WHERE uname = '$user'";
    
    $query = $dbcon->query($sql);
    $results = $query->fetchAll(PDO::FETCH_ASSOC);

    foreach($results as $result){
        echo $result["infotext"];
        
    }
    
    exit;


}

header('WWW-Authenticate: Basic');
exit;


?>