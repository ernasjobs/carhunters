
<?php
session_start();
if(!isset($_POST['txtName']))
{
	$textName="Not data supplied";
}
else
{
	$textName=$_POST['txtName'];
}
if(!isset($_POST['txtUsername']))
{
	$textUsername="Not data supplied";
}
else
{
	$textUsername=$_POST['txtUsername'];
}

if(!isset($_POST['txtPass1']))
{
	$textPassword="Not data supplied";
}
else
{
	$textPassword=$_POST['txtPass1'];
}
if(!isset($_POST['txtEmail']))
{
	$textEmail="Not data supplied";
}
else
{
	$textEmail=$_POST['txtEmail'];
}

if(isset($_POST['btnSubmit']))
{
    require 'config.php';
    if($_POST['txtPass1']==$_POST['txtPass2']){
    $stmt=$pdo ->prepare('SELECT * FROM login WHERE username=?');
    $stmt ->execute([$textUsername]);
    $num_rows = $stmt->rowCount();
    if($num_rows==1)
    {
    header("Location:register.php?error=take");
    }
    else
        {
          $randomstring='';
         for($i=0;$i<8;$i++)
            {
             $randomstring.=chr(mt_rand(32,60));
            }
             $verifyurl="http://localhost/carhunters.co.uk/verify.php";
             $verifystring=rawurlencode($randomstring);
             $verifyemail=$_POST['txtEmail'];
             $validusername=rawurlencode($_POST['txtUsername']);
             $sql = "INSERT INTO login (name,username, pwd,email_id,verifystring,active) VALUES (?,?,?,?,?,?)";
             $stmt=$pdo ->prepare($sql);
             $stmt->execute([$textName, $textUsername, $textPassword,$textEmail,addslashes($randomstring),0]);
             $mail_body=<<<_MAIL_
              Hi $validusername,
              Please click on the following link to verify your new account:
              $verifyurl?usr=$validusername&ver=$verifystring    
              _MAIL_;
             mail($_POST['txtEmail'],"User Verification",$mail_body);
             echo '<br>';
             echo '<br>';
             echo 'A link has been emailed to the address you entered below. Please follow the link in 
             the email to validate your account';
        }
    }
    else
    {
        header("Location:register.php?error=pass");
    }

}
else
{
    switch($_GET['error'])
    {
        case "pass":
        echo 'Password do not match';
        break;
        case "taken":
        echo 'Username taken, please use another ';
        break;
        case "no":
        echo 'Incorrect login details';
    }
}

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
          <div class="header">
            <div class="container">
              <div class="d-flex justify-content-center h-100">
                <div class="card">
                  <div class="card-header">
                    <h3>Sign up</h3>
                  </div>
                  <div class="card-body">
                    <form action="register.php" method="post">
                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-user"></i></span>
                        </div>
                        <input type="text" name="txtName" class="form-control" placeholder="name">
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
                        <input type="password" name="txtPass1" class="form-control" placeholder="password">
                      </div>
                      <div class="input-group form-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-key"></i></span>
                        </div>
                        <input type="password" name="txtPass2" class="form-control" placeholder="confirm password">
                      </div>
                      <div class="input-group form-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        </div>
                        <input type="email" name="txtEmail" class="form-control" placeholder="email">
                      </div>
                      <div class="form-group">
                        <input type="submit" name="btnSubmit" value="Signup" class="btn float-right login_btn">
                      </div>
                    </form>
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