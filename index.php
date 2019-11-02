<?php
session_start();
if (isset($_COOKIE["admin"])) {
        
  setcookie("admin", "", time()-3600);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Car Hunters</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="./css/main.css">

  
</head>
<body>
<nav class="navbar navbar-expand-md fixed-top">
  <!-- Brand -->
  <a class="navbar-brand" href="">
    CarHunterLogo
  </a>

  <!-- Toggler/collapsibe Button -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>

  <!-- Navbar links -->
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="#">Buy a car</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Sell your car</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">About</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Contact</a>
      </li>
      
    </ul>
    <?php 
    if(isset($_SESSION['name'])==true){
      
      echo '<a href="logout.php"><i class="far fa-user">'.'Hi!'.$_SESSION['name'].'Logout</i></a>';
    }
    else{
      echo '<a href="login.php"><p><i class="far fa-user">Login<p></i></a>';
    }
    ?>
   
  </div>
</nav>
<header class="header">
  <div class="overlay"></div>
  <div class="usergreeting">
  <h1>Hi...!</h1> 
  </div>
  <div class="searcharea">
  <div class="container">
    <form>
      <h3 class="text-center">Find your favourite car</h3>
      <table>
        <tr>
          <td>
            <select class="mdb-select md-form" searchable="Search here..">
            <option value="" disabled selected>Select make</option>
            <option value="1">Isuzu</option>
            <option value="2">Jeep</option>
            <option value="3">Kia</option>
            <option value="3">Lexus</option>
            <option value="3">VW</option>
          </select>
        </td>
          <td>
            <select class="mdb-select md-form" searchable="Search here..">
            <option value="" disabled selected>Select model</option>
            <option value="1">Troper</option>
            <option value="2">Pride</option>
            <option value="3">Cheroke</option>
            <option value="3">Passat</option>
            <option value="3">Golf Gti</option>
          </select>
          </td>
          <td>
            <select class="mdb-select md-form" searchable="Search here..">
            <option value="" disabled selected>Select colour</option>
            <option value="1">Blue</option>
            <option value="2">Red</option>
            <option value="3">Geen</option>
            <option value="3">Black</option>
            <option value="3">White</option>
          </select>
          </td>
        </tr>
        <tr>
          <td></td>
          <td>
            <select class="mdb-select md-form" searchable="Search here..">
            <option value="" disabled selected>Select region</option>
            <option value="1">E</option>
            <option value="2">W</option>
            <option value="3">SW</option>
            <option value="3">N</option>
            <option value="3">C</option>
            </select>
          </td>
          <td>
            <select class="mdb-select md-form" searchable="Search here..">
            <option value="" disabled selected>Select town</option>
            <option value="1">Peterborough</option>
            <option value="2">Cambridge</option>
            <option value="3">London</option>
            <option value="3">Boston</option>
            <option value="3">Spalding</option>
          </select>
          </td>
        </tr>
        <tr>
          <td></td>
          <td></td>
          <td></td>
        </tr>
        <tr>
          <td></td>
          <td><button type="button" class="btn btn-danger">Search</button></td>
          <td></td>
        </tr>
      </table>
    </form>
  </div>
</header>
</div>
<div class="cardeals" id="cardeals">
  <div class="container">
  <h1>Latest Car Deals</h1>
    <div class="row">
      <?php 
      require 'config.php';
      $sqlQuery=$pdo->query('SELECT * FROM cars  ORDER BY `carIndex` DESC LIMIT 3');
      while($row = $sqlQuery->fetch())
      {
        ?>
        <div class="col-lg-4 col-md-4 col-sm-12">
        <div class="card">
          <div class="card-img">
            <img src="<?php echo 'images/'.$row['picture'];?>" class="img-f+
            luid">  
          </div >
          <div class="card-body">
            <h4 class="card-title"><?php echo $row['make']." ".$row['model']; ?><span class="badge  badge-info">New</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="badge  badge-success"><?php echo '£'.$row['price']; ?></span>  </h4>
            
            <p class="card-text"><?php echo $row['colour'].' | '.$row['description'].' | '.$row['miles'].' | '.$row['town']; ?></p>
          </div>
          <div class="card-footer">
            <a href='<?php echo "viewCarDetails.php?carIndex=".$row['carIndex'].""; ?>' class="btn btn-primary stretched-link">View</a>
          </div>  
        </div>
      </div>
      <?php } ?> 
      
    </div> 
  </div>  
</div>
<!-- Footer -->
<footer class="page-footer font-small blue">

  <!-- Copyright -->
  <div class="footer-copyright text-center py-3">© 2019 Copyright:
    <a href="#"> CarHunters</a>
  </div>
  <!-- Copyright -->

</footer>
<!-- Footer -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="./js/main.js"></script>
</body>
</html>
