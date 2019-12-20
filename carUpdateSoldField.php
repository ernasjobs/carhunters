<?php
require 'config.php';
$sold=true;
$name=$_POST['name'];
$address=$_POST['addr'];
$creditcard=$_POST['cc'];

session_start(); 
$carIndex = $_SESSION['carIndex'];

$sql = "UPDATE cars SET 
            sold = :sold
            WHERE carIndex = :carIndex";
$sqlQuery = $pdo->prepare($sql);                                  

$sqlQuery->bindParam(':sold', $sold, PDO::PARAM_STR); 
$sqlQuery->bindParam(':carIndex',$carIndex , PDO::PARAM_INT); 
$sqlQuery->execute(); 
$sql1 = "INSERT INTO customer (name, address,creditcard) VALUES (?,?,?)";
$stmt= $pdo->prepare($sql1);
$stmt->execute([$name, $address,$creditcard]);



//header('Location:http://localhost/carhunters.co.uk/');

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
  <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" type="text/css" rel="stylesheet">
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
<br>
<br>
<?php
$sql = "SELECT * FROM cars WHERE  
carIndex = :carIndex";
$sqlQuery = $pdo->prepare($sql);
$sqlQuery->bindParam(':carIndex',$carIndex , PDO::PARAM_INT); 
$sqlQuery->execute([$carIndex]);
$row=$sqlQuery->fetch()


?>
<div class="jumbotron text-center">
  <p class="display-3"> Hi <strong> <?php echo $name ?> </strong></p>
  <p class="display-5">THANK YOU FOR TRUSTING US TODAY!</strong></p>
  <p class="lead"><strong>Your car <?php echo $row['make']." ".$row['model']; ?> </strong> will be ready in within 3 working days.</p>
  <hr>
  <p>
You need to bring with you the following documentation 
</p>

   <ul class="list-group list-group-horizontal justify-content-center" >
  <li class="list-group-item list-group-item-success" style="height: 40px; width:200px; padding: 5px 15px;">Passport</li>
  <li class="list-group-item list-group-item-info" style="height: 40px; width:200px;  padding: 5px 15px;">Driving License</li>
  <li class="list-group-item list-group-item-warning" style="height: 40px; width:200px;  padding: 5px 15px;">Proof of Address</li>
    </ul>
    <br>
    <p>
    We recommend you to insure your car in one of the following companies
    </p>
    <ul class="list-group list-group-horizontal justify-content-center" >
  <li class="list-group-item " style="height: 40px; width:200px; padding: 5px 15px;">
  <a href="https://www.aviva.co.uk/" target="_blank">Aviva </a>
  </li>
  <li class="list-group-item " style="height: 40px; width:200px;  padding: 5px 15px;">
  <a href="https://www.allianz.co.uk/" target="_blank">Allianz </a>
  </li>
  <li class="list-group-item " style="height: 40px; width:200px;  padding: 5px 15px;">
  <a href="https://www.directline.com/" target="_blank">Direct Line </a>
  </li>
  <li class="list-group-item r" style="height: 40px; width:200px;  padding: 5px 15px;">
  <a href="https://www.axa.co.uk/" target="_blank">AXA </a>
  </li>
 

 
</div>
</body>