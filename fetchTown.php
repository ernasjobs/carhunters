<?php
require 'config.php';
$output='';
$town=$_POST['regionId'];
$sqlQuery=$pdo -> prepare('SELECT DISTINCT town FROM cars WHERE region=? ORDER BY town ASC');
$sqlQuery ->execute([$town]);
while($row=$sqlQuery->fetch())
{
    $output .= '<option value="'.$row["town"].'">'.$row["town"].'</option>';
}

echo $output;


?>