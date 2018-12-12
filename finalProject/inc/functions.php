<?php

    function validateSession(){
        if (!isset($_SESSION['adminFullName'])) {
            header("Location: index.php");  //redirects users who haven't logged in 
            exit;
        }
    }

    function displayAllProducts() {
        global $dbConn;
        
        $sql = "SELECT * FROM fin_proj_movies ORDER BY title";
        $stmt = $dbConn->prepare($sql);
        $stmt->execute();
        $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        echo "<table class='table'>";
        foreach ($records as $record) {
            // echo "<a class='btn btn-primary' role='button' href='updateProduct.php?productId=".$record['productId']."'>Update</a>     ";
            // //echo "[<a href='deleteProduct.php?productId=".$record['productId']."'>Delete</a>]";
            // echo "<form action='deleteProduct.php' onsubmit='return confirmDelete()'>";
            // echo "   <input type='hidden' name='movId' value='".$record['movId']."'>";
            // echo "   <button class='btn btn-outline-danger' type='submit'>Delete</button>";
            // echo "</form>     ";
            
            // echo "<a 
            
            // onclick='openModal()' target='productModal'
            // href='productInfo.php?productId=".$record['productId']."'>".$record['productName']."</a>  ";
            // echo " $" . $record[price]   . "<br><br>";
            
            
            
            //Putting them in variables to avoid having to concatenate strings later
            $itemName = $record['title'];
            $itemDirector = $record['director'];
            $itemActors = $record['actors'];
            $itemImage = $record['image'];
            $itemId = $record['movId'];
            $itemRating = $record['ratingId'];
            $itemYear = $record['year'];
            
            echo "<tr>";
            
            //display data for item
            echo "<td><img src ='" .$itemImage. "' width=50></td>";
            echo "<td><h4> <a href='#' class='movLink' id='".$record['movId']."'> ".$itemName." </a> </h4></td>";
            // echo "<td><h4>" .$itemDirector. "</h4></td>";
            // echo "<td><h4>" .$itemActors. "</h4></td>";
            echo "<td><h4>" .$itemRating. " Stars</h4></td>";
            
            //update for this item
            echo '<form method = "post" action="updateProduct.php">';
            echo "<input type ='hidden' name='movId' value ='$itemId'>";
            echo '<td><button class = "btn btn-primary">Update</button></td>';
            echo '</form>';
            
            //deletion
            //echo "<td>$itemId </td>";
            echo "<form method='POST' action='deleteProduct.php' onsubmit='return confirmDelete()'>";
            echo "   <input type='hidden' name='movId' value='".$itemId."'>";
            echo "   <td><button class='btn btn-outline-danger' type='submit'>Delete</button></td>";
            echo "</form>";
        
            echo '</tr>';
        }
        echo "</table>";
        
        // foreach($records as $record) {
            
        //     echo "[<a href='updateProduct.php'>Update</a>] ";
        //     echo "[<a href='deleteProduct.php'>Delete</a>] ";
            
        //     echo "".$record['productName']." - $".$record['price']." <br /> <br />";
        // }
        
    }
    
    function getCategories() {
        global $dbConn;
        
        $sql = "SELECT * FROM fin_proj_genres ORDER BY genName";
        
        $stmt = $dbConn->prepare($sql);
        $stmt->execute();
        $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        //print_r($records);
        
        return $records;
    }
    
    
    function getProductInfo($movId) {
        global $dbConn;
        
        $sql = "SELECT * FROM fin_proj_movies WHERE movId = $movId";
        $stmt = $dbConn->prepare($sql);
        $stmt->execute();
        $record = $stmt->fetch(PDO::FETCH_ASSOC);  
        
        return $record;
    }
    
    function loginProblem() {
        if(isset($_SESSION['loginError'])) {
            unset($_SESSION['loginError']);
            return true;
        }
        
        return false;
    }
    
    function filterMovies() {
        global $dbConn;
        $movie = $_GET['movieName'];
        
        if(isset($_GET['searchForm'])) {
            
            echo "<h3>Movies Found: </h3>";
            
            $namedParameters = array();
            //$product = $_GET['productName'];
            
            //This SQL works but it doesn't prevent SQL injection (due to single quotes)
            //$sql = "SELECT * FROM om_product 
            //       WHERE productName LIKE '%$product%'";
            
            $sql = "SELECT * FROM fin_proj_movies WHERE 1"; //Getting all records from database
            
            if(!empty($movie)){
                //This SQL prevents SQL INJECTION by using a named parameter 
                $sql .= " AND (title LIKE :movie 
                          OR actors LIKE :movie
                          OR director LIKE :movie)";
                $namedParameters[':movie'] = "%$movie%";
            }
            
            if(!empty($_GET['genre'])){
                //This SQL prevents SQL INJECTION by using a named parameter
                $sql .= " AND genreId = :genre";
                $namedParameters[':genre'] = $_GET['genre'];
            }
            
            if (isset($_GET['searchBy'])) {
                
                if($_GET['searchBy'] == "nameOrder") {
                    $sql .= " ORDER BY title";
                } else if($_GET['searchBy'] == "ratingOrder") {
                    $sql .= " ORDER BY ratingId";
                } else {
                    $sql .= " ORDER BY year";
                }
                
                if (isset($_GET['orderBy'])) {
                
                    if($_GET['orderBy'] == "dc") {
                        $sql .= " DESC";
                    } else {
                        $sql .= " ASC";
                    }
                    
                }
                
            }
            
            //}
            
            $stmt = $dbConn->prepare($sql);
            $stmt->execute($namedParameters);
            $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
            //print_r($records);
            
            
            //Creating a table
            echo "<table class='table'>";
            
            foreach($records as $record){
                
                // echo "<a href='movieInfo.php?movId=".$record['movId']."'>";
                // echo $record['title'];
                // echo "</a> ";
                // echo "<br>";
                // echo "Director: " . $record['director'] . "<br> Starring: " . $record['actors'] . "<br>";
                // echo "<br>";
                
                
                //Putting them in variables to avoid having to concatenate strings later
                $itemName = $record['title'];
                $itemDirector = $record['director'];
                $itemActors = $record['actors'];
                $itemImage = $record['image'];
                $itemId = $record['movId'];
                $itemRating = $record['ratingId'];
                $itemYear = $record['year'];
                
                //Displaying things as a table
                echo "<tr>";
                echo "<td> <img src='$itemImage' width=50> </td>";
                echo "<td> <h4> <a href='#' class='movLink' id='".$record['movId']."'> $itemName </a> </h4> </td>";
                echo "<td> <h4>Year: $itemYear</h4> </td>";
                echo "<td> <h4>Director: $itemDirector</h4> </td>";
                echo "<td> <h4>Starring: $itemActors</h4> </td>";
                echo "<td> <h4>Rating: $itemRating Stars</h4> </td>";
                
                
                
                echo "</tr>";
                
            }
            
            echo "</table>";
        
        }
    }
    
    function displayGenres() { 
        global $dbConn;
        
        $sql = "SELECT * FROM fin_proj_genres ORDER BY genName";
        
        $stmt = $dbConn->prepare($sql);
        $stmt->execute();
        $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
        //print_r($records);
        //echo "<hr>";
        //echo $records[2] . "<br>";
        //echo $records[1]['catDescription'] . "<br>";
        
        foreach ($records as $record) {
            echo "<option value='".$record['genreId']."'>" . $record['genName'] . "</option>";
        }
    }
    
    function averageRating() {
        global $dbConn;
        
        $sql = "SELECT ratingId FROM fin_proj_movies WHERE 1";
        
        $stmt = $dbConn->prepare($sql);
        $stmt->execute();
        $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
        //print_r($records);
        
        $sum = 0;
        
        for($i = 0; $i < count($records); $i++) {
            $sum += $records[$i]["ratingId"];
        }
        
        $sum = $sum/count($records);
        
        echo "The average rating of all movies is: $sum.";
    }
    
    function commonGenre() {
        global $dbConn;
        
        $sql = "SELECT genreId FROM fin_proj_movies WHERE 1";
        
        $stmt = $dbConn->prepare($sql);
        $stmt->execute();
        $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $genreNames = array("Horror", "Comedy", "Animation", "Superhero", "Drama");
        
        $genreNums = array();
        $genreNums[0] = 0;
        $genreNums[1] = 0;
        $genreNums[2] = 0;
        $genreNums[3] = 0;
        $genreNums[4] = 0;
        
        for($i = 0; $i < count($records); $i++) {
            $genreNums[$records[$i]["genreId"]] += 1;
        }
        
        $multiGenre = 0;
        
        $max = max($genreNums);
        
        for($i = 0; $i < count($genreNums); $i++) {
            if($genreNums[$i] == $max) {
                $multiGenre += 1;
            }
        }
        
        if($multiGenre == 1) {
            echo "The most common genre is: ";
        } else {
            echo "The most common genres are: ";
        }
        
        for($i = 0; $i < count($genreNums); $i++) {
            if($genreNums[$i] == $max) {
                if($multiGenre >= 3) {
                    echo $genreNames[$i] .", ";
                    $multiGenre -= 1;
                } elseif ($multiGenre == 2) {
                    echo $genreNames[$i] . " and ";
                    $multiGenre -= 1;
                } else {
                    echo $genreNames[$i];
                }
            }
        }
        
        echo " with $max movies.";
    }
    
    function highPerGenre() {
        global $dbConn;
        
        $genreNames = array("Horror", "Comedy", "Animation", "Superhero", "Drama");
        
        $movByGenre = array();
        
        for($i = 0; $i < 5; $i++) {
            $sql = "SELECT title, ratingId FROM fin_proj_movies WHERE genreId = ($i + 1) ORDER BY ratingId DESC";
            
            $stmt = $dbConn->prepare($sql);
            $stmt->execute();
            $movByGenre[$i] = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        
        $multiMovie = array();
        $multiMovie[0] = 0;
        $multiMovie[1] = 0;
        $multiMovie[2] = 0;
        $multiMovie[3] = 0;
        $multiMovie[4] = 0;
        
        $maxes = array();
        $maxes[0] = $movByGenre[0][0]["ratingId"];
        $maxes[1] = $movByGenre[1][0]["ratingId"];
        $maxes[2] = $movByGenre[2][0]["ratingId"];
        $maxes[3] = $movByGenre[3][0]["ratingId"];
        $maxes[4] = $movByGenre[4][0]["ratingId"];
        
        for($i = 0; $i < count($movByGenre); $i++) {
            for($j = 0; $j < count($movByGenre[$i]); $j++) {
                if($movByGenre[$i][$j]["ratingId"] == $maxes[$i]) {
                    $multiMovie[$i] += 1;
                }
            }
        }
        
        for($i = 0; $i < count($movByGenre); $i++) {
            echo "The highest rated ". $genreNames[$i] ." movie";
            if($multiMovie[$i] >= 2) {
                echo "s are: ";
            } else {
                echo " is: ";
            }
            
            for($j = 0; $j < count($movByGenre[$i]); $j++) {
                if($movByGenre[$i][$j]["ratingId"] == $maxes[$i]) {
                    if($multiMovie[$i] >= 3) {
                        echo $movByGenre[$i][$j]['title'] .", ";
                        $multiMovie[$i] -= 1;
                    } elseif ($multiMovie[$i] == 2) {
                        echo $movByGenre[$i][$j]['title'] . " and ";
                        $multiMovie[$i] -= 1;
                    } else {
                        echo $movByGenre[$i][$j]['title'];
                    }
                }
            }
            
            echo " with a rating of ".$maxes[$i].". <br>";
        }
        
        
        //print_r($movByGenre);
        
        
    }

?>