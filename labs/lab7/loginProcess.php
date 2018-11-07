<?php

    session_start();

    include '../../inc/dbConnection.php';
    $dbConn = startConnection("ottermart");
    
    $username = $_POST['username'];
    $password = sha1($_POST['password']);
    
    $namedParameters = array();
    
    // $sql = "SELECT * FROM om_admin";
    // $sql .= " WHERE username = '$username'";
    // $sql .= " AND password = '$password'";
    
    $sql = "SELECT * FROM om_admin";
    // $sql .= " WHERE username = :username";
    // $sql .= " AND password = :password";
    
    if(!empty($username)) {
        //This SQL prevents SQL INJECTION by using a named parameter
        $sql .= " WHERE username = :username";
        //echo $sql;
        $namedParameters[':username'] = $username;
    }
    
    if(!empty($password)) {
        $sql .= " AND password = :password";
        //echo $sql;
        $namedParameters[':password'] = $password;
    }
            
    $stmt = $dbConn->prepare($sql);
    $stmt->execute($namedParameters);
    $record = $stmt->fetch(PDO::FETCH_ASSOC); //We're only expecting one record, so we're using Fetch instead of FetchAll
    
    //print_r($record);

    if(empty($record)) {
        echo "Wrong username or password!";
    } else {
        // echo "Welcome ".$record['firstName']." ".$record['lastName'].".";
        $_SESSION['adminFullName'] = $record['firstName'] .  "   "  . $record['lastName'];
        header('Location: admin.php'); //redirects to another program
    }

?>