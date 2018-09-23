<?php
    
    function displayArray(){
        global $symbols;
        
        echo "<hr>";
        print_r($symbols);
        
        for($i = 0; $i < count($symbols); $i++)
        {
            echo $symbols[$i] . ", ";
        }
        
    }
    
    $symbols = array("seven");
    print_r($symbols);      //displays array content
    
    
    $points = array("orange"=>250, "cherry"=>500, "seven"=>1000);   //Associated arrays
    
    
    array_push($symbols, "orange", "grapes");   //adds elements to the end of the array
    print_r($symbols);      //displays array content
    
    //$symbols[2] = "cherry";     //adds element at specific index of the array
    $symbols[] = "cherry";     //adds element to the end of the array
    //print_r($symbols);      //displays array content
    displayArray();
    
    sort($symbols);     //sorts array
    displayArray();
    
    rsort($symbols);    //reverses order of array
    displayArray();
    
    unset($symbols[2]);     //removes element of array by removing the index entirely
                            //this needs to be otherwise accounted for
    displayArray();
    
    $symbols = array_values($symbols);  //returns values of ana rrray and indexes them numerically
    displayArray();
    
    echo "<hr>";
    
    echo "Random item: ";
    
    echo $symbols[array_rand($symbols)];    //displays random item from array
    
    echo "<hr>";
    
    echo "Random item: ";
    
    echo "<img src='img/".$symbols[array_rand($symbols)].".png' alt='Drawing of a $symbol.' title='".ucfirst($symbol)."' width='70' />";    //Displays a different random item as an image
    
    

?>

<!DOCTYPE html>
<html>
    
    <head>
        <title> Review: Arrays </title>
        
    </head>
    
    
    <body>
        
       

    </body>
    
</html>