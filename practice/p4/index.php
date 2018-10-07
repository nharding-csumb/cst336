<!DOCTYPE html>
<html>
    <?php
        include 'inc/functions.php';
    ?>
    
    <head>
        <title> Aces vs Kings </title>
        
        <style>
            @import url("css/styles.css");
        </style>
    </head>
    <body>
        
        <h1> Aces vs Kings </h1>
        
        <br />
        
        <?php
            displayCards();
        ?>
        
        <br />
        
        <form method="GET">
            
            Number of Rows: <input type="text" name="rows" size="15" placeholder=""/>
            
            <br /> <br />
            
            Number of Columns: <input type="text" name="columns" size="15" placeholder=""/>
            
            <br /> <br />
            
            Suit to omit: <select name="suit">
                <option value="clubs">Clubs</option>
                <option value="diamonds">Diamonds</option>
                <option value="hearts">Hearts</option>
                <option value="spades">Spades</option>
            </select>
            
            <input type="submit" name="submitBtn" value="Submit" />
            
        </form>

    </body>
</html>