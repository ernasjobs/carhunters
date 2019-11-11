<?php
session_start();
setcookie('admin','root',time()+36000);
require('config.php');
if(isset($_SESSION['role']) AND $_SESSION['role']=='admin')
{
if (isset($_GET['pageno'])) {
  $pageno = $_GET['pageno'];
} else {
  $pageno = 1;
}
$no_of_records_per_page = 4;
$offset = ($pageno-1) * $no_of_records_per_page;
$total_pages_sql = "SELECT * FROM cars";
$result =$pdo->prepare($total_pages_sql);
$result->execute();
$total_rows = $result ->rowCount();
$total_pages = ceil($total_rows / $no_of_records_per_page);
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
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
  </ol>
</nav>
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
                    $sql = "SELECT * FROM cars ORDER BY carIndex LIMIT $offset, $no_of_records_per_page";
                    $res_data = $pdo->prepare($sql);
                    $res_data ->execute();
                    while($row = $res_data->fetch())
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
    
<!-- Footer -->

<!-- Footer -->

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="./js/main.js"></script>
</body>
</html>
                 <?php } ?>
                