<?php 



session_start();
if (isset($_SESSION['user_email'])){
    
    
require '../../config.php';
require '../functions.php';
require '../views/header.view.php';
require '../views/navbar.view.php'; 

$connect = connect($database);
if(!$connect){
	header('Location: ' . _SITE_URL . '/admin/controller/error.php');
	}  


require '../views/new.edgeNode.view.php';
require '../views/footer.view.php';


}else {
		header('Location: ./login.php');		
		}


?>