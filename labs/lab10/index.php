<?php

    include '../../inc/dbConnection.php';
    $dbConn = startConnection("c9");
    
    function getPetPics(){
        global $dbConn;
        
        $sql = "SELECT pictureURL FROM pets";
        
        $stmt = $dbConn->prepare($sql);
        $stmt->execute();
        $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        //print_r($records);
        
        return $records;
    }
    
    $petImages = getPetPics();
    //print_r($petImages);

?>

<!DOCTYPE html>
<html>
    <head>
        <title> CSUMB: Pet Shelter </title>
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
	    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
	    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>   
        <style>
            body {
                text-align: center;
            }
            
            .carousel {
                margin: 0 auto;
            }
        </style>
   
    </head>
    <body>
        <?php 
            include 'inc/header.php';
        ?>

        <!-- Display Carousel here  -->
        <div id="carouselExampleIndicators" class="carousel slide w-75" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <?php
                for ($i = 1; $i < count($petImages); $i++) {
                    echo "<li data-target='#carouselExampleIndicators' data-slide-to='$i'></li>";
                }
                ?>
            </ol>
            
            <div class="carousel-inner">
                <?php
                for ($i = 0; $i < count($petImages); $i++) {
                    
                    // do {
                    // $randomIndex = array_rand($imageURLs);  //rand(o, count($imageURLs) - 1);
                    // }
                    //while (!isset($petImages[$i]));
                    
                    echo "<div class='carousel-item";
                    echo ($i == 0)?" active":"";           //Ternary operator
                    echo "'>";
                    echo "<img class='d-block w-100 img-fluid' src='img/".$petImages[$i]['pictureURL']."' alt='Slide ".($i + 1)."' >";
                    echo "</div>";
                    //unset($imageURLs[$randomIndex]);
                    
                    }
                ?>
            </div>
            
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
            
        </div>
        
        <br /> <br />
        
        
        <a class="btn btn-outline-success" href="pets.php" role="button">Adopt Now</a>
        
        <br><br><br>
        <?php 
            include 'inc/footer.php';
        ?>
        
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    </body>

</html>