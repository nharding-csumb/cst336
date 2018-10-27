<?php
    session_start();
    
    include '../../inc/dbConnection.php';
    $dbConn = startConnection("ottermart");
    
    function displayAllProducts() {
        global $dbConn;
        
        $sql = "SELECT * FROM om_product ORDER BY productName";
        $stmt = $dbConn->prepare($sql);
        $stmt->execute();
        $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        foreach($records as $record) {
            
            echo "[<a href='updateProduct.php'>Update</a>] ";
            echo "[<a href='deleteProduct.php'>Delete</a>] ";
            
            echo "".$record['productName']." - $".$record['price']." <br /> <br />";
        }
        
    }

?>

<!DOCTYPE html>
<html>
    <head>
        <title> Admin Main Page </title>
    </head>
    <body>
        
        <h1> ADMIN SECTION - OTTERMART </h1>
        
         <h3>Welcome <?= $_SESSION['adminFullName'] ?> </h3>
         
         
         <br /><br />
         
         <form action="addProduct.php">
              <input type="submit" value="Add New Product">
         </form>
         
         <form action="logout.php">
              <input type="submit" value="Logout">
         </form>
         
         <br /><br />
         
         <?= displayAllProducts(); ?>

    </body>
</html>