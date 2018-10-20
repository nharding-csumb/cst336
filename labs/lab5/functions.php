<?php

    function displayResults() {
        global $items;
        
        //Make sure $items actually exists, or this'll cause an error
        if(isset($items)) {
            
            //Creating a table
            echo "<table class='table'>";
            
            foreach ($items as $item) {
                //Putting them in variables to avoid having to concatenate strings later
                $itemName = $item['name'];
                $itemPrice = $item['salePrice'];
                $itemImage = $item['thumbnailImage'];
                $itemId = $item['itemId'];
                
                //Displaying things as a table
                echo "<tr>";
                echo "<td> <img src='$itemImage'> </td>";
                echo "<td> <h4>$itemName</h4> </td>";
                echo "<td> <h4>$$itemPrice</h4> </td>";
                
                
                //Hidden elements
                echo "<form method='POST'>";
                echo "<input type='hidden' name='itemName' value='$itemName'>";
                echo "<input type='hidden' name='itemPrice' value='$itemPrice'>";
                echo "<input type='hidden' name='itemImage' value='$itemImage'>";
                echo "<input type='hidden' name='itemId' value='$itemId'>";
                
                //Check to see if the item we added is the most recent POST itemId
                //and change button accordingly
                if ($_POST['itemId'] == $itemId) {
                    echo "<td> <button class='btn btn-success'> Added </button> </td>";
                } else {
                    echo "<td> <button class='btn btn-warning'> Add </button> </td>";
                }
                echo "</form>";
                
                
                echo "</tr>";
            }
            echo "</table>";
        }
    }
    
    function displayCart () {
        
        if(isset($_SESSION['cart'])) {
            //Creating a table
            echo "<table class='table'>";
        
            foreach ($_SESSION['cart'] as $item) {
                //Putting them in variables to avoid having to concatenate strings later
                $itemName = $item['name'];
                $itemPrice = $item['price'];
                $itemImage = $item['image'];
                $itemId = $item['id'];
                $itemQuant = $item['quantity'];
                
                //Displaying things as a table
                echo "<tr>";
                echo "<td> <img src='$itemImage'> </td>";
                echo "<td> <h4>$itemName</h4> </td>";
                echo "<td> <h4>$$itemPrice</h4> </td>";
                
                //Form for updating quantity
                echo "<form method='POST'>";
                echo "<input type='hidden' name='updateId' value='$itemId'>";
                echo "<td> <input type='text' name='update' class='form-control' placeholder='$itemQuant'>";
                echo "<td> <button class='btn btn-danger'> Update </button> </td>";
                echo "</form>";
                
                
                //Hidden elements for removal
                echo "<form method='POST'>";
                echo "<input type='hidden' name='removeId' value='$itemId'>";
                echo "<td> <button class='btn btn-warning'> Remove </button> </td>";
                echo "</form>";
                
                
                echo "</tr>";
            }
            echo "</table>";
        }
    }
    
    function displayCartCount() {
        echo count($_SESSION['cart']);
    }

?>