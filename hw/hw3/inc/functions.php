<?php

    function opNumValid() {
        if (empty($_GET['varNum'])) {
            //These error messages are in the HTML so it doesn't display the error message before you have an opportunity to input anything
            // echo "<h2> You need to select a number of variables to calculate if you want to use this calculator, dude. </h2>";
            // echo "<br>";
            return false;
        }
        return true;
    }
    
    function numNotCharVal() {
        if (opNumValid()) {
            $words = array("first", "second", "third", "fourth", "fifth");
            
            for ($i = 0; $i < $_GET['varNum']; $i++) {
                if(!is_numeric($_GET[''.$words[$i].'Val'])) {
                    echo "<h3>Sorry, but we can only add numbers here. Your ".$words[$i]." input either isn't a word or doesn't exist.</h3>";
                    echo "<br /> <br />";
                    return false;
                }
            }
            return true;
        } else {
            return false;
        }
    }
    
    function opValid() {
        if (!isset($_GET['operation'])) {
            echo "<h3>You'll need to select a type of calculation to perform.</h3>";
            echo "<br /> <br />";
            return false;
        }
        return true;
    }
    
    function calculateVal() {
        $op = $_GET['operation'];
        $varNum = $_GET['varNum'];
        $vars = array();
        $words = array("first", "second", "third", "fourth", "fifth");
        
        for ($i = 0; $i < $varNum; $i++) {
            array_push($vars, $_GET[''.$words[$i].'Val']);
        }
        
        $result = 0;
        
        //This is important, because otherwise multiplication will always result in 0
        if ($op == 'mul') {
            $result = 1;
        }
        
        for ($i = 0; $i < $varNum; $i++) {
            switch ($op) {
                case 'add':
                    $result = $result + $vars[$i];
                    break;
                case 'sub':
                    $result = $result - $vars[$i];
                    break;
                case 'mul':
                    $result = $result * $vars[$i];
                    break;
            }
        }
        
        echo "The ";
        //Gotta make sure it says the right word for the situation
        switch ($op) {
            case 'add':
                echo "sum";
                break;
            case 'sub':
                echo "difference";
                break;
            case 'mul':
                echo "product";
                break;
        }
        echo " of your $varNum numbers is: <strong>$result</strong>";
    }
?>