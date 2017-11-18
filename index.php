<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('functions.php');

if(!isset($_GET['side']) && isset($_SESSION['user'])){
	$_GET['side'] = 'memberarea.php';
}

if(isset($_GET['side']) && isset($_SESSION['user'])){
	include('pages/' . $_GET['side']);
} else {
	include('pages/login.php');
}

?>