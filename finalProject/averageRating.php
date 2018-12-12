<?php
    session_start();
    
    include 'inc/dbConnection.php';
    $dbConn = startConnection("final_project");
    
    include 'inc/functions.php';
    
    $sql = "SELECT ratingId FROM fin_proj_movies WHERE 1";
    $stmt = $dbConn->prepare($sql);
    $stmt->execute();
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>