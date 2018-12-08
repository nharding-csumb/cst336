<?php

    include '../../inc/dbConnection.php';
    $dbConn = startConnection("c9");
    
    function getAllPets(){
        global $dbConn;
        
        $sql = "SELECT name, type, id FROM pets ORDER BY name ASC";
        
        $stmt = $dbConn->prepare($sql);
        $stmt->execute();
        $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        //print_r($records);
        
        return $records;
    }

?>

<!DOCTYPE html>
<html>
    <head>
        <title> Adoptions </title>
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    	<script src="https://code.jquery.com/jquery-3.1.0.js"></script>
        <style>
            body {
                text-align: center;
            }
        </style>
   
    </head>
    <body>
        <?php 
            include 'inc/header.php';
        ?>
        
        <script>
            $('document').ready(function() {
                $('.petLink').click(function() {
                    $("#container").html("<img src='img/loading.gif' />");
                    
                    $('#petModal').modal("show");
                    //alert($(this).attr('id'));
                    $.ajax({
                        
                        type: "GET",
                        url: "api/getPetInfo.php",
                        dataType: "json",
                        data: { "petId": $(this).attr('id') },
                        success: function(data,status) {
                            //alert(data);
                            $("#petName").html(data.name);
                            //$("#type").html(data.type);
                            //$("#breed").html(data.breed);
                            $("#description").html(data.description);
                            
                            $("#image").attr('src', "img/" + data.pictureURL);
                            $("#container").html("");
                        }
                    }); //end ajax
                }); // petlink click
            }); // doc end
        </script>

        <?php
            $pets = getAllPets();
            
            foreach($pets as $pet){
                echo "<ul><li>Name: " ."<a href='#' class='petLink' id='". $pet['id'] ."'>" .$pet['name']. " </a>" . "</li>";
    	        echo "<li>Type: ".$pet['type']."</li></ul>";
            }
        ?>
        
        <!--<div>-->
        <!--    <h1 id='petName'>Name</h1> <br>-->
        <!--    <img id='image' src=""> <br>-->
            <!--<h2 id='type'>Type</h2> <br>-->
        <!--    <span id='breed'>Breed</span> <br>-->
        <!--    <span id='description'></span> <br>-->
        <!--</div>-->
        
        
        <!-- Modal -->
        <div class="modal fade" id="petModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="petname">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div id="container"></div>
                
                <div>
                    <img id='image' src=""> <br>
                    <span id='description'></span>
                </div>
                <br>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
        
        
        <br><br><br>
        <?php 
            include 'inc/footer.php';
        ?>
        
        <script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    </body>

</html>