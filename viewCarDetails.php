<?php
session_start();
if(!isset($_GET['carIndex']))
{
	$carIndex="Not data supplied";
}
else
{
	$carIndex=$_GET['carIndex'];
}
require 'config.php';
$sqlQuery=$pdo->prepare('SELECT * from cars WHERE carIndex=:carIndex');
$sqlQuery->execute(['carIndex'=>$carIndex]);
$num_rows = $sqlQuery->rowCount();
if($num_rows==0)
{
    echo "No records found";
}
else{
    $row=$sqlQuery->fetch();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>View Car Details</title>
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
  <?php 
  if(!empty($_COOKIE['admin']))
  {
      echo '<ul class="navbar-nav">
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
    </ul>';
    if(isset($_SESSION['name'])==true){
      
        echo '<a href="logout.php"><i class="far fa-user">'.'Hi!'.$_SESSION['name'].'Logout</i></a>';
      }
      else{
        echo '<a href="login.php"><p><i class="far fa-user">Login<p></i></a>';
      }
  }
  else
  {
    if(isset($_SESSION['name'])==true){
      
        echo '<a href="logout.php"><i class="far fa-user">'.'Hi!'.$_SESSION['name'].'Logout</i></a>';
      }
      else{
        echo '<a href="login.php"><p><i class="far fa-user">Login<p></i></a>';
      }  
  }
  ?>  
  
    
  </div>
</nav>
<br>
<br>
<br>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
    <li class="breadcrumb-item"><a href="car-search.php">Car Results</a></li>
    
  </ol>
</nav>
    <div class="row justify-content-center">
        <div class="col-3 text-center">
            <h3>Car Details</h3>
            <hr>
        </div>
    </div>
    <div class="container car-profile">
            
                <div class="row">
                    <div class="col-md-4">
                        <div class="profile-img">
                            <?php
                          echo "<img src='images/".$row['picture']."'/>"; ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="profile-head">
                        <?php         
                          echo  "<h3>".$row['make']." ".$row['model']."</h3> ";  
                        ?>     
                                    <br>                          
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">About</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="dealer-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="true">Dealer Info</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                    </div>
                    <div class="col-md-8">
                        <div class="tab-content dealer-tab" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <label>Color</label>
                                            </div>
                                            <div class="col-md-2">
                                            <?php         
                                            echo  "<p>".$row['colour']."</p> ";  
                                             ?> 
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-2">
                                                <label>Miles</label>
                                            </div>
                                            <div class="col-md-2">
                                            <?php         
                                            echo  "<p>".$row['miles']."</p> ";  
                                             ?> 
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-2">
                                                <label>Reg</label>
                                            </div>
                                            <div class="col-md-2">
                                            <?php         
                                            echo  "<p>".$row['Reg']."</p> ";  
                                             ?> 
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-2">
                                                <label>Description</label>
                                            </div>
                                            <div class="col-md-2">
                                            <?php         
                                            echo  "<p>".$row['description']."</p> ";  
                                             ?> 
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-2">
                                                <label>Price</label>
                                            </div>
                                            <div class="col-md-2">
                                            <?php         
                                            echo  "<p>£ ".$row['price']."</p> ";  
                                             ?> 
                                            </div>
                                        </div>
                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <label>Dealer</label>
                                            </div>
                                            <div class="col-md-2">
                                            <?php         
                                            echo  "<p>".$row['dealer']."</p> ";  
                                             ?> 
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-2">
                                                <label>Telephone</label>
                                            </div>
                                            <div class="col-md-2">
                                            <?php         
                                            echo  "<p>".$row['telephone']."</p> ";  
                                             ?> 
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-2">
                                                <label>Town</label>
                                            </div>
                                            <div class="col-md-2">
                                            <?php         
                                            echo  "<p>".$row['town']."</p> ";  
                                             ?> 
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-2">
                                                <label>Region</label>
                                            </div>
                                            <div class="col-md-2">
                                            <?php         
                                            echo  "<p>".$row['region']."</p> ";  
                                             ?> 
                                            </div>
                                        </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4 justify-centre">
                <a href="#" class="btn btn-danger">Buy</a>
                </div>
                <div class="col-md-4"></div>
                </div>
              
        </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="./js/main.js"></script>
</body>
</html>
