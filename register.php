<?php
require('headers.php');
require('functions.php');

$json = json_decode(file_get_contents('php://input'));

$fname = filter_var( $json->fname, FILTER_SANITIZE_STRING );
$lname = filter_var( $json->lname, FILTER_SANITIZE_STRING );
$username = filter_var( $json->uname, FILTER_SANITIZE_STRING );
$passwd = filter_var( $json->pwd, FILTER_SANITIZE_STRING );


try{
    $dbcon = getDbConnection();

    createTable($dbcon);

    createUser($dbcon, $fname, $lname, $username, $passwd);

}catch(PDOException $e){
    echo '<br>' .$e->getMessage();
}

?>