<?php
session_start();

if ( !isset($_SESSION["passHistory"]) ) { //ONLY do this when the session doesn't exist
    $_SESSION['passHistory'] = array();
    $_SESSION['passNum'] = 0;
}


if(isset($_SESSION["passHistory"]))
{
    for($i=0; $i < sizeof($_SESSION['passHistory']); $i++)
    {
        echo '$_SESSION["passHistory"][$i]',"<br>";
    }
}

function displayPasswords() {
    $num = $_GET['passNum'];
    $addNum = $_GET['numbers'];

    if($num > 8) {
        echo "<h2>Error - Can only generate up to 8 passwords.</h2>";
    } else {
    
        $len = $_GET['length'];
        $passwords=array();
        $characters = range('A','Z');
        $digits = range(0, 9);
        
        for ($i = 0; $i < $num; $i++){
            $temp='';
            $numLeft = 3;
            for ($j = 0; $j < $len; $j++){
                if ($j > 0 && $numLeft > 0 && $addNum == 1) {
                    $which = rand(0, 1);
                    if ($which = 0){
                        $temp .= $characters[rand(0, (count($characters) - 1))];
                    } else {
                        $temp .= $digits[rand(0, (count($digits) - 1))];
                        $numLeft--;
                    }
                } else {
                $temp .= $characters[rand(0, (count($characters) - 1))];
                }
            }
            $_SESSION['passHistory'][] = $temp;
            $passwords[$i] = $temp;
            echo $passwords[$i], "<br>";
        }
    }
}


?>

<!DOCTYPE html>
<html>
    <head>
        <title> Custom Password Generator </title>
        <link href="css/styles.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <h1> Custom Password Generator </h1>
        <form>
            How many passwords? <input type="text" name="passNum" size="3" value="<?=$_GET['passNum']?>" /> (No more than 8.)
            <br /> <br />
            <strong>Password Length</strong>
            <br />
            <input type="radio" name="length" value="6" id="six"><label for"six">6 Characters</label>
            <input type="radio" name="length" value="8" id="eight"><label for"eight"> 8 Characters</label>
            <input type="radio" name="length" value="10" id="ten"><label for"ten"> 10 Characters</label>
            <br /> <br />
            <input type="checkbox" name="numbers" value="1"> Include digits (up to 3 digits will be part of the password.)
            <br /><br />
            <input type="submit" value="Create Passwords!" name="submitForm">
            <br /><br />
            <?=displayPasswords()?>
            <br />
        </form>
        
        

    </body>
</html>