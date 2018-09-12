<?php
        function displaySymbol($random_value, $pos) {
            
            switch($random_value) {
                
                case 0: $symbol = "seven";
                    break;
                    
                case 1: $symbol = "cherry";
                    break;
                    
                case 2: $symbol = "lemon";
                    break;
                    
                case 3: $symbol = "bar";
                    break;
                    
                case 4: $symbol = "grapes";
                    break;
                    
                case 5: $symbol = "orange";
                    break;
            }
        
            echo "<img id='reel$pos' src='img/$symbol.png' alt='Drawing of a $symbol.' title='".ucfirst($symbol)."' width='70' />";
            
        } //displaySymbol()
        
        function displayPoints($randomValue1, $randomValue2, $randomValue3) {
            
            echo "<div id='output'>";
            
            if($randomValue1 == $randomValue2 && $randomValue2 == $randomValue3) {
                switch ($randomValue1) {
                    case 0: $totalPoints = 7000;
                        echo "<br><h1>Jackpot!</h1><br>";
                        break;
                    case 1: $totalPoints = 500;
                        break;
                    case 2: $totalPoints = 250;
                        break;
                    case 3: $totalPoints = 2500;
                        echo "<br><h1>Excellent!</h1><br>";
                        break;
                    case 4: $totalPoints = 750;
                        break;
                    case 5: $totalPoints = 1000;
                        echo "<br><h1>Great!</h1><br>";
                        break;
                }
                
                echo "<h2>You won $totalPoints points!</h2>";
            } else {
                echo "<h3> Try Again! </h3>";
            }
            echo "</div>";
        }
        
        function play() {
            for ($i = 1; $i < 4; $i++) {
                ${"random_value" . $i} = rand(0, 5);         //Generates a random number from 0-5, inclusive and creates a new variable with the name "random_value$i" to hold it
                displaySymbol(${"random_value" . $i}, $i);      
            }
        
            displayPoints($random_value1, $random_value2, $random_value3);
        }
?>