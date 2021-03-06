<?php

    function play(){
        $cards = range(1,13);
        
        $card_names = array("Ace", "2", "3", "4", "5", "6", "7", "8", "9", "10", "Jack", "Queen", "King");
        
        //Array Function #1: shuffle
        shuffle($cards);
        
        $your_cards = array();
        $dealer_cards = array();
    
        for ($i = 0; $i < 2; $i++){
            //Array Function #2 & #3 - array_push and array_shift
            array_push($your_cards, array_shift($cards));
            array_push($dealer_cards, array_shift($cards));
        }
        
        //Putting the cards in their own div class
        echo "<div class='cards'>";
        
        echo "<h2> Dealer's Cards </h2>";
        //Display the one card of the dealer's that you can see.
        echo "<img src='img/".$dealer_cards[0].".png' alt='Image of ".$card_names[$dealer_cards[0] - 1].".' title='".$card_names[$dealer_cards[0] - 1]."' />";
        echo "<img src='img/card_back.png' alt='Image of an unidientified card.' title='Unidentified card.' />";
        echo "</div>";
        //echo "<br> <br>";
        //Display the player's hand.
        echo "<div class='cards'>";
        echo "<h2> Your Cards </h2>";
        echo "<img src='img/".$your_cards[0].".png' alt='Image of ".$card_names[$your_cards[0] - 1].".' title='".$card_names[$your_cards[0] - 1]."' />";
        echo "<img src='img/".$your_cards[1].".png' alt='Image of ".$card_names[$your_cards[1] - 1].".' title='".$card_names[$your_cards[1] - 1]."' />";
        echo "</div>";
        //echo "<br> <br> <br>";
        
        //Putting the text in its own div
        echo "<div id='text'>";
        //Accounting for Blackjack.
        if ($your_cards[0] >= 10 && $your_cards[1] == 1){
            echo "You've got Blackjack, so you don't need to worry about what to do!";
            echo "<br><br><br>";
        } elseif ($your_cards[0] == 1 && $your_cards[1] >= 10){
            echo "You've got Blackjack, so you don't need to worry about what to do!";
            echo "<br><br><br>";
        } else {
            echo "The most likely value to draw from the deck is 10, since four cards have that value per suit. That means you should always assume the dealer's second card is a 10, unless they have an Ace, in which case they would have already revealed their hand.";
            echo "<br> <br>";
            echo "With that in mind, let's look at what cards you can draw that would be safe.";
            echo "<br> <br>";
            
            //Keeping track of effective value of player's cards for ease of calculation
            // $effective_value = array();
            // for ($i = 0; $i < 2; $i++){
            //     if($your_cards[$i] >= 10)
            //     {
            //         array_push($effective_value, 10);
            //     } else {
            //         array_push($effective_value, $your_cards[$i]);
            //     }
            // }
            
            //Calculating effective value of player's cards
            $effective_value = 0;
            for ($i = 0; $i < 2; $i++){
                if($your_cards[$i] >= 10)
                {
                    $effective_value = $effective_value + 10;
                } else {
                    $effective_value = $effective_value + $your_cards[$i];
                }
            }
            
            //Keeping track of the number of safe draws for later
            $safe_values = 0;
            
            //Displaying all the cards that you can draw without busting
            for ($i = 0; $i < 10; $i++){
                if ($effective_value + ($i + 1) <= 21){
                    if($i != 0){
                        echo ", ";
                    }
                    echo "".$card_names[$i]."";
                    
                    if($i == 9){
                        echo ", ".$card_names[10].", ".$card_names[11].", ".$card_names[12]."";
                        $safe_values = $safe_values + 3;
                    }
                    $safe_values++;
                }
            }
            
            echo "<br> <br>";
            echo "That means that $safe_values out of 13 possible values are safe for you to draw with this hand.";
            echo "<br> <br>";
            
            //Giving them advice with some if statements.
            if ($safe_values == 13){
                echo "All the values are safe, so definitely hit.";
            } elseif ($safe_values < 13 && $safe_values > 8){
                echo "Most of the values are safe, so hitting is pretty safe.";
            } elseif ($safe_values <= 8 && $safe_values > 5){
                echo "Only around half the values are safe, so hitting is risky here.";
            } else {
                echo "Any less than 6 safe values is really risky, so you shouldn't hit unless the dealer looks likely to win regardless.";
            }
            
            $hypothetical = 0;
            //Making use of the rand() function
            if ($dealer_cards[0] != 1) {
                $hypothetical = rand(0, 12);
            } else {
                $hypothetical = rand(0, 8);
            }
            echo "<br> <br>";
            echo "If you want to test what you've learned, try thinking about this. If the dealer's second card were a ".$card_names[$hypothetical].", what would you need to win?";
            
            echo "<br><br><br>";
            echo "</div>";
        }
        
    }
    
    
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title> Blackjack Guide </title>
        
        <link href="css/styles.css" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Libre+Baskerville" rel="stylesheet">
    </head>
    <body>
        
        <header>
            <h1> Blackjack Guide </h1>
        </header>
        
        <div id="main">
            <?php
                play();
            ?>
            
            <form>
                <input type="submit" value="Deal again."/>
            </form>
        </div>

    </body>
</html>