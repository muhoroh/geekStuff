<?php
session_start();
include '../classes/DataCalculator.php';


if(isset($_POST['url']))
{

        $url = $_POST['url'];
	$calc = new DataCalculator();
	$data = $calc->calculate($url);
	
	$_SESSION['results']  = $data;

        header('Location:index.php');
        exit;
}


?>
