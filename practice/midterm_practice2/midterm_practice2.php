<?php
    include '../../inc/dbConnection.php';

    $dbConn = startConnection("midterm");
    
    function displayCitiesWithPop() {
        global $dbConn;
        
        $sql = "SELECT * FROM mp_town WHERE population > 50000 AND population < 80000";
        $stmt = $dbConn->prepare($sql);
        $stmt->execute();
        $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        foreach($records as $record) {
            echo "".$record['town_name']." - ".$record['population']." <br />";
        }
    }
    
    function displayCitiesByPop() {
        global $dbConn;
        
        $sql = "SELECT * FROM mp_town ORDER BY population DESC";
        $stmt = $dbConn->prepare($sql);
        $stmt->execute();
        $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        foreach($records as $record) {
            echo "".$record['town_name']." - ".$record['population']." <br />";
        }
    }
    
    function displayLeastPopulated() {
        global $dbConn;
        
        $sql = "SELECT * FROM mp_town ORDER BY population LIMIT 3";
        $stmt = $dbConn->prepare($sql);
        $stmt->execute();
        $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        foreach($records as $record) {
            echo "".$record['town_name']." - ".$record['population']." <br />";
        }
    }
    
    function displayCountiesWithS() {
        global $dbConn;
        
        $sql = "SELECT * FROM mp_county WHERE county_name LIKE 'S%'";
        $stmt = $dbConn->prepare($sql);
        $stmt->execute();
        $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        foreach($records as $record) {
            echo "".$record['county_name']." <br />";
        }
    }

?>

<!DOCTYPE html>
<html>
    <head>
        <title> Midterm Practice 2 </title>
    </head>
    <body>
        <h3> Cities With Population Between 50,000 and 80,000 </h3>
        <br />
        <?php displayCitiesWithPop(); ?>
        <br /> <br />
        
        <h3> Cities By Population </h3>
        <br />
        <?php displayCitiesByPop(); ?>
        <br /> <br />
        
        <h3> Three Least Populated Cities </h3>
        <br />
        <?php displayLeastPopulated(); ?>
        <br /> <br />
        
        <h3> Counties That Start With "S" </h3>
        <br />
        <?php displayCountiesWithS(); ?>
        <br /> <br />
        
        
        <br /> <br />
        
        
          
      <table border="1" width="600">
        <tbody><tr><th>#</th><th>Task Description</th><th>Points</th></tr>
        <tr style="background-color:#99E999">
          <td>1</td>
          <td>The report shows all cities/towns that have a population between 50,000 and 80,000</td>
          <td width="20" align="center">10</td>
        </tr>  
        <tr style="background-color:#99E999">
          <td>2</td>
          <td>The report shows all towns ordered by population (from biggest to smallest)</td>
          <td width="20" align="center">10</td>
        </tr>  
        <tr style="background-color:#99E999">
          <td>3</td>
          <td>The report lists the three least populated towns</td>
          <td width="20" align="center">10</td>
        </tr>     
        <tr style="background-color:#99E999">
          <td>4</td>
          <td>The report Lists the counties that start with the letter "S"</td>
          <td width="20" align="center">10</td>
        </tr>
        <tr style="background-color:#99E999">
          <td>7</td>
          <td>This rubric is properly included AND UPDATED (BONUS)</td>
          <td width="20" align="center">2</td>
        </tr>
         <tr>
          <td></td>
          <td>T O T A L </td>
          <td width="20" align="center"><b></b></td>
        </tr> 
      </tbody></table>    

    </body>
</html>