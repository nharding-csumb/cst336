<?php
    include '../../inc/dbConnection.php';
    $dbConn = startConnection("c9");
    
    $rating = $_GET["rating"];
    
    $sql = "UPDATE p11_ratings SET $rating = $rating+1 WHERE id=1";
    
    $stmt = $dbConn->prepare($sql);
    $stmt->execute();
    
    $sql = "SELECT * FROM p11_ratings WHERE id=1";
    
    $stmt = $dbConn->prepare($sql);
    $stmt->execute();
    $record = $stmt->fetch(PDO::FETCH_ASSOC);
    
    echo json_encode($record);
?>