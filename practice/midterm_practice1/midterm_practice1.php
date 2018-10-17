<?php
    include 'inc/functions.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <title> Winter Vacation Planner </title>
        
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <style>
            @import url("css/styles.css");
        </style>
    </head>
    <body>
        
        <h1>Winter Vacation Planner!</h1>
        
        <form method="GET">
            
            Select Month: <select name="month">
                <option value="">
                    Select
                </option>
                <option>
                    November
                </option>
                <option>
                    December
                </option>
                <option>
                    January
                </option>
                <option>
                    February
                </option>
            </select>
            
            <br /><br />
            
            Number of Locations: 
            <input type="radio" name="locations" value="3"> <strong>Three</strong>
            <input type="radio" name="locations" value="4"> <strong>Four</strong>
            <input type="radio" name="locations" value="5"> <strong>Five</strong>
            
            <br /><br />
            
            Select Country: <select name="Country">
                <option selected>
                    USA
                </option>
                <option>
                    Mexico
                </option>
                <option>
                    France
                </option>
            </select>
            
            <br /><br />
            
            Visit locations in alphabetical order: 
            <input type="radio" name="order" value="0"> <strong>A-Z</strong>
            <input type="radio" name="order" value="1"> <strong>Z-A</strong>
            
            <br /><br />
            
            <input type="submit" name="submitBtn" value="Create Itinerary">
        </form>
        
        <br /><hr><br />
        
        <?=makeItinerary()?>

        <script src="js/jquery.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    </body>
</html>