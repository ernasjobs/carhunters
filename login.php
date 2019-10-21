
<?php
session_start();
$con=mysqli_connect("localhost","root","","carstore");
if(isset($_POST['btnSubmit'])){
    $textEmail=$_POST['txtEmail'];
    $textPassword=$_POST['txtPass'];

    $sql="SELECT * FROM login where email_id='{$textEmail}' and password='{$textPassword}'";
    $result=mysqli_query($con,$sql); //executing the query and storing the incoming data in $ result
    if(mysqli_num_rows($result)==1)
    {
        $query=mysqli_fetch_array($result);
        $_SESSION['name']=$query['name'];
        $_SESSION['email']=$query['email'];
        $_SESSION['role']=$query['role'];
        if($query['role']=="admin"){
            header("location:adminpanel.php");
        }else if($query['role']=="user"){
            header("location:index.php");
        }
    }

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
    </head>

        <body>
        <nav class="navbar navbar-expand-md fixed-top">
  <!-- Brand -->
  <a class="navbar-brand" href="#">
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
   <a href="#"> <i class="far fa-user"></i></a>
  </div>
</nav>
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-sm-4 col-xs-12 col-md-offset-4" style="padding-top: 100px;">
                    <form action="login.php" method="post">
                        <div class="panel panel-success">
                            <div class="panel-heading">
                                LOGIN
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" name="txtEmail" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" name="txtPass" class="form-control">
                                </div>
                                <div class="form-group">

                                    <input type="submit" name="btnSubmit" class="form-control btn btn-success">
                                </div>
                            </div>
                        </div>
                    </form>


                </div>
            </div>
        </div>
        </body>

</html>