<?php
    session_start();
    
    include 'inc/dbConnection.php';
    $dbConn = startConnection("final_project");
    include 'inc/functions.php';
    validateSession();
    
    $id = $_POST['movId'];
    
    // echo "$id";
    
    // echo $_POST['movId'];
    
    $sql = "SELECT title, ratingId FROM fin_proj_movies WHERE movId=".$id;
    //echo "$sql";
    $stmt = $dbConn->prepare($sql);
    $stmt->execute();
    $record = $stmt->fetch(PDO::FETCH_ASSOC);
    //print_r($record);
    
    $rating = $record['ratingId'];
    
    $sql = "DELETE FROM fin_proj_movies WHERE movId=".$id;
    //echo "$sql";
    $stmt = $dbConn->prepare($sql);
    $stmt->execute();
    //print_r($record);
    
    $sql = "UPDATE fin_proj_rating SET movList = REPLACE(movList, :mov, '') WHERE ratingId =". $record['ratingId'];
    //echo "$sql";
    //print_r($record);
    
    $np2 = array();
    $np2[":mov"] = $record['title'] . ", ";
    //print_r($np2);
    
    $stmt = $dbConn->prepare($sql);
    $stmt->execute($np2);
    
    header("Location: admin.php");



?>