<?php

include 'inc/charts.php';
$posters = array("ready_player_one","rampage","paddington_2","hereditary","alpha","black_panther","christopher_robin","coco","dunkirk","first_man");

$sorted = array();

function makeReviews() {
    global $posters;
    global $sorted;
    
    $randomPoster = $posters[rand(0,count($posters)-1)];
    
    array_push($sorted, $randomPoster);
}

function movieReviews() {
    global $sorted;
    
    for ($i = 0; $i < 4; $i++)
    {
        makeReviews();
    }
    
    sort($sorted);
    
    for ($i = 0; $i < 4; $i++)
    {
        echo "<div class='poster'>";
        echo "<h2> $sorted[$i] </h2>";
        echo "<img width='100' src='img/posters/$sorted[$i].jpg'>";    
        echo "<br>";
    
        //NOTE: $totalReviews must be a random number between 100 and 300
        $totalReviews = rand(100,300); 
    
        //NOTE: $ratings is an array of 1-star, 2-star, 3-star, and 4-star rating percentages
        //      The sum of rating percentages MUST be 100
        $ratings = array();
        $remaining = 100;
        for($j = 1; $j < 4; $j++){
            $num = rand(0, ($remaining/2));
            array_push($ratings, $num);
            $remaining = $remaining - $num;
        }
        
        array_push($ratings, $remaining);
    
        //NOTE: displayRatings() displays the ratings bar chart and
        //      returns the overall average rating
        $overallRating = displayRatings($totalReviews,$ratings);
    
        //NOTE: The number of stars should be the rounded value of $overallRating
        echo "<br><img src='img/star.png' width='25'>";
        echo "<img src='img/star.png' width='25'>";
    
        echo "<br>Total reviews: $totalReviews";
        echo "</div>";
    }
}    

?>

<!DOCTYPE html>
<html>
    <head>
        <title> Movie Reviews </title>
        <style type="text/css">
            body {
                text-align:center;
                color:white;
                background-image:url("img/bg.jpg");
            }
            #main {
                display:flex;
                justify-content: center;
            }
            .poster {
                padding: 0 10px;
            }
        </style>
    </head>
    <body>
       
       <h1> Movie Reviews </h1>
        <div id="main">
           <?php
             //NOTE: Add for loop to display 4 movie reviews
             
                 //$display = array();
                  movieReviews();
             
           ?>
       </div>
       <br/>
       <hr>
       <h1>Based on ratings you should watch:</h1>
       
    </body>
</html>