<?php

// //Creating database connection
// $host = "localhost";
// $dbname = "ottermart";
// $username = "root";
// $password = "";

// $dbConn = new PDO("mysql:host=$host; dbname=$dbname", $username, $password);
// $dbConn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// $sql = "SELECT * FROM om_category";
// $stmt = $dbConn->prepare($sql);
// $stmt->execute();
// $records = $stmt->fetchAll();
// print_r($records);

include '../../inc/dbConnection.php';

$dbConn = startConnection("ottermart");

function displayCategories() { 
    global $dbConn;
    
    
    $sql = "SELECT * FROM om_category ORDER BY catName";
    $stmt = $dbConn->prepare($sql);
    $stmt->execute();
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
    //print_r($records);
    //echo "<hr>";
    //echo $records[2] . "<br>";
    //echo $records[1]['catDescription'] . "<br>";
    
    foreach ($records as $record) {
        echo "<option value='".$record['catId']."'>" .$record['catName']. "</option>";
    }
}

function filterProducts() {
    global $dbConn;
    
    $keyword = $_GET['productName'];
    // $descSearch = $_GET['productDesc'];
    $category = $_GET['category'];
    $order = $_GET['orderBy'];
    $pFrom = $_GET['priceFrom'];
    $pTo = $_GET['priceTo'];
    
    // //This SQL works but it doesn't prevent SQL INJECTION (due to the single quotes)
    // $sql = "SELECT * FROM om_product 
    //         WHERE productDescription LIKE '%$keyword%' OR productName LIKE '%$keyword%'";
    
    $namedParameters = array();
    
    //This almost works, but not quite.
    $sql = "SELECT * FROM om_product WHERE 1"; //getting all records from database
    //echo $sql;
    
    if(!empty($keyword)) {
        //This SQL prevents SQL INJECTION by using a named parameter
        $sql .= " AND (productName LIKE :keyword OR productDescription LIKE :keyword)";
        //echo $sql;
        $namedParameters[':keyword'] = "%$keyword%";
    }
    
    // //Allowing the user to specifically search the description, as well
    // if(!empty($descSearch)) {
    //     //This SQL prevents SQL INJECTION by using a named parameter
    //     $sql .= " AND (productName LIKE :keyword OR productDescription LIKE :keyword)";
    //     //echo $sql;
    //     $namedParameters[':keyword'] = "%$keyword%";
    // }
    
    if(!empty($category)) {
        $sql .= " AND (catId = :category)";
        //echo $sql;
        $namedParameters[':category'] = $category;
    }
    
    
    //Echo the SQL for debugging purposes
    //echo $sql;
    
    if(isset($order)) {
        if($order == "name") {
            $sql .= " ORDER BY productName";
        }
        
        if($order == "price") {
            $sql .= " ORDER BY price";
        }
    }
    
    //Price range code
    if(!empty($pFrom)) {
        $sql .= " AND price >= :priceFrom";
        $namedParameters[":priceFrom"] = $pFrom;
    }
    
    if(!empty($pTo)) {
        $sql .= " AND price <= :priceTo";
        $namedParameters[":priceTo"] = $pTo;
    }
    
            
    
    $stmt = $dbConn->prepare($sql);
    $stmt->execute($namedParameters);
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($records as $record) {
        
        echo "<a href='productInfo.php?productId=".$record['productId']."'>";
        echo $record['productName'];
        echo "<br /> <br />";
        echo "</a> ";
        echo $record['productDescription'] . " <br /> <br /> $" .  $record['price'] .   "<br /> <hr> <br />";   
        
    }
    
    //print_r($records);
    // foreach ($records as $record) {
    //     echo $record['productName'];
    // }
}


?>

<!DOCTYPE html>
<html>
    <head>
        <title> Lab 6: Ottermart Product Search </title>
        <link href="css/styles.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        
        <h1> Ottermart </h1>
        <h2> Product Search </h2>
        
        <form>
            
            Product: <input type="text" name="productName" placeholder="Product keyword" /> 
            
            <br /> <br />
            
            <!--Product Description: <input type="text" name="productDesc" placeholder="Search product description" /> -->
            
            <!--<br /> <br />-->
            
            Category: 
            <select name="category">
                <option value=""> Select One</option>
                <?=displayCategories();?>
            </select>
            
            <br /> <br />
            
            Price: From <input type="text" name="priceFrom" size="7" />
                   To   <input type="text" name="priceTo" size="7" />
                   
            <br /> <br />
                   
            Order result by: 
            <br />
            
            <input type="radio" name="orderBy" value="price"/> Price <br />
            <input type="radio" name="orderBy" value="name"/> Name
            
            <br /><br/>
            
            <input type="submit" name="submitBtn" value="Search" />
            
            <br /><br/>
            
        </form>
        
        <?php
            if(isset($_GET['productName'])) { 
        ?>
        <div id="displayBlock">
        
            <?php
                filterProducts();
            ?>
        </div>
        <?php
            }
        ?>
        

    </body>
</html>