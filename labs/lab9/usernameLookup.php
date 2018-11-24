<?php
    $usernames = array("username", "value", "teddy", "eddie", "edward");
    if  (in_array($_GET['username'], $usernames)) {  
        echo "Unavailable";
    } else { 
        echo "Available";
    }
?>