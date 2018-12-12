<?php
    session_start();
    
    $_SESSION["page"] = "admin";
    
    include 'inc/dbConnection.php';
    $dbConn = startConnection("final_project");
    
    include 'inc/functions.php';
    validateSession();

?>

<!DOCTYPE html>
<html>
    <head>
        <title> Admin Main Page </title>
        <style>
            form {
                display: inline-block;
            }
            
            #reportDisplay {
                display: none;
            }
        </style>
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    	<script src="https://code.jquery.com/jquery-3.1.0.js"></script>
    	
        <script>
        
            function confirmDelete() {
                
                //alert();
                //prompt();
                return confirm("Really?");
                
            }
            
            function openModal() {
                
                $('#movModal').modal("show");
            }
            
            $('document').ready(function() {
                $('#reports').click(function() {
                    $("#reportDisplay").css("display", "block");
                });
                
                $('.movLink').click(function() {
                    openModal();
                    console.log($(this).attr('id'));
                    $.ajax({
                        type: "GET",
                        url: "api/movieInfo.php",
                        dataType: "json",
                        data: { "movId": $(this).attr('id') },
                        success: function(data,status) {
                            console.log(data);
                            $("#movTitle").html(data.title);
                            //$("#type").html(data.type);
                            //$("#breed").html(data.breed);
                            $("#director").html("<strong>Directed by:</strong> " + data.director);
                            $("#year").html("<strong>Year</strong>: " + data.year);
                            $("#actors").html("<strong>Starring:</strong> " + data.actors);
                            $("#rating").html(data.ratingId + " Stars");
                            
                            var genreNames = ["Horror", "Comedy", "Animation", "Superhero", "Drama"];
                            $("#genre").html("<strong>Genre:</strong> " + genreNames[(data.genreId - 1)]);
                            
                            $("#image").attr('src', data.image);
                            // $("#container").html("");
                        }
                    }); //end AJAX
                }); //end click movLink
            }); //end document ready
            
            
        </script>
    
    </head>
    <body>
        
        <?php 
            include 'inc/header.php';
        ?>
        
        <div class='container'>
            <div class='text-left'>
        
                <h1> Bootleg - Admin Control </h1>
                
                <h3>Welcome <?= $_SESSION['adminFullName'] ?>. </h3>
             
             
             
                <br /><br />
                 
                <form action="addProduct.php">
                    <input class="btn btn-primary" type="submit" value="Add New Product">
                </form>
                
                <button type = "button" id="reports" class="btn btn-info">Generate Reports</button>
                 
                <form action="logout.php">
                    <input class="btn btn-outline-danger" type="submit" value="Logout">
                </form>
                 
                <br /><br /><br />
                
                <div id="reportDisplay">
                    <span id="avgRate"><?= averageRating()?></span> <br>
                    <span id="commonGenre"><?= commonGenre()?></span> <br>
                    <span id="highPerGenre"><?= highPerGenre()?></span> <br>
                    <br /><br /><br />
                </div>
         
        
                <?= displayAllProducts(); ?>
            </div>
        </div>
         
         
         
        <!-- Button trigger modal -->
        <!--<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">-->
        <!--  Launch demo modal-->
        <!--</button>-->
        
        <!-- Modal -->
        <div class="modal fade" id="movModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="movTitle">Movie Info</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                
                <div>
                    <img id='image' src="" width=200> <br>
                    <span id='year'></span> <br>
                    <span id='genre'></span> <br>
                    <span id='director'></span> <br>
                    <span id='actors'></span> <br>
                    <span id='rating'></span> <br>
                </div>
                
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>


        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
        
    </body>
</html>