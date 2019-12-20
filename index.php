<?php
session_start();
require 'indexsessions.php';
/*
 Javascript function which connects to database and
 selects all makes, to get rid of repeated data we 
 have used DISTINCT keyword
 */

function load_make()
{
  $data='';
  require 'config.php';
  $sqlMake=$pdo->prepare('SELECT DISTINCT make FROM cars ORDER BY make ASC');
  $sqlMake ->execute();
  $data=$sqlMake-> fetchAll();
  return $data;
}
function load_colour()
{
  $data='';
  require 'config.php';
  $sqlMake=$pdo->prepare('SELECT DISTINCT colour FROM cars ORDER BY colour ASC');
  $sqlMake ->execute();
  $data=$sqlMake-> fetchAll();
  return $data;
}
function load_region()
{
  $data='';
  require 'config.php';
  $sqlMake=$pdo->prepare('SELECT DISTINCT region FROM cars ORDER BY region ASC');
  $sqlMake ->execute();
  $data=$sqlMake-> fetchAll();
  return $data;
}
function load_reg()
{
  $data='';
  require 'config.php';
  $sqlMake=$pdo->prepare('SELECT DISTINCT Reg FROM cars ORDER BY Reg ASC');
  $sqlMake ->execute();
  $data=$sqlMake-> fetchAll();
  return $data;
}
function load_price()
{
  $data='';
  require 'config.php';
  $sqlMake=$pdo->prepare('SELECT DISTINCT price FROM cars ORDER BY price ASC');
  $sqlMake ->execute();
  $data=$sqlMake-> fetchAll();
  return $data;
}
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
  <a class="navbar-brand" href="index.php">
    <img src="images/logo.png" alt="logo">
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
      
      echo '<a href="logout.php"><i class="far fa-user">&nbsp;Logout</i></a>';
    }
    else{
      echo '<a href="login.php"><i class="far fa-user">&nbsp;Login</i></a>';
    }
    ?>
  </div>
</nav>
<header class="header">
  <div class="searcharea">
  <div class="container">
    <form action="carsearch1.php" method="post">
      <h3 class="text-center">Find your favourite car</h3>
      <table>
        <tr>
          <td>
            <select class="mdb-select md-form" name="make" id="make" searchable="Search here..">
            <option value="" selected="true" disabled="disabled">Select Make</option>
            <?php
            $data=load_make();
            foreach ($data as $row): 
            echo '<option value="'.$row["make"].'">'.$row["make"].'</option>';
            ?>
            <?php endforeach ?>
            </select>
        </td>
          <td>
            <select name="model" id="model" class="mdb-select md-form" searchable="Search here..">
            <option value="" disabled selected>Select model</option>
           
          </select>
          </td>
          <td>
            <select name="colour" id="colour" class="mdb-select md-form" searchable="Search here..">
            <option value="" disabled selected>Select colour</option>
            <?php
            $data=load_colour();
            foreach ($data as $row): 
            echo '<option value="'.$row["colour"].'">'.$row["colour"].'</option>';
            ?>
            <?php endforeach ?>
          </select>
          </td>
        </tr>
        <tr>
          <td>
          <select name="reg" id="reg" class="mdb-select md-form" searchable="Search here..">
            <option value="" disabled selected>Select Reg</option>
            <?php 
            $data=load_reg();
            foreach ($data as $row): 
            echo '<option value="'.$row["Reg"].'">'.$row["Reg"].'</option>';
            ?>
            <?php endforeach ?>
            </select>
          </td>
          <td>
            <select name="region" id="region" class="mdb-select md-form" searchable="Search here..">
            <option value="" disabled selected>Select region</option>
            <?php 
            $data=load_region();
            foreach ($data as $row): 
            echo '<option value="'.$row["region"].'">'.$row["region"].'</option>';
            ?>
            <?php endforeach ?>
            </select>
          </td>
          <td>
            <select name="town" id="town" class="mdb-select md-form" searchable="Search here..">
            <option value="" disabled selected>Select town</option>
            
          </select>
          </td>
        </tr>
        <tr>
          <td></td>
          <td>
            <select name="min_price" id="min_price" class="mdb-select md-form" searchable="Search here..">
            <option value="" disabled selected>Min price</option>
            <?php 
            $data=load_price();
            foreach ($data as $row): 
            echo '<option value="'.$row["price"].'">'.$row["price"].'</option>';
            ?>
            <?php endforeach ?>
            </select>
          </td>
          <td>
            <select name="max_price" id="max_price" class="mdb-select md-form" searchable="Search here..">
            <option value="" disabled selected>Max price</option>
            <?php 
            $data=load_price();
            foreach ($data as $row): 
            echo '<option value="'.$row["price"].'">'.$row["price"].'</option>';
            ?>
            <?php endforeach ?>
            
          </select>
          </td>
        </tr>
        <tr>
          <td></td>
          <td><input type="submit" name="submit" class="btn btn-danger" value="Search"></td>
          <td></td>
        </tr>
       
      </table>
    </form>
  </div>
</header>
</div>
<!- 
in  this div we echo the details of the last three cars in our database 
the output is echoed in a card component
->
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
<script>
  /* load new data in model dropdown list,
     and removes old one on each selection of make dropdown list
   */
$(document).ready(function(){
 $('#make').change(function(){

   var make_id = $(this).val();
   $.ajax({
    url:"fetchModel.php",
    method:"POST",
    data:{ makeId:make_id},
    success:function(data){
     $('#model').html(data);
    }
   })
  
 });
});
</script>
<script>
$(document).ready(function(){
 $('#region').change(function(){

   var region_id = $(this).val();
   $.ajax({
    url:"fetchTown.php",
    method:"POST",
    data:{ regionId:region_id},
    success:function(data){
     $('#town').html(data);
    }
   })
  
 });
});
</script>

