<?php
  session_start();
    require 'config.php';
     // should be at the top of your php
    function load_dropdown()
    {
      $data=array(1,2,4,6,8);
      return $data;
    }
    require ('inputsession.php');
 $no_of_records_per_page=4;
 $offset = ($pageno-1) * $no_of_records_per_page;

 if($min_price=='%' AND $max_price=='%' ){
  $stmt = $pdo->prepare("SELECT * FROM cars WHERE sold=false AND make LIKE :make AND model LIKE :model AND colour LIKE :colour 
  AND Reg LIKE :reg AND region LIKE :region AND town LIKE :town   ORDER BY carIndex"); 
  $stmt->bindValue(':make',$make);
  $stmt->bindValue(':model',$model);
  $stmt->bindValue(':colour',$colour);
  $stmt->bindValue(':region',$region);
  $stmt->bindValue(':town',$town);
  $stmt->bindValue(':reg',$reg);
  $stmt->execute();
 
  $total_rows = $stmt ->rowCount();
  $total_pages = ceil($total_rows / $no_of_records_per_page);
  $stmt = $pdo->prepare("SELECT * FROM cars WHERE  sold=false AND make LIKE :make AND model LIKE :model AND colour LIKE :colour 
    AND Reg LIKE :reg AND region LIKE :region AND town LIKE :town ORDER BY price
   LIMIT $offset, $no_of_records_per_page "); 
  $stmt->bindValue(':make',$make);
  $stmt->bindValue(':model',$model);
  $stmt->bindValue(':colour',$colour);
  $stmt->bindValue(':region',$region);
  $stmt->bindValue(':town',$town);
  $stmt->bindValue(':reg',$reg);
 
  $stmt->execute();

  }
  else{
    $stmt = $pdo->prepare("SELECT * FROM cars WHERE sold=false AND make LIKE :make AND model LIKE :model AND colour LIKE :colour 
    AND Reg LIKE :reg AND region LIKE :region AND town LIKE :town AND (price >= :min_price AND price < :max_price)  ORDER BY carIndex"); 
    $stmt->bindValue(':make',$make);
    $stmt->bindValue(':model',$model);
    $stmt->bindValue(':colour',$colour);
    $stmt->bindValue(':region',$region);
    $stmt->bindValue(':town',$town);
    $stmt->bindValue(':min_price',$min_price);
    $stmt->bindValue(':max_price',$max_price);
    $stmt->bindValue(':reg',$reg);
    
    $stmt->execute();
    $total_rows = $stmt ->rowCount();
    $total_pages = ceil($total_rows / $no_of_records_per_page);
    $stmt = $pdo->prepare("SELECT * FROM cars WHERE sold=false AND make LIKE :make AND model LIKE :model AND colour LIKE :colour 
    AND Reg LIKE :reg AND region LIKE :region AND town LIKE :town AND (price >=  :min_price AND price < :max_price) ORDER BY price
    LIMIT $offset, $no_of_records_per_page"); 
    $stmt->bindValue(':make',$make);
    $stmt->bindValue(':model',$model);
    $stmt->bindValue(':colour',$colour);
    $stmt->bindValue(':region',$region);
    $stmt->bindValue(':town',$town);
    $stmt->bindValue(':min_price',$min_price);
    $stmt->bindValue(':max_price',$max_price);
    $stmt->bindValue(':reg',$reg);
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
      echo '<a href="login.php"><p><i class="far fa-user">&nbsp;Login<p></i></a>';
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
    <li class="breadcrumb-item active" >Car Results</li>
  </ol>
</nav>

<div class="row">
<div class="col-md-4"></div>
<div class="col-md-8">
  


   <h5><?php echo  $total_rows; ?> car(s) found</h5>
 <label>Select number of records you want to see per page</label>&nbsp; 
 <select class="mdb-select md-form" name="no_records" id="no_records" searchable="Search here.." >
            <option value="" selected="true" disabled="disabled">No</option>
            <?php
            $data=load_dropdown();
            foreach ($data as $row): 
            echo '<option value="'.$row.'">'.$row.'</option>';
            ?>
            <?php endforeach ?>
            </select>
 <div id="initialSearch">
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
            </div>
            <div id="results"></div>
            <div id="pag1" class="container">
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
    <div id="pag2">
     
    </div>
    
</div>
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
</head>
</body>
</html>
<script>
$(document).ready(function(){
 $('#no_records').change(function(){

   var no_records_value = $(this).val();
   $.ajax({
    url:"fetchCars.php",
    type:"POST",
    data:{ makeId:no_records_value},
    success:function(data){
     $('#results').html(data);
     $('#pag2').html(data);
     console.log(no_records_value);
     
    }
   })
  
 });
});
var elem = document.getElementById("no_records");
elem.onchange = function(){
    var hiddenDiv = document.getElementById("initialSearch");
    var hiddenPag1=document.getElementById("pag1");
    hiddenDiv.style.display = (this.value == "") ? "block":"none";
    hiddenPag1.style.display = (this.value == "") ? "block":"none";
};
</script>
