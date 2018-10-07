<?php

    $clubs = range(1, 13);
    $diamonds = range(1, 13);
    $hearts = range(1, 13);
    $spades = range(1, 13);

    function displayCards () {
        global $clubs;
        global $diamonds;
        global $hearts;
        global $spades;
        
        if (isset($_GET["rows"]) && isset($_GET["columns"])) {
            $rows = $_GET["rows"];
            $columns = $_GET["columns"];
            $suit = $_GET["suit"];
        
            $suit_names = array("clubs", "diamonds", "hearts", "spades");
        
            echo "<table>";
        
            for ($i = 0; $i < $rows; $i++) {
                echo "<tr class='table-row'>";
            
                for ($j = 0; $j < $columns; $j++){
                    shuffle($clubs);
                    shuffle($diamonds);
                    shuffle($hearts);
                    shuffle($spades);
                    
                    $suit_num = rand(0,3);
                    $card = array_shift(${$suit_names[$suit_num]});
                
                    echo "<td> <img src='cards/".$suit_names[$suit_num]."/".$card.".png' alt='Image of a card.' title='A card.' /> </td>";
                
                }
            
                echo "</tr>";
            }
        
            echo "</table>";
        }
    }

?>