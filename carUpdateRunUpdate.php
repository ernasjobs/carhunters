/* 
Updates data of the car with carIndex=$$_SESSION['carIndex']

*/
<?php
require 'config.php';
session_start(); 
$carIndex = $_SESSION['carIndex'];

$sql = "UPDATE cars SET make = :make, 
            model = :model, 
            Reg = :reg,  
            colour = :colour, 
            miles = :miles,  
            price = :price,  
            dealer = :dealer,
			town = :town, 
            telephone = :telephone,  
            description = :description,  
            region = :region,  
            picture = :picture
            WHERE carIndex = :carIndex";
$sqlQuery = $pdo->prepare($sql);                                  
$sqlQuery->bindParam(':make', $_POST['make'], PDO::PARAM_STR);       
$sqlQuery->bindParam(':model', $_POST['model'], PDO::PARAM_STR);    
$sqlQuery->bindParam(':reg', $_POST['reg'], PDO::PARAM_STR);
// use PARAM_STR although a number  
$sqlQuery->bindParam(':colour', $_POST['colour'], PDO::PARAM_STR); 
$sqlQuery->bindParam(':miles', $_POST['miles'], PDO::PARAM_STR);   
$sqlQuery->bindParam(':price', $_POST['price'], PDO::PARAM_INT);   
$sqlQuery->bindParam(':dealer', $_POST['dealer'], PDO::PARAM_STR); 
$sqlQuery->bindParam(':town', $_POST['town'], PDO::PARAM_STR); 
$sqlQuery->bindParam(':telephone', $_POST['telephone'], PDO::PARAM_STR); 
$sqlQuery->bindParam(':description', $_POST['description'], PDO::PARAM_STR);   
$sqlQuery->bindParam(':region', $_POST['region'], PDO::PARAM_INT);   
$sqlQuery->bindParam(':picture', $_POST['picture'], PDO::PARAM_STR); 
$sqlQuery->bindParam(':carIndex',$carIndex , PDO::PARAM_INT); 
$sqlQuery->execute(); 
$_SESSION['updatesuccess']=true;
header('Location:http://localhost/carhunters.co.uk/editCarDetails.php?carIndex='.$carIndex);
?>
