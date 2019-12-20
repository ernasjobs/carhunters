<?php
require 'config.php';
$validusername=urldecode ($_GET['usr']);
echo $validusername;
echo '<br>';
echo $verifystring;
echo '<br>';
?>

<!DOCTYPE html>
<html>
    <head>
      <title>Signup</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
      <link rel="stylesheet" type="text/css" href="./css/main.css">
      <link rel="stylesheet" type="text/css" href="./css/signup.css">
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
      <div class="jumbotron">
  <h1 class="display-4">Hello, user!</h1>
  <?php
$stmt=$pdo ->prepare("SELECT *  FROM login WHERE username=?");
$stmt ->execute([$validusername]);
$num_rows = $stmt->rowCount();
if($num_rows==1)
{$active=1;
    
    $sql = "UPDATE login SET active=? WHERE username=?";
    $stmt= $pdo->prepare($sql);
    $user=$stmt->fetch();
$stmt->execute([$active, $validusername]);
echo '<p class="lead">Your account has now been verified.</p>
  
<p class="lead">
  <a class="btn btn-success btn-lg" href="login.php" role="button">Login</a>
</p>';

}
else
{
  echo '<p class="lead">This account could not be verified!.</p>
  
<p class="lead">
  <a class="btn btn-warning btn-lg" href="login.php" role="button">Try Again</a>
</p>';
    
}

?>
  
</div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="./js/main.js"></script>
        </body>

</html>