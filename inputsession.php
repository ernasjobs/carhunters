<?php
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
if (isset($_POST['reg'])) {
   $_SESSION['reg'] = $_POST['reg'];
   }

   $reg = isset($_SESSION['reg']) ? $_SESSION['reg'] : '%';
     
if (isset($_GET['pageno'])) {
$pageno = $_GET['pageno'];
} else {
$pageno = 1;
}

?>