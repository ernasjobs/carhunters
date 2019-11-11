
<?php
session_start();
require 'config.php';
if(isset($_POST['btnSubmit'])){
    $textUsername=$_POST['txtUsername'];
    $textPassword=$_POST['txtPass'];
    $stmt=$pdo ->prepare('SELECT * FROM login WHERE username=? AND pwd=?');
    $stmt ->execute([$textUsername,$textPassword]);
    $num_rows = $stmt->rowCount();
    if($num_rows==1)
    {
      
        $query=$stmt->fetch();
        $_SESSION['name']=$query['name'];
        $_SESSION['username']=$query['username'];
        $_SESSION['role']=$query['role'];
        if($query['role']=="admin"){
            header("Location:admin.php");
        }else if($query['role']=="user"){
          
            header("Location:index.php");
        }
     
    }
    else{
      $_SESSION['response']='Login Failed!';

    }
    
    //executing the query and storing the incoming data in $ result
   

}

?>

<!DOCTYPE html>
<html>
    <head>
      <title>Login</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
      <link rel="stylesheet" type="text/css" href="./css/main.css">
      <link rel="stylesheet" type="text/css" href="./css/login.css">
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
          
          </div>
      </nav>
          <div class="header">
            <div class="container">
              <div class="d-flex justify-content-center h-100">
                <div class="card">
                  <div class="card-header">
                    <h3>Sign In</h3>
                    <div class="d-flex justify-content-end social_icon">
                      <span><i class="fab fa-facebook-square"></i></span>
                      <span><i class="fab fa-google-plus-square"></i></span>
                      <span><i class="fab fa-twitter-square"></i></span>
                    </div>
                  </div>
                  <div class="card-body">
                    <form action="login.php" method="post">
                    <div class="input-group form-group">
                        
                        <?php 
                        if(isset($_SESSION['response'])==true){
                          echo '<h3>'.$_SESSION['response'].'</h3>';
                        }
                       
                        ?>
                        
                      </div>
                      <div class="input-group form-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-user"></i></span>
                        </div>
                        <input type="text" name="txtUsername" class="form-control" placeholder="username">
                        
                      </div>
                      <div class="input-group form-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-key"></i></span>
                        </div>
                        <input type="password" name="txtPass" class="form-control" placeholder="password">
                      </div>
                      <div class="row align-items-center remember">
                        <input type="checkbox">Remember Me
                      </div>
                      <div class="form-group">
                        <input type="submit" name="btnSubmit" value="Login" class="btn float-right login_btn">
                      </div>
                    </form>
                  </div>
                  <div class="card-footer">
                    <div class="d-flex justify-content-center links">
                      Don't have an account?<a href="register.php">Sign Up</a>
                    </div>
                  
                  </div>
                </div>
              </div>
            </div>
          </div>     
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="./js/main.js"></script>
        </body>

</html>