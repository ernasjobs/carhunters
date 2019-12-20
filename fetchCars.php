
<?php
  session_start();
    require 'config.php';
     // should be at the top of your php
    if (isset($_POST['make'])) {
       $_SESSION['make'] = $_POST['make'];
    }
     $make = isset($_SESSION['make']) ? $_SESSION['make'] : '%';
    if (isset($_POST['model'])) {
      $_SESSION['model'] = $_POST['model'];
   }
   $model = isset($_SESSION['model']) ? $_SESSION['model'] : '%';
   
   if (isset($_POST['colour'])) {
    $_SESSION['colour'] = $_POST['colour'];
 }
 $colour = isset($_SESSION['colour']) ? $_SESSION['colour'] : '%';
 if(isset($_POST['region']))
 { 
  $_SESSION['region'] = $_POST['region'];
}
$region = isset($_SESSION['region']) ? $_SESSION['region'] : '%';

if(isset($_POST['town']))
{ 
 $_SESSION['town'] = $_POST['town'];
}
$town = isset($_SESSION['town']) ? $_SESSION['town'] : '%';
if (isset($_POST['min_price'])) {
  $_SESSION['min_price'] = $_POST['min_price'];
}
$min_price = isset($_SESSION['min_price']) ? $_SESSION['min_price'] : '%';
if (isset($_POST['max_price'])) {
  $_SESSION['max_price'] = $_POST['max_price'];
}
$max_price = isset($_SESSION['max_price']) ? $_SESSION['max_price'] : '%';


    if (isset($_GET['pageno'])) {
      $pageno = $_GET['pageno'];
    } else {
      $pageno = 1;
    }
 
    $no_of_records_per_page = $_POST['makeId'];
    $offset = ($pageno-1) * $no_of_records_per_page;
    if($min_price=='%' AND $max_price=='%'){
    $stmt = $pdo->prepare("SELECT * FROM cars WHERE make LIKE :make AND model LIKE :model AND colour LIKE :colour
     AND region LIKE :region AND town LIKE :town OR (price  >= :min_price AND price < :max_price)  ORDER BY carIndex"); 
    $stmt->bindValue(':make',$make);
    $stmt->bindValue(':model',$model);
    $stmt->bindValue(':colour',$colour);
    $stmt->bindValue(':region',$region);
    $stmt->bindValue(':town',$town);
    $stmt->bindValue(':min_price',$min_price);
    $stmt->bindValue(':max_price',$max_price);
    $stmt->execute();
    $total_rows = $stmt ->rowCount();
    $total_pages = ceil($total_rows / $no_of_records_per_page);
    $stmt = $pdo->prepare("SELECT * FROM cars WHERE make LIKE :make AND model LIKE :model AND colour LIKE :colour
     AND region LIKE :region AND town LIKE :town OR (price >= :min_price AND price < :max_price)  ORDER BY price
     LIMIT $offset, $no_of_records_per_page "); 
    $stmt->bindValue(':make',$make);
    $stmt->bindValue(':model',$model);
    $stmt->bindValue(':colour',$colour);
    $stmt->bindValue(':region',$region);
    $stmt->bindValue(':town',$town);
    $stmt->bindValue(':min_price',$min_price);
    $stmt->bindValue(':max_price',$max_price);
    $stmt->execute();

    }else{
      $stmt = $pdo->prepare("SELECT * FROM cars WHERE make LIKE :make AND model LIKE :model AND colour LIKE :colour 
      AND region LIKE :region AND town LIKE :town AND (price >= :min_price AND price < :max_price)  ORDER BY carIndex"); 
      $stmt->bindValue(':make',$make);
      $stmt->bindValue(':model',$model);
      $stmt->bindValue(':colour',$colour);
      $stmt->bindValue(':region',$region);
      $stmt->bindValue(':town',$town);
      $stmt->bindValue(':min_price',$min_price);
      $stmt->bindValue(':max_price',$max_price);
      $stmt->execute();
      $total_rows = $stmt ->rowCount();
      $total_pages = ceil($total_rows / $no_of_records_per_page);
      $stmt = $pdo->prepare("SELECT * FROM cars WHERE make LIKE :make AND model LIKE :model AND colour LIKE :colour 
      AND region LIKE :region AND town LIKE :town AND (price >=  :min_price AND price < :max_price) ORDER BY price
      LIMIT $offset, $no_of_records_per_page  "); 
      $stmt->bindValue(':make',$make);
      $stmt->bindValue(':model',$model);
      $stmt->bindValue(':colour',$colour);
      $stmt->bindValue(':region',$region);
      $stmt->bindValue(':town',$town);
      $stmt->bindValue(':min_price',$min_price);
      $stmt->bindValue(':max_price',$max_price);
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
  
<body>
<div class="row">
<div class="col-md-4"></div>
<div class="col-md-8">
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

<div  class="container">
      <ul class="pagination justify-content-center">
          <li class="page-item"><a class="page-link" href="?pagenum=1">First</a></li>
          <li class="page-item <?php if($pagenum <= 1){ echo 'disabled'; } ?>">
              <a class="page-link" href="<?php if($pageum <= 1){ echo '#'; } else { echo "?pagenum=".($pagenum - 1); } ?>">Prev</a>
          </li>
          <li class="page-item <?php if($pagenum >= $total_pages){ echo 'disabled'; } ?>">
              <a class="page-link" href="<?php if($pagenum >= $total_pages){ echo '#'; } else { echo "?pagenum=".($pagenum + 1); } ?>">Next</a>
          </li>
          <li class="page-item"><a class="page-link"  href="?pagenum=<?php echo $total_pages; ?>">Last</a></li>
      </ul>
    </div>


<!-- Footer -->
 
</head>
</body>
</html>



