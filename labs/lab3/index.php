<!DOCTYPE html>
<html>
    <?php
        include 'inc/functions.php';
    ?>
    
    <head>
        <title> Silver Jack </title>
        
        <link href="css/styles.css" rel="stylesheet" type="text/css" />
      
    </head>
   <body>
       <div id="hands">
            <header>
                <h1>Silverjack</h1>
            </header>
    
        <?php
            getHand();
        ?>
        
            <div id="elapsedTime">
                    <?= totalTime(); ?>
            </div>
        </div>
    </body>
</html>