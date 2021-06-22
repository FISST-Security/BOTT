<?php 


require '../../config.php';

require '../functions.php';

require '../views/header.view.php';

require '../views/navbar.view.php'; 

require '../database.php';

if (isset($_SESSION['user_email'])){

$connect = connect($database);

if(!$connect){

	header('Location: ' . _SITE_URL . '/admin/controller/error.php');

	} 

$pack_id = $_GET['id'];
echo $pack_id;
$sql = "DELETE FROM member_package WHERE id=$pack_id";


if ($link->query($sql) === TRUE) {
	header('Location: ' . _SITE_URL . '/admin/controller/packages.php');
    //echo "Record deleted successfully";
}
}
else
{
	header('Location: ./login.php');	
}



?>