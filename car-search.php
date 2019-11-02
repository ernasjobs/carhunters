<?php
$make=$_POST['make'];
$model=$_POST['model'];
require 'config.php';
$stmt=$pdo ->prepare('SELECT * FROM cars WHERE make=? AND model=?');
$stmt ->execute([$make,$model]);
$query=$stmt->fetch();
while ($row = $stmt->fetch())
{    
    echo $row['make'];   
    echo '<br>';
    echo $row['model'];
    echo '<br>';
    echo $row['colour'];
    echo '<br>';
    echo $row['Reg'];
    echo '<br>';

}
?>