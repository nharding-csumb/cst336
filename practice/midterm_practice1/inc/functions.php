<?php

    //Starting the session to keep track of each month's itinerary
    session_start();
    
    //The array where we'll store the itineraries (Month, number of locations, and country)
    //$_SESSION['itineraries'] = array();

    function makeItinerary (){
        // Error message for month
        if (empty($_GET['month'])) {
            echo "<div class='error'>";
            echo "<h2>You must select a month!</h2>";
            echo "</div>";
            echo "<br> <br>";
        }
        
        // Error message for location number
        if(!isset($_GET['locations'])) {
            echo "<div class='error'>";
            echo "<h2>You must select a number of locations!</h2>";
            echo "</div>";
            echo "<br> <br>";
        }
        
        //Display the itinerary
        if(!empty($_GET['month']) && isset($_GET['locations'])) {
            
            //global session declared for use later
            //global $_SESSION['itineraries'];
            
            //The relevant GET variables put into nicer variables
            $month = $_GET['month'];
            $loc = $_GET['locations'];
            $country = $GET['country'];
            $order = 2;
            if(isset($_GET['order'])){
                $order = $_GET['order'];
            }
            
            //Adding/Changing the given month in the session array
            $_SESSION['itineraries'][''.$month.''] = "Month: $month, visiting $loc places in $country";
            
            
            // Code for making the headers
            echo "<div class='heading'>";
            echo "<h2>$month Itinerary<h2>";
            echo "<br><br>";
            echo "<h3>Visiting $loc places in $country</h3>";
            echo "<br><br>";
            echo "</div>";
            
            //How many days in the month
            if ($month == 'December' || $month == 'January') {
                $days = 31;
                $len = 5;
            }
            if ($month == 'November') {
                $days = 30;
                $len = 5;
            } else {
                $days = 28;
                $len = 4;
            }
            
            //Arrays for the countries and where you can go in them
            $USA = array("chicago", "hollywood", "las_vegas", "ny", "washington_dc", "yosemite");
            $Mexico = array("acapulco", "cabos", "cancun", "chichenitza", "huatulco", "mexico_city");
            $France = array("bordeaux", "le_havre", "lyon", "montpellier", "paris", "strasbourg");
            
            
            //Pick the days of the visits
            $possDays = array(1, $days);
            $visitDays = array();
            $visitLocs = array();
            for ($i = 0; $i < $loc; $i++){
                shuffle($possDays);
                array_push($visitDays, array_shift($possDays));
                
                //Pick the location of the visits
                shuffle(${$country});
                array_push($visitLocs, array_shift(${$country}));
            }
            
            //If they want an order, give it to them
            if($order == 0) {
                asort($visitLocs);
                $visitLocs = array_values($visitLocs);
            }
            if($order == 1) {
                arsort($visitLocs);
                $visitLocs = array_values($visitLocs);
            }
            
            //Displaying the table
            echo "<table border=1>";
            $currDay = 1;
            for ($i = 0; $i < $len; $i++){
                
                echo "<tr>";
                for($j = 0; $j < 7; $j++) {
                    echo "<td>";
                    if ($currDay <= $days){
                        echo " $currDay <br>";
                    }
                    if (in_array($currDay, $visitDays)) {
                        $currLoc = array_shift($visitLocs);
                        echo "<img src='img/$country/".$currLoc.".png' width='100'> <br /> ";
                        echo " ".ucfirst($currLoc)." ";
                    }
                    echo "</td>";
                    $currDay++;
                }
                echo "</tr>";
            }
            echo "</table>";
            //Finish displaying table
            
            
        }
    }

?>