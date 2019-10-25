<?php
$carIndex=$_GET['carIndex'];
require 'config.php';
$sqlQuery=$pdo->prepare('DELETE FROM cars WHERE carIndex=:carIndex');
$sqlQuery->execute(['carIndex'=>$carIndex]);
header("Location:admin.php");
?>