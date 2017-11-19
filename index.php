<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

include('functions.php');

if(!isset($_GET['side']) && isset($_SESSION['user'])){
	$_GET['side'] = 'memberarea';
}

if(isset($_GET['side']) && isset($_SESSION['user'])){
	include('pages/' . $_GET['side'] . '.php');
} else {
	include('pages/login.php');
}




?>