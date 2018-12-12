<?php
    session_start();
    include '../inc/functions.php';
    include '../inc/dbConnection.php';
    
    $dbConn = startConnection("final_project");
    
    $movId = $_GET['movId'];
    
    $sql = "SELECT *
            FROM fin_proj_movies
            WHERE movId = $movId";
    
    $stmt = $dbConn->prepare($sql);
    $stmt->execute();
    $record = $stmt->fetch(PDO::FETCH_ASSOC); //fetchAll returns an Array of Arrays
    
    echo json_encode($record);
?>