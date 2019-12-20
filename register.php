
<?php
session_start();
?>

<!DOCTYPE html>
<html>
    <head>
      <title>Signup</title>
      <script>
      function validate(form_id,data)
      {
        var reg=/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        var address=document.forms[form_id].elements[data].value;
        if(reg.test(address)==false)
        {
          alert('Invalid email address');
          return false;
        }
      }
      </script>
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
          <div class="header">
            <div class="container">
              <div class="d-flex justify-content-center h-100">
                <div class="card">
                  <div class="card-header">
                    <h3>Sign up</h3>
                  </div>
                  <div class="card-body">
                    <form id="form_id" action="confirmaccount.php" method="post" onsubmit="javascript:return validate('form_id','email');">
                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-user"></i></span>
                        </div>
                        <input type="text" name="txtName" class="form-control" placeholder="name" required>
                      </div>
                      <div class="input-group form-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-user"></i></span>
                        </div>
                        <input type="text" name="txtUsername" class="form-control" placeholder="username" required>
                      </div>
                      <div class="input-group form-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-key"></i></span>
                        </div>
                        <input type="password" name="txtPass1" class="form-control" placeholder="password" required >
                      </div>
                      <div class="input-group form-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-key"></i></span>
                        </div>
                        <input type="password" name="txtPass2" class="form-control" placeholder="confirm password" required >
                      </div>
                      <div class="input-group form-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-key"></i></span>
                        </div>
                        <input type="text" name="addr1" class="form-control" placeholder="address 1" required >
                      </div>
                      <div class="input-group form-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-key"></i></span>
                        </div>
                        <input type="text" name="addr2" class="form-control" placeholder="address 2" required >
                      </div>
                      <div class="input-group form-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-key"></i></span>
                        </div>
                        <input type="text" name="postcode" class="form-control" placeholder="postcode" required >
                      </div>
                      <div class="input-group form-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-key"></i></span>
                        </div>
                        <input type="text" name="phone" class="form-control" placeholder="Telephone"  required>
                      </div>

                      <div class="input-group form-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        </div>
                        <input type="email" id="email" name="txtEmail" class="form-control" placeholder="email" required >
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