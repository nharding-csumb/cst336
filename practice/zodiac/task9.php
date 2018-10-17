<?php
    
    //The intention of this function of this program is to let the user enter a number of rows and columns
    //and display all the images of the zodiac in the corresponding year, starting with the year
    //2020. This would've been displayed in a table.
    
    //This function is not complete, and does not do what it's intended to do. It's rather hard to code something like this
    //in just five minutes.
    
    function yearList($startYear, $rows, $columns) {

        $signs = array("rat","ox","tiger","rabbit","dragon","snake","horse","goat","monkey","rooster","dog","pig");
        
        //echo "<ul>";
        $yearSum = 0;
        $zodiacCount = 0;
        
        
        for ($i = $startYear; $i <= $rows; $i++){
            echo "<li>Year $i";
            echo "<br>";
            echo "<img src='img/".$signs[$zodiacCount].".png'alt='".$signs[$zodiacCount]."' title='".$signs[$zodiacCount]."'>";
            $zodiacCount++;
            
            echo "</li>";
            
            if ($zodiacCount > 11){
                $zodiacCount = 0;
            }
            //$yearSum = $yearSum + $i;
        }
        //echo "</ul>";
        echo "<br>";
        //return $yearSum;
    }


?>

<!DOCTYPE html>
<html>
    <head>
        <title> </title>
    </head>
    <body>
        
        <h1>Chinese Zodiac List</h1>
        
        <table>
            <?= yearList(2020, $_GET['rows'], $_GET['columns']); ?>
        </table>
        
        <form>
            <h2>Start Year: </h2><input type="text" name="rows" size="6" value="<?=$_GET['rows']?>" />
            <br />
            <h2>End Year: </h2><input type="text" name="columns" size="6" value="<?=$_GET['columns']?>" />
            <br />
            <input type="submit" name="submitBtn" value="Submit" />
        </form>

    </body>
</html>