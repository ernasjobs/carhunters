/* 
makes a PDO connection to 'carstore' database
throws an exception if something went wrong.

anytime we want to make a connection to database we can include this script
by making use of require('config.php') method 
*/

<?php
$host = 'localhost';
$db   = 'carstore';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [    
PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,    
PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,    
PDO::ATTR_EMULATE_PREPARES   => false,];

try 
{    
	$pdo = new PDO($dsn, $user, $pass, $options);
} 
catch (\PDOException $e) 
{     
	throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
$config_basedir="http:127.0.0.1/carhunters.co.uk";
?>
