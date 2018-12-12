<?php
    session_start();
    
    include 'inc/dbConnection.php';
    $dbConn = startConnection("final_project");
    include 'inc/functions.php';
    validateSession();
    
    
    if (isset($_POST['updateMov'])){  //user has submitted update form
        $title = $_POST['title'];
        $director = $_POST['director'];
        $actors =  $_POST['actors'];
        $year =  $_POST['year'];
        $genreId = $_POST['genreId'];
        $image = $_POST['movImage'];
        $rating = $_POST['ratingId'];
        
        $sql = "UPDATE fin_proj_movies 
                SET title= :title,
                   director = :director,
                   actors = :actors,
                   year = :year,
                   genreId = :genreId,
                   image = :image,
                   ratingId = :rating
                WHERE movId = " . $_POST['movId'];
                
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
        echo "Movie updated!";
             
        
    }


    if (isset($_POST['movId'])) {
    
    $movInfo = getProductInfo($_POST['movId']);    
      
    // print_r($productInfo);
        
        
    }


?>

<!DOCTYPE html>
<html>
    <head>
        <title> Update Movies! </title>
        
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" type="text/css" />
    </head>
    <body>
        
        <?php 
            include 'inc/header.php';
        ?>

        <div class='container'>
            <div class='text-left'>
                <h1> Updating a Movie </h1>
                
                <br>
                
                <form method='POST'>
                    <input type="hidden" name="movId" value="<?=$movInfo['movId']?>">
                    Movie name: <br> <input type="text" name="title" value="<?=$movInfo['title']?>"><br>
                    Director: <br> <input type="text" name="director" value="<?=$movInfo['director']?>"><br>
                    Actors: <br> <input type="text" name="actors" value="<?=$movInfo['actors']?>"><br>
                    Year: <br> <input type="text" name="year" value="<?=$movInfo['year']?>"><br>
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
                    Set Image URL: <br> <input type="text" name="movImage" value="<?=$movInfo['movImage']?>"><br><br>
                    <input type="submit" name="updateMov" value="Update Movie">
                </form>
            </div>
        </div>
        
        <script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    </body>
</html>