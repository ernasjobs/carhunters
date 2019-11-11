<?php
  
    require 'config.php';
    session_start(); // should be at the top of your php

    if (isset($_POST['make'])) {
       $_SESSION['make'] = $_POST['make'];
    }
     $make = isset($_SESSION['make']) ? $_SESSION['make'] : "";
    if (isset($_POST['model'])) {
      $_SESSION['model'] = $_POST['model'];
   }
   $model = isset($_SESSION['model']) ? $_SESSION['model'] : "";
   
   if (isset($_POST['colour'])) {
    $_SESSION['colour'] = $_POST['colour'];
 }
 $colour = isset($_SESSION['colour']) ? $_SESSION['colour'] : "";
 if (isset($_POST['min_price'])) {
  $_SESSION['min_price'] = $_POST['min_price'];
}
$min_price = isset($_SESSION['min_price']) ? $_SESSION['min_price'] : "";
if (isset($_POST['max_price'])) {
  $_SESSION['max_price'] = $_POST['max_price'];
}
$max_price = isset($_SESSION['max_price']) ? $_SESSION['max_price'] : "";

    if (isset($_GET['pageno'])) {
      $pageno = $_GET['pageno'];
    } else {
      $pageno = 1;
    }
    $no_of_records_per_page = 2;
    $offset = ($pageno-1) * $no_of_records_per_page;
    if($make!="" AND $model!="" AND $colour!=""){
    $stmt = $pdo->prepare("SELECT * FROM cars WHERE make =? AND model=? AND colour=? ORDER BY carIndex"); 
    $stmt->execute([$make, $model,$colour]);
    $total_rows = $stmt ->rowCount();
    $total_pages = ceil($total_rows / $no_of_records_per_page);
    $stmt = $pdo->prepare("SELECT * FROM cars WHERE make ='".$make."' AND model='".$model."' AND colour ='".$colour."'  LIMIT $offset, $no_of_records_per_page "); 
$stmt->execute();}
else if(($make!="" AND $model!="" AND $colour=="")){
  $stmt = $pdo->prepare("SELECT * FROM cars WHERE make =? AND model=? ORDER BY carIndex");
    $stmt->execute([$make, $model]);
    $total_rows = $stmt ->rowCount();
    $total_pages = ceil($total_rows / $no_of_records_per_page);
    $stmt = $pdo->prepare("SELECT * FROM cars WHERE make ='".$make."' AND model='".$model."'  LIMIT $offset, $no_of_records_per_page "); 
$stmt->execute();
}else if(($make=="" AND $model=="" AND $colour!="")){
  $stmt = $pdo->prepare("SELECT * FROM cars WHERE colour =? ORDER BY carIndex");
    $stmt->execute([$colour]);
    $total_rows = $stmt ->rowCount();
    $total_pages = ceil($total_rows / $no_of_records_per_page);
    $stmt = $pdo->prepare("SELECT * FROM cars WHERE colour ='".$colour."'LIMIT $offset, $no_of_records_per_page "); 
$stmt->execute();
}
else if(($make=="" AND $model=="" AND $colour=="" AND $min_price!="" AND $max_price!="")){
  $stmt = $pdo->prepare("SELECT * FROM cars WHERE price BETWEEN :min_price AND :max_price ORDER BY carIndex");
 $stmt -> bindParam(':min_price', $min_price, PDO::PARAM_STR);
 $stmt -> bindParam(':max_price', $max_price, PDO::PARAM_STR);
    $stmt->execute([$min_price,$max_price]);
    $total_rows = $stmt ->rowCount();
    $total_pages = ceil($total_rows / $no_of_records_per_page);
    $stmt = $pdo->prepare("SELECT * FROM cars WHERE price BETWEEN  '".$min_price."' AND '".$max_price."'  LIMIT $offset, $no_of_records_per_page "); 
$stmt->execute();
}

?>
    
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Car Search Result</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,600,700" rel="stylesheet">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="./css/search.css">  
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
<br>
<br>
<br>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
  </ol>
</nav>

<div class="row">
<div class="col-md-4"></div>
<div class="col-md-8">
<h5><?php echo $total_rows.'cars(s) found' ?></h5>
<?php

while($row=$stmt->fetch())
{?>
<div class="card mb-3" style="max-width: 540px;">
<div class="card-header">
<h5 class="card-title">
  <div class="container">
    <div class="row">
      <div class="col-md-6"><?php echo $row['make']." ".$row['model']; ?></div>
      <div class="col-md-3"></div>
      <div class="col-md-3"><span class="badge  badge-success"><?php echo '£'.$row['price']; ?></span></div>
    <div>
</div>   
</h5>
  </div>
  <div class="row no-gutters">
    <div class="col-md-4">
      <img src="<?php echo 'images/'.$row["picture"];?>" class="card-img">  
    </div>
    <div class="col-md-8">
      <div class="card-body">
      <div class="row">
        <div class="col-md-3"><i class=""></i><span><?php echo $row['description']?></span></div>
        <div class="col-md-3"><i class="icon-vehicle icon-doors"></i><span><?php echo $row['Reg']?></span></div>
        <div class="col-md-3"><i class="icon-vehicle icon-colour"></i><span><?php echo $row['colour']?></span></div>
        <div class="col-md-3"><i class="icon-vehicle icon-mileage"></i><span><?php echo $row['miles']?></span></div>  
      </div>
      <br>
      <div class="row">
        <div class="col-md-6"><i class="icon-vehicle icon-doors"></i><span><?php echo $row['region']?></span></div>  
        <div class="col-md-6"><i class="icon-vehicle icon-doors"></i><span><?php echo $row['town']?></span></div>
        
      </div>
      <br>
      <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
        <a href='<?php echo "viewCarDetails.php?carIndex=".$row['carIndex'].""; ?>' class="btn btn-info btn-sm stretched-link">View</a>
        </div>
        <div class="col-md-4"></div>
      </div>
      </div>
    </div>
  </div>
</div>

<?php }?>
</div>
</div>
<div class="container">
      <ul class="pagination justify-content-center">
          <li class="page-item"><a class="page-link" href="?pageno=1">First</a></li>
          <li class="page-item <?php if($pageno <= 1){ echo 'disabled'; } ?>">
              <a class="page-link" href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>">Prev</a>
          </li>
          <li class="page-item <?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
              <a class="page-link" href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>">Next</a>
          </li>
          <li class="page-item"><a class="page-link"  href="?pageno=<?php echo $total_pages; ?>">Last</a></li>
      </ul>
    </div>

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