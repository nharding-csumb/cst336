<?php
    include 'inc/functions.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <title> Calculator </title>
        
        <style>
            @import url("css/styles.css");
        </style>
    </head>
    
    <body>
        
        <div id="header">
            <h1> Simple Calculator </h1>
        </div>
        
        <main>
            
            <form method="GET">
                
                <div class="box">
                    How many variables are you performing the operation on?
                    <br />
                    <select name="varNum">
                        
                        <option value=""
                        <?php
                        if($_GET['varNum'] == ""){
                                echo "selected";
                            }
                        ?>
                        >Select</option>
                        
                        <option value="2"
                        <?php
                        if($_GET['varNum'] == 2){
                                echo "selected";
                            }
                        ?>
                        >Two</option>
                        
                        <option value="3"
                        <?php
                        if($_GET['varNum'] == 3){
                                echo "selected";
                            }
                        ?>
                        >Three</option>
                        
                        <option value="4"
                        <?php
                        if($_GET['varNum'] == 4){
                                echo "selected";
                            }
                        ?>
                        >Four</option>
                        
                        <option value="5"
                        <?php
                        if($_GET['varNum'] == 5){
                                echo "selected";
                            }
                        ?>
                        >Five</option>
                        
                    </select>
                </div>
                
                <br /> <br />
                
                <?php
                if (opNumValid()){
                    $words = array("first", "second", "third", "fourth", "fifth");
                    
                    echo "<div class='box'>";
                    
                    for ($i = 0; $i < $_GET['varNum']; $i++){
                        echo "".ucfirst($words[$i])." Value: ";
                        echo "<input type='text' name='".$words[$i]."Val' size='4' value='".$_GET[''.$words[$i].'Val']."'";
                        echo "/>";
                        echo "<br />";
                        if ($i != ($_GET['varNum'] - 1)) {
                            echo "<br />";
                        }
                    }
                    
                    echo "</div>";
                    
                    // First Value: <input type='text' name='firstVal' size='4' value='$_GET['firstVal']' />
                    // Second Value: <input type='text' name='secondVal' size='4' value='$_GET['secondVal']' />
                
                //NOTE: This if closes further down the page, below the radio input
                ?>
                
                <br /> <br />
                
                
                <div class='box'>
                    <input type="radio" name="operation" value="add"
                    <?php
                    if ($_GET['operation'] == 'add') {
                        echo " checked";
                    } ?>
                    > Add 
                    
                    <input type="radio" name="operation" value="sub"
                    <?php
                    if ($_GET['operation'] == 'sub') {
                        echo " checked";
                    } ?>
                    > Subtract 
                    
                    <input type="radio" name="operation" value="mul"
                    <?php
                    if ($_GET['operation'] == 'mul') {
                        echo " checked";
                    } ?>
                    > Multiply 
                </div>
                
                
                <?php
                //This closes the validator if from before the text input
                } else { ?>
                <h3> You need to select a number of variables to calculate if you want to use this calculator. </h3>
                <br /> <br />
                <?php } ?>
                
                <br /> <br />
                
                <input type="submit" name="submitBtn" size="10"
                <?php
                if (opNumValid() == false) { ?>
                value="Continue"
                <?php } else {?>
                value="Calculate"
                <?php } ?>
                />
            </form>
            
            <br /><br />
            
            <?php
            if(opNumValid()) {
                //These are separate so the error message doesn't display before it's even asked for values
                if(numNotCharVal() && opValid()) {
                    echo "<div class='box'>";
                    calculateVal();
                    echo "</div>";
                }
            }
            ?>
        </main>

    </body>
</html>