<?php


function checkUser(PDO $dbcon, $username, $passwd){
    try{
        $sql = "SELECT passw FROM user WHERE uname=?";
        $prepare = $dbcon->prepare($sql);
        $prepare->execute(array($username));

        $rows = $prepare->fetchAll();

        foreach($rows as $row){
            $pw = $row["passw"];
            if( password_verify($passwd, $pw) ){
                return true;
            }
        }

        return false;

    }catch(PDOException $e){
        echo '<br>'.$e->getMessage();
    }
}




function createUser($dbcon, $fname, $lname, $username, $passwd){
    try{
        $hash_pw = password_hash($passwd, PASSWORD_DEFAULT);
        $sql = "INSERT IGNORE INTO user VALUES (?,?,?,?)";
        $prepare = $dbcon->prepare($sql);
        $prepare->execute(array($fname, $lname, $username, $hash_pw));
    }catch(PDOException $e){
        echo '<br>'.$e->getMessage();
    }
}


    function createTable($con){
        $sql = "CREATE TABLE IF NOT EXISTS user(
            fname varchar(50) NOT NULL,
            lname varchar(50) NOT NULL,
            uname varchar(50) NOT NULL,
            passw varchar(50) NOT NULL,
            PRIMARY KEY (username)
            )";

        $sql_add = "INSERT IGNORE INTO user VALUES ('Konsta', 'Jäske', 'Konosta', 'salasana')";

        try{        

            $con->exec($sql);
        }catch(PDOException $e){
            echo '<br>'.$e->getMessage();
        }
    }

    function getDbConnection(){
        try{
            $db = new PDO('mysql:host=localhost;dbname=n0jako00', 'root', '');
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e){
            echo '<br>'.$e->getMessage();
        }
    
        return $db;
    }