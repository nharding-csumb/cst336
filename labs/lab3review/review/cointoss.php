<?php
session_start();
//session_destroy(); //removes a session and all its values

if ( !isset($_SESSION["heads"]) ) { //ONLY do this when the session doesn't exist
    $_SESSION["heads"] = 0;
    $_SESSION["tails"] = 0;
    $_SESSION['tossHistory'] = array();
}

if( rand(0,1) == 0){
    $_SESSION["heads"]++;
    $_SESSION['tossHistory'][] = "H"; //adds an element to the array
} else {
    $_SESSION["tails"]++;
    $_SESSION['tossHistory'][] = "T"; //adds an element to the array
}

print_r($_SESSION['tossHistory']);

?>


<!DOCTYPE html>
<html>
    <head>
        <title> Coin Flipping </title>
    </head>
    <body>
        
        <h2> Heads: <?= $_SESSION["heads"] ?></h2>
        <br />
        <h2> Tails: <?= $_SESSION["tails"] ?></h2>

    </body>
</html>