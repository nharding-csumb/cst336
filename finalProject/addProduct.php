<?php

    session_start();
    
    include 'inc/dbConnection.php';
    $dbConn = startConnection("final_project");
    include 'inc/functions.php';
    validateSession();
    
    
    if (isset($_POST['addMov'])) { //checks whether the form was submitted
        
        $title = $_POST['title'];
        $director = $_POST['director'];
        $actors =  $_POST['actors'];
        $year =  $_POST['year'];
        $genreId = $_POST['genreId'];
        $image = $_POST['movImage'];
        $rating = $_POST['ratingId'];
        
        
        $sql = "INSERT INTO fin_proj_movies (title, director, actors, year, genreId, image, ratingId) 
                VALUES (:title, :director, :actors, :year, :genreId, :image, :rating);";
        $np = array();
        $np[":title"] = $title;
        $np[":director"] = $director;
        $np[":actors"] = $actors;
        $np[":year"] = $year;
        $np[":genreId"] = $genreId;
        $np[":image"] = $image;
        $np[":rating"] = $rating;
        
        $stmt = $dbConn->prepare($sql);
        $stmt->execute($np);
        
        $sql = "UPDATE fin_proj_rating SET movList = CONCAT(movList, :mov) WHERE ratingId = $rating";
        
        $np2 = array();
        $np2[":mov"] = $title . ", ";
        
        $stmt = $dbConn->prepare($sql);
        $stmt->execute($np2);
        
        
        
        echo "New movie was added!";
        
    }
    
    // if(isset($_GET['submitProduct'])) { //Checks whether form was submitted
    //     $productName = $_GET['productName'];
    //     $description = $_GET['description'];
    //     $price = $_GET['price'];
    //     $catId = $_GET['catId'];
        
        
    // }

?>

<!DOCTYPE html>
<html>
    <head>
        <title> Admin Section: Add New Product</title>
        
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" type="text/css" />
    </head>
    <body>
        
        <?php 
            include 'inc/header.php';
        ?>
        
        <div class='container'>
            <div class='text-left'>
                <h1> Adding New Movie </h1>
                
                <br>
                
                <form method='POST'>
                    <input type="hidden" name="movId">
                    Movie name: <br> <input type="text" name="title"><br>
                    Director: <br> <input type="text" name="director"><br>
                    Actors: <br> <input type="text" name="actors"><br>
                    Year: <br> <input type="text" name="year"><br>
                    Genre: <br>
                    <select name="genreId">
                        <option value="">Select One</option>
                        <?php
                      
                        $categories = getCategories();
                      
                        foreach ($categories as $category) {
                          
                            echo "<option  "; 
                            echo  ($category['genreId']==$movInfo['genreId'])?"selected":"";
                            echo " value='".$category['genreId']."'>" . $category['genName'] . "</option>";
                        
                        }
                        
                        ?>
                    </select> <br /> <br>
                    Rating: <br> <select name="ratingId">
                        <option value="">Select One</option>
                        <?php
                      
                        for ($i = 1; $i < 6; $i++) {
                          
                            echo "<option  "; 
                            echo  ($i==$movInfo['ratingId'])?"selected":"";
                            echo " value='".$i."'>" . $i . "</option>";
                        
                        }
                        
                        ?>
                    </select> <br /> <br>
                    Set Image URL: <br> <input type="text" name="movImage"><br><br>
                    <input type="submit" name="addMov" value="Add Movie">
                </form>
            
            </div>
        </div>

        <script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    </body>
</html>