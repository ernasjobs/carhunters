<?php
require 'config.php';
$output='';
$make=$_POST['makeId'];
$sqlQuery=$pdo -> prepare('SELECT DISTINCT model FROM cars WHERE make=? ORDER BY model ASC');
$sqlQuery ->execute([$make]);
while($row=$sqlQuery->fetch())
{
    $output .= '<option value="'.$row["model"].'">'.$row["model"].'</option>';
}

echo $output;


?>