<?php
    header('Access-Control-Allow-Origin: *');
    include '../../inc/dbConnection.php';
    $dbConn = startConnection("ottermart");
    

    if(!empty($_GET["ans"])) {
        $sql = "UPDATE poll";
        
        if($_GET["ans"] == 0) {
            $sql .= " SET yes = yes + 1";
        } else if ($_GET["ans"] == 1) {
            $sql .= " SET no = no + 1";
        } else {
            $sql .= " SET maybe = maybe + 1";
        }
        
        $sql .= " WHERE id = 1";
        
        //echo "$sql";
        
        $stmt = $dbConn->prepare($sql);
        $stmt->execute();
    }
    
    
    
    $sql = "SELECT * FROM poll WHERE id = 1";
   
    
    $stmt = $dbConn->prepare($sql);
    $stmt->execute();
    $record = $stmt->fetch(PDO::FETCH_ASSOC);
    
    // print_r($record);
    echo json_encode($record);

?>