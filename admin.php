<?php
session_start();

require('config.php');

$sqlQuery = $pdo->query('SELECT * FROM cars ORDER BY carIndex');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Car Hunters</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="./css/admin.css">

  
</head>
<body>
<nav class="navbar navbar-expand-md fixed-top">
  <!-- Brand -->
  <a class="navbar-brand" href="index.php">
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
        <a class="nav-link" href="addCar.php">Add a car</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="updateCar.php">Update car</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="deleteCar.php">Delete</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="viewOrders.php">Orders</a>
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
<br>
<br>
<br>
<br>
    <div class="row justify-content-center">
        <div class="col-3 text-center">
            <h2>List of all cars</h2>
            <br>
        </div>
    </div>
    <div class="container">
        <table class="table table-sm table-dark">
            <thead class='col-md-offset-2'>
                <tr>
                    <th >CarIndex</th>
                    <th>Make</th>
                    <th>Model</th>
                    <th>Reg</th>
                    <th>Colour</th>
                    <th>Miles</th>
                    <th>Price</th>
                    <th>Picture</th>
                    <th></th>
                    <th>Action</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                    
                    while($row = $sqlQuery->fetch())
                    {
                        echo "<TR>";
                            echo "<TD >".$row['carIndex']."</TD>";
                            echo "<TD>".$row['make']."</TD>";
                            echo "<TD>".$row['model']."</TD>";
                            echo "<TD>".$row['Reg']."</TD>";
                            echo "<TD>".$row['colour']."</TD>";
                            echo "<TD>".$row['miles']."</TD>";
                            echo "<TD>".$row['price']."</TD>";
                            echo "<TD><img src='images/".$row['picture']."' width=160 height=80></TD>";
                            echo "<TD><a  href='viewCarDetails.php?carIndex=".$row['carIndex']."' class='btn btn-info'>More</a></TD>";
                            echo "<TD><a href='editCarDetails.php?carIndex=".$row['carIndex']."' class='btn btn-success'>Edit</a></TD>";
                            echo "<TD><a href='deleteCar.php?carIndex=".$row['carIndex']."' class='btn btn-danger'>Delete</a></TD>";
                        echo "</TR>";
                    }
                ?>
            </tbody>
        </table>
    </div>  

<!-- Footer -->

<!-- Footer -->

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="./js/main.js"></script>
</body>
</html>
