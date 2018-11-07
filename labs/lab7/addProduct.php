<?php
    
    include '../../inc/dbConnection.php';
    $dbConn = startConnection("ottermart");
    include 'inc/functions.php';
    
    if(isset($_GET['submitProduct'])) { //Checks whether form was submitted
        $productName = $_GET['productName'];
        $description = $_GET['description'];
        $price = $_GET['price'];
        $catId = $_GET['catId'];
        
        
    }

?>

<!DOCTYPE html>
<html>
    <head>
        <title> Admin Section: Add New Product</title>
    </head>
    <body>
        
        <h1> Adding New Product </h1>
        
        <form>
           Product name: <input type="text" name="productName"><br>
           Description: <textarea name="description" cols="50" rows="4"></textarea><br>
           Price: <input type="text" name="price"><br>
           Category: 
           <select name="catId">
              <option value="">Select One</option>
              <?php
              
                $categories = getCategories();
                
                foreach($categories as $category) {
                    echo "<option value=\"".$category['catId']."\"";
                    if($_GET['catId'] == "".$category['catId'].""){
                        echo " selected";
                    }
                echo ">".$category['catName']."</option>";
                }
              
              ?>
           </select> <br />
           Set Image Url: <input type="text" name="productImage"><br>
           <input type="submit" name="submitProduct" value="Add Product">
        </form>

    </body>
</html>