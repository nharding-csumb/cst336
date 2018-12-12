	<!--Add main menu here -->
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" href="#">Bootleg v2</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item
          <?php 
            if($_SESSION["page"] == "home") {
              echo " active";
            }
          ?>
          ">
            <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item 
          <?php 
            if($_SESSION["page"] == "admin") {
              echo " active";
            }
          ?>
          ">
            <a class="nav-link" href="admin.php">Admin</a>
          </li>
          <li class="nav-item 
          <?php 
            if($_SESSION["page"] == "user") {
              echo " active";
            }
          ?>
          ">
            <a class="nav-link" href="user.php">User</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="logout.php">Logout</a>
          </li>
        </ul>
      </div>
    </nav>
        
        
        <!--<div class="jumbotron">-->
        <!--  <h3> Bootleg v2 </h3>-->
        <!--  <h4> Like the original Bootleg, but slightly different </h4>-->
        <!--</div>-->
        