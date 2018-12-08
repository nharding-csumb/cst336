<?php

    include '../../../inc/dbConnection.php';
    $dbConn = startConnection("c9");
    
    $petId = $_GET['petId'];
    
    $sql = "SELECT * FROM pets WHERE id = ".$petId."";
    
    // $np = array();
    // $np[":petId"] = $petId;
    
    $stmt = $dbConn->prepare($sql);
    $stmt->execute();
    $record = $stmt->fetch(PDO::FETCH_ASSOC);
    
    //print_r($record);
    
    echo json_encode($record);
    
    // function getPetInfo(){
    //     global $dbConn;
        
    //     $sql = "SELECT name, type, id FROM pets ORDER BY name ASC";
        
    //     $stmt = $dbConn->prepare($sql);
    //     $stmt->execute();
    //     $records = $stmt->fetchAll(PDO::FETCH_ASSOC); //We're only expecting one record, so we're using Fetch instead of FetchAll
        
    //     //print_r($records);
        
    //     return $records;
    // }

?>