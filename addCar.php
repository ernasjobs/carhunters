<?php
session_start();
if(isset($_POST['submit']))
{   
    $result='<div class="alert alert-success alert-dismissible col-3 text-center ">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    Car added succesfully
    </div>';
    $make =$_POST['make'];
    $model = $_POST['model'];
    $Reg = $_POST['reg'];
    $colour =$_POST['colour']; 
    $miles = $_POST['miles'];
    $price = $_POST['price'];
    $dealer = $_POST['dealer'];
    $town = $_POST['town'];
    $telephone = $_POST['telephone'];
    $description = $_POST['description'];
    $region = $_POST['region'];
    $picture = $_POST['picture'];
    require 'config.php';
    $sqlQuery = $pdo->query('SELECT carIndex FROM cars ORDER BY carIndex DESC LIMIT 1');
    $row=$sqlQuery->fetch();
    $carIndex = $row['carIndex']+1;
    $sql = "INSERT INTO cars (make, model, Reg, colour, miles, price, dealer, town, telephone, description,carIndex,region, picture) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)";
    $stmt= $pdo->prepare($sql);
    $stmt->execute([$make, $model, $Reg, $colour, $miles, $price, $dealer, $town, $telephone, $description,$carIndex, $region, $picture]);
}
else
{
    $result='';
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Add Car</title>
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
            <h3>Insert Car</h3>
            <hr>
        </div>
    </div>
    <div class="row justify-content-center">
    <?php
    echo $result;
    ?>
    </div>
    <div class="container car-profile">
                <form action="addCar.php" method="POST">
                    <div class="row">
                        <div class="col-md-4">
                        </div>
                        <div class="col-md-4">
                            <div class="profile-head">                        
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">About</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="dealer-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="true">Dealer Info</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="picture-tab" data-toggle="tab" href="#image" role="tab" aria-controls="image" aria-selected="true">Image Info</a>
                                    </li>
                                </ul>  
                            </div>
                        </div>
                        <div class="col-md-4"></div>
                    </div>
                     <br>
                     <br>
                    <div class="row">
                        <div class="col-md-4">
                        </div>
                        <div class="col-md-8">
                            <div class="tab-content dealer-tab" id="myTabContent">
                                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <label>Make</label>
                                                </div>
                                                <div class="col-md-2">
                                                <input type="text" name="make">
                                                </div>
                                                <div class="col-md-8"></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <label>Model</label>
                                                </div>
                                                <div class="col-md-2">
                                                <input type="text" name="model">
                                                </div>
                                                <div class="col-md-8"></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <label>Colour</label>
                                                </div>
                                                <div class="col-md-2">
                                                <input type="text" name="colour">
                                                </div>
                                                <div class="col-md-8"></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <label>Miles</label>
                                                </div>
                                                <div class="col-md-2">
                                                <input type="text" name="miles">
                                                </div>
                                                <div class="col-md-8"></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <label>Reg</label>
                                                </div>
                                                <div class="col-md-2">
                                                <input type="text" name="reg">
                                                </div>
                                                <div class="col-md-8"></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <label>Description</label>
                                                </div>
                                                <div class="col-md-2">
                                                <input type="text" name="description">
                                                </div>
                                                <div class="col-md-8"></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <label>Price</label>
                                                </div>
                                                <div class="col-md-2">
                                                <input type="text" name="price">
                                                </div>
                                                <div class="col-md-8"></div>
                                            </div>
                                 </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <label>Dealer</label>
                                            </div>
                                            <div class="col-md-2">
                                            <input type="text" name="dealer"> 
                                            </div>
                                            <div class="col-md-8"></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-2">
                                                <label>Telephone</label>
                                            </div>
                                            <div class="col-md-2">
                                            <input type="text" name="telephone">
                                            </div>
                                            <div class="col-md-8"></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-2">
                                                <label>Town</label>
                                            </div>
                                            <div class="col-md-2">
                                            <input type="text" name="town">
                                            </div>
                                            <div class="col-md-8"></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-2">
                                                <label>Region</label>
                                            </div>
                                            <div class="col-md-2">
                                            <input type="text" name="region">
                                            </div>
                                            <div class="col-md-8"></div>
                                        </div>
                            </div>
                            <div class="tab-pane fade" id="image" role="tabpanel" aria-labelledby="image-tab">      
                            <div class="row">
                                            <div class="col-md-2">
                                                <label>File Name</label>
                                            </div>
                                            <div class="col-md-2">
                                            <input type="text" name="picture"> 
                                            </div>
                                            <div class="col-md-8"></div>
                                        </div>      
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-2"></div>
                                <div class="col-md-2">
                                <button name="submit" type="submit" class="btn btn-success" >Insert</button>
                                </div>
                                <div class="col-md-8"></div>
                            </div>

                </form>
               
              
    </div>
<!-- Footer -->

<!-- Footer -->

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="./js/main.js"></script>
</body>
</html>
