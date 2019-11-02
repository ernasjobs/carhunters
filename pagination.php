<?php
require 'config.php';
$numperpage=100;
$start=0;
$countsql=$pdo ->prepare('SELECT * FROM cars');
$countsql->execute();
$numrecords=$countsql->rowCount();
$numlinks=ceil($numrecords/$numperpage);
echo 'Number of pag links is '.$numlinks;
if(!isset($_GET['start']))
{
    $page=0;
}
else
{
$page=$_GET['start'];
}

$start=$page*$numperpage;
$countsql=$pdo ->prepare("SELECT * FROM cars ORDER BY carIndex LIMIT $start,$numperpage");
$countsql->execute();
echo '<table>';
echo '<body>';
while($row = $countsql->fetch())
{
    echo "<TR>";
        echo "<TD >".$row['carIndex']."</TD>";
        echo "<TD>".$row['make']."</TD>";
        echo "<TD>".$row['model']."</TD>";
        echo "<TD>".$row['Reg']."</TD>";
        echo "<TD>".$row['colour']."</TD>";
        echo "<TD>".$row['miles']."</TD>";
        echo "<TD>".$row['price']."</TD>";
        echo "<TD><img src='images/".$row['picture']."' width=160 height=80></TD>";
        echo "<TD><a  href='viewCarDetails.php?carIndex=".$row['carIndex']."' class='btn btn-info'>More</a></TD>";
        echo "<TD><a href='editCarDetails.php?carIndex=".$row['carIndex']."' class='btn btn-success'>Edit</a></TD>";
        echo "<TD><a href='deleteCar.php?carIndex=".$row['carIndex']."' class='btn btn-danger'>Delete</a></TD>";
    echo "</TR>";
}
echo '</tbody>';

echo '</table>';
for ($i=0;$i<$numlinks;$i++)
{
    $y=$i+1;
    
    echo '<a href="pagination.php?start='.$i.'">'.$y.'</a> ';
}


?>