<?php

    session_start();

    include 'inc/dbConnection.php';
    //$dbConn = startConnection("final_project");
    
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    //$namedParameters = array();
    
    // $sql = "SELECT * FROM om_admin";
    // $sql .= " WHERE username = '$username'";
    // $sql .= " AND password = '$password'";
    
    // $sql = "SELECT * FROM om_admin WHERE 1";
    // // $sql .= " WHERE username = :username";
    // // $sql .= " AND password = :password";
    
    // if(!empty($username)) {
    //     //This SQL prevents SQL INJECTION by using a named parameter
    //     $sql .= " AND username = :username";
    //     //echo $sql;
    //     $namedParameters[':username'] = $username;
    // }
    
    // if(!empty($password)) {
    //     $sql .= " AND password = :password";
    //     //echo $sql;
    //     $namedParameters[':password'] = $password;
    // }
            
    // $stmt = $dbConn->prepare($sql);
    // $stmt->execute($namedParameters);
    // $record = $stmt->fetch(PDO::FETCH_ASSOC); //We're only expecting one record, so we're using Fetch instead of FetchAll
    
    //print_r($record);

    //We'd normally pull from a database for username and password, but since we only want the one we won't for this project.
    if(!$username == "admin" || !$password == "secret") {
        $_SESSION['loginError'] = true;
        header('Location: index.php');
    } else {
        // echo "Welcome ".$record['firstName']." ".$record['lastName'].".";
        $_SESSION['adminFullName'] = $username;
        header('Location: admin.php'); //redirects to another program
    }

?>