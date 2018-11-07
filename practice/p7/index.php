<?php
    include '../../inc/dbConnection.php';

    $dbConn = startConnection("c9");
    
    function categoryForm() {
        global $dbConn;
        
        $sql = "SELECT category FROM p1_quotes";
        $stmt = $dbConn->prepare($sql);
        $stmt->execute();
        $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        //print_r($records);
        
        $categories = array();
        foreach($records as $record) {
            if(!isset($categories["".$record['category'].""])) {
                $categories["".$record['category'].""] = $record['category'];
                
                echo "<option value=\"".$record['category']."\"";
                    if($_GET['category'] == "".$record['category'].""){
                        echo " selected";
                    }
                echo ">".$record['category']."</option>";
            }
        }
    }
    
    function displayQuote() {
        global $dbConn;
        
        $keyword = $_GET['keyword'];
        $order = $_GET['order'];
        $category = $_GET['category'];
        
        $namedParameters = array();
        $sql = "SELECT * from p1_quotes WHERE 1";
        
        if(!empty($keyword)) {
            //This SQL prevents SQL INJECTION by using a named parameter
            $sql .= " AND quote LIKE :keyword";
            //echo $sql;
            $namedParameters[':keyword'] = "%$keyword%";
        }
        
        if(!empty($category)) {
            //This SQL prevents SQL INJECTION by using a named parameter
            $sql .= " AND category LIKE :category";
            //echo $sql;
            $namedParameters[':category'] = "$category";
        }
        
        if(isset($order)) {
            if($order == "0") {
                $sql .= " ORDER BY quote ASC";
            }
            
            if($order == "1") {
                $sql .= " ORDER BY quote DESC";
            }
        }
        
        
        $stmt = $dbConn->prepare($sql);
        $stmt->execute($namedParameters);
        $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        foreach($records as $record){
            echo "".$record['quote']." (<em>".$record['author']."</em>) <br /> <br />";
        }
    }


?>

<!DOCTYPE html>
<html>
    <head>
        <title> Quote Finder </title>
        <style>@import url("css/styles.css");</style>
    </head>
    <body>
    
        <div id="headerBlock">
        <h1> Famous Quote Finder </h1>
        </div>
        
        <br />
        
        <form method="GET">
            
            Enter Quote Keyword <input type="text" name="keyword" size="15" placeholder="Enter keyword" value="<?=$_GET['keyword']?>" />
            
            <br /> <br />
            
            Category: <select name="category">
                <option value=""
                <?php
                    if($_GET['category'] == ""){
                        echo "selected";
                    }
                ?>
                >--Select One--</option>
                
                <?php
                  categoryForm();  
                ?>
    
            </select>
            
            <br /> <br />
            
            Order <br />
            <input type="radio" name="order" value="0"
            <?php
                if($_GET['order'] == "0") {
                    echo " checked";
                }
            ?>
            > A-Z <br />
            <input type="radio" name="order" value="1"
            <?php
                if($_GET['order'] == "1") {
                    echo " checked";
                }
            ?>
            > Z-A <br />
            
            <br />
            
            <input type="submit" name = "submitBtn" value="Display Quotes">
            
            <br /> <br />
            
            
        </form>
        <div id ="quoteBlock">
        <?php
            displayQuote();
        ?>
        </div>

    </body>
</html>