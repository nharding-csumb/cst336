<!DOCTYPE html>
<html>
    <head>
        <title> 777 Slot Machine </title>
    </head>
    
    
    <body>
        
        <?php
            
            
        function displaySymbol($random_value) {
            
            switch($random_value) {
                
                case 0: $symbol = "seven";
                    break;
                    
                case 1: $symbol = "cherry";
                    break;
                    
                case 2: $symbol = "lemon";
                    break;
            }
        
            echo "<img src='img/$symbol.png' alt='Drawing of a $symbol.' title='".ucfirst($symbol)."' />";
            
        } //displaySymbol()
        
        function displayPoints($randomValue1, $randomValue2, $randomValue3) {
            
            echo "<div id='output'>";
            
            if($randomValue1 == $randomValue2 && $randomValue2 == $randomValue3) {
                switch ($randomValue1) {
                    case 0: $totalPoints = 1000;
                        echo "<br><h1>Jackpot!</h1><br>";
                        break;
                    case 1: $totalPoints = 500;
                        break;
                    case 2: $totalPoints = 250;
                        break;
                }
                
                echo "<h2>You won $totalPoints points!</h2>";
            } else {
                echo "<h3> Try Again! </h3>";
            }
            echo "</div>";
        }
        
        
        for ($i = 1; $i < 4; $i++) {
            ${"random_value" . $i} = rand(0, 2);         //Generates a random number from 0-2, inclusive and creates a new variable with the name "random_value$i" to hold it
            displaySymbol(${"random_value" . $i});      
        }
        
        displayPoints($random_value1, $random_value2, $random_value3);
        
        
        // if ($random_value1 == $random_value2 && $random_value1 == $random_value3) {
        //     echo "<br>Jackpot!<br>";
        // } else {
        //     echo"<br>Try Again?<br>";
        // }
        
        ?>
        
        <!--<img src='img/cherry.png' alt='Drawing of a cherry.' title='Cherry' />-->

    </body>
    
</html>