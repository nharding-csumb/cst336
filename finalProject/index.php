<?php
    session_start();
    
    include 'inc/functions.php';
    
    $_SESSION["page"] = "home";
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Movie Database</title>
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    	<script src="https://code.jquery.com/jquery-3.1.0.js"></script>
        
        <script>
        
            // $("#admin").onclick = function() {
            //     location.href = "adminLogin.php";
            // };
        
            // $('document').ready(function() {
            //     $('#admin').click(function() {
            //         location.href="adminLogin.php";
            //     });
            // });
            
            function loginError() {
                return alert("Error: Incorrect username or password (You might want to try 'admin' and 'secret' for username and password, instead.)");
            }
        </script>
        
    </head>
    <body>
        
        <?php 
            include 'inc/header.php';
        ?>
        
        <br><br>
        
        <div class='container'>
            <div class='text-center'>
                <h2>Admin Login</h2> <br>
                <form method="POST" action="loginProcess.php">
                    Username: <input type="text" name = "username"/> <br /> <br />
                    Password: <input type="password" name="password"/> <br /> <br />
                    <input class="btn btn-primary" type="submit" name="submitBtn" value="Admin Login"/> <br />
                </form>
                <br>
                <?php
                
                    if(loginProblem()) { ?>
                    <script>loginError();</script>
                <?php 
                    }
                ?>
                <!--<button type="button" id="admin" class="btn btn-primary">Admin Login</button>-->
                <br><br>
                Not an admin? Try the <a href="user.php">user page</a> instead.
        
            </div>
        </div>
        
        
        <script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    </body>
</html>