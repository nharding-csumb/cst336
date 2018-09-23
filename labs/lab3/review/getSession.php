<?php
session_start();    //start or resume an existing session


?>

<!DOCTYPE html>
<html>
    <head>
        <title> Setting a Session Variable </title>
    </head>
    <body>
        
        My name is <?= $_SESSION=["my_name"] ?>

    </body>
</html>