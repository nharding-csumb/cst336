<?php

    session_start();
    
    include 'inc/functions.php';

?>

<!DOCTYPE html>
<html>
    <head>
        <title> Admin Login </title>
        
        <script>
            
            function loginError() {
                return alert("Error: Incorrect username or password");
            }
            
        </script>
        
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" type="text/css" />
    </head>
    <body>
        
        <div class='text-center'>
        
            <h1> Ottermart - Admin Login</h1>
            
            <br />
            
            <form method="POST" action="loginProcess.php">
                Username: <input type="text" name = "username"/> <br /> <br />
                Password: <input type="password" name="password"/> <br /> <br />
                <input type="submit" name="submitBtn" value = "Login"/> <br />
            </form>
            
            <?php
            
                if(loginProblem()) { ?>
                <script>loginError();</script>
            <?php 
                }
            ?>
        
        </div>
        
        <footer>
            <hr>
            <img src="../../img/buddy_verified.png" alt="Buddy Verified Label" title="Buddy Verified Label">
        </footer>
        
        <script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

    </body>
</html>