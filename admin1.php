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
        <a class="nav-link" href="addCar.php">Add a car</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="updateCar.php">Update car</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="viewOrders.php">Orders</a>
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
<br>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
  </ol>
</nav>
    <div class="row justify-content-center">
        <div class="col-3 text-center">
        <div class="input-group mb-3">
            <div class="input-group-prepend">
            <span class="input-group-text">Search</span>
            </div>
            <input type="text" id="search_text" placeholder="Search by car details" class="form-control">
        </div>
        </div>
    </div>
    <br/>
    <div class="container">
    <div id="result"></div>
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
<script>
/* 
Live database search funtionality utilizing AJAX and PHP
First, we are listening for any key to be entered in the search_text input field,
if users stops entering key, we get the value that is being entered and post that to 
fetch.php. fetch.php will make a query in database with the input text already provided 
and echo the output in result div. So we don't need to load page all the time. 

*/
$(document).ready(function(){

 load_data();

 function load_data(query)
 {
  $.ajax({
   url:"fetch.php",
   method:"POST",
   data:{query:query},
   success:function(data)
   {
    $('#result').html(data);
   }
  });
 }
 $('#search_text').keyup(function(){
  var search = $(this).val();
  if(search != '')
  {
   load_data(search);
  }
  else
  {
   load_data();
  }
 });
});
</script>
    