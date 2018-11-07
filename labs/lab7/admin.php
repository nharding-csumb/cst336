<?php
    session_start();
    
    include '../../inc/dbConnection.php';
    $dbConn = startConnection("ottermart");
    
    include 'inc/functions.php';

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