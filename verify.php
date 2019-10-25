<?php
require 'config.php';
$validusername=rawurldecode ($_GET['usr']);
$verifystring=rawurldecode ($_GET['ver']);
echo $validusername;
echo '<br>';
echo $verifystring;
echo '<br>';

$stmt=$pdo ->prepare("SELECT *  FROM login WHERE username=? AND verifystring=?");
$stmt ->execute([$validusername,$verifystring]);
$num_rows = $stmt->rowCount();
if($num_rows==1)
{$active=1;
    
    $sql = "UPDATE login SET active=? WHERE user_id=?";
    $stmt= $pdo->prepare($sql);
    $user=$stmt->fetch();
$stmt->execute([$active, $user['user_id']]);
echo 'Your account has now been verified.';

}
else
{
    echo 'This account could not be verified!';
}

?>