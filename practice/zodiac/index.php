<?php
    
    function yearList($startYear, $endYear, $rows, $columns) {

        $signs = array("rat","ox","tiger","rabbit","dragon","snake","horse","goat","monkey","rooster","dog","pig");
        
        //echo "<ul>";
        $yearSum = 0;
        $zodiacCount = 0;
        
        
        for ($i = $startYear; $i <= $endYear; $i++){
            echo "<hr>";
            echo "<li>Year $i";
            
            //Display this text on the same line as the year 1776
            if($i == 1776){
                echo " <strong>USA INDEPENDENCE!</strong>";
            }
            //Display a message at the start of every new century using modulo
            if($i % 100 == 0) {
                echo " <strong>Happy New Century!</strong>";
            }
            
            if($i >= 1900 && $i <= 2000) {
                echo "<br>";
                echo "<img src='img/".$signs[$zodiacCount].".png'alt='".$signs[$zodiacCount]."' title='".$signs[$zodiacCount]."'>";
                $zodiacCount++;
            }
            
            echo "</li>";
            
            if ($zodiacCount > 11){
                $zodiacCount = 0;
            }
            $yearSum = $yearSum + $i;
        }
        //echo "</ul>";
        echo "<br>";
        return $yearSum;
    }


?>

<!DOCTYPE html>
<html>
    <head>
        <title> </title>
    </head>
    <body>
        
        <h1>Chinese Zodiac List</h1>
        
        <ul>
            <?php echo "<h1>Year Sum: ".yearList($_GET['StartYear'], $_GET['EndYear']).""; ?>
        </ul>
        
        <form>
            <h2>Start Year: </h2><input type="text" name="StartYear" size="6" value="<?=$_GET['StartYear']?>" />
            <br />
            <h2>End Year: </h2><input type="text" name="EndYear" size="6" value="<?=$_GET['EndYear']?>" />
            <br />
            <input type="submit" name="submitBtn" value="Submit" />
        </form>

    </body>
</html>