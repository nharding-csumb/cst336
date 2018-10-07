<?php

    $backgroundImage = "img/sea.jpg";
    
    if (isset($_GET["keyword"])) { //checks if a form has been submitted
        
        include "api/pixabayAPI.php";

        //print_r($_GET); //$_GET and $_POST are special arrays that store the things passed through GET and POST forms.
    
        $keyword = $_GET["keyword"];
        
        if (!empty($_GET["category"])) {    //User selected a category
            $keyword = $_GET["category"];
        }
        
        // echo "You searched for: $keyword";
        // echo "   ";
        
        $layout = $_GET["layout"];
        // echo "Layout: " . $layout;
        
        $imageURLs = getImageURLs($keyword, $layout);
        
        //shuffle($imageURLs);
    
        $backgroundImage = $imageURLs[array_rand($imageURLs)];
    }
    
    //print_r($imageURLs);
    
    function formIsValid() {
        
        if(empty($_GET['keyword']) && empty($_GET['category'])) {
            echo "<h1> ERROR - You must type a keyword or select a category.";
            return false;
        }
        
        return true;
    }
    
    
?>


<!DOCTYPE html>
<html>
    <head>
        <title> Image Carousel </title>
        
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" type="text/css" />
        <style>
            /*@import url("css/styles.css");*/
            
            body {
                background-image: url(<?=$backgroundImage?>);
                background-size: cover;
                text-align: center;
            }
            
            #carouselExampleIndicators{
                 width:700px;
                 margin:0 auto; 
            }
        </style>
    </head>
    <body>
        
        <br />
        
        <form method="GET"> <!--GET and POST are the two methods for submitting forms. The main difference is that GET puts the submitted information in the URL.-->
            
            
            <input type="text" name="keyword" size="15" placeholder="Keyword" value="<?=$_GET['keyword']?>"/>
                
            <div id="inputLayout">
                <input type="radio" name="layout" value="horizontal" 
                <?php
                    if($_GET['layout'] == "horizontal"){
                        echo "checked";
                    }
                ?>
                > Horizontal
                
                <br />
                
                <input type="radio" name="layout" value="vertical"
                <?php
                    if($_GET['layout'] == "vertical"){
                        echo "checked";
                    }
                ?>
                > Vertical
            </div>
            
            <br /> <br />
            
            <select name="category">
                <option value=""
                <?php
                    if($_GET['category'] == ""){
                        echo "selected";
                    }
                ?>
                >--Select One--</option>
                <option value="ocean" 
                <?php
                    if($_GET['category'] == "ocean"){
                        echo "selected";
                    }
                ?>
                >Sea</option>
                <option
                <?php
                    if($_GET['category'] == "Mountain"){
                        echo "selected";
                    }
                ?>
                >Mountain</option>
                <option
                <?php
                    if($_GET['category'] == "Forest"){
                        echo "selected";
                    }
                ?>
                >Forest</option>
                <option
                <?php
                    if($_GET['category'] == "Sky"){
                        echo "selected";
                    }
                ?>
                >Sky</option>
            </select>
            
            <br /> <br />
            
            <input type="submit" name="submitBtn" value="Submit!" />
            
            <br /> <br />
            
        </form>
        
        
        <?php
        
        if (isset($imageURLs) && formIsValid())  {?>       
        
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <?php
                for ($i = 1; $i < 7; $i++) {
                    echo "<li data-target='#carouselExampleIndicators' data-slide-to='$i'></li>";
                }
                ?>
            </ol>
            
            <div class="carousel-inner">
                <!--<div class="carousel-item active">-->
                <!--    <img class="d-block w-100" src="<?=$imageURLs[array_rand($imageURLs)]?>" alt="Slide 1"> <!--Need to fix this so it displays from the for loop below-->
                <!--</div>-->
                <?php
                for ($i = 0; $i < 7; $i++) {
                    
                    do {
                    $randomIndex = array_rand($imageURLs);  //rand(o, count($imageURLs) - 1);
                    }
                    while (!isset($imageURLs[$randomIndex]));
                    
                    echo "<div class='carousel-item";
                    echo ($i == 0)?" active":"";           //Ternary operator
                    echo "'>";
                    echo "<img class='d-block w-100' src='".$imageURLs[$randomIndex]."' alt='Slide ".($i + 1)."'>";
                    echo "</div>";
                    unset($imageURLs[$randomIndex]);
                    
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
        
        <?php
        } //closing if statement above
        
        else {
            echo "<h1> You must type a keyword or select a category. </h1>";
        }
        ?>
        
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    </body>
</html>