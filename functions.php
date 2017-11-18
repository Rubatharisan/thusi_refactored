<?php
include('config/config.php');

function login_user($email, $password){
	var_dump($email, $password);
}

function generate_proffesion_options(){
	global $dbconnection;

	$query = "SELECT * FROM profession";
	$resultQuery = mysqli_query($dbconnection,$query);
	$professions = mysqli_fetch_all($resultQuery,MYSQLI_ASSOC);

	$output = "";
	foreach ($professions as $profession) {
		$output .= "<option value='".$profession['prof_id']."'>".$profession['profession']."</option>";
	}

	return $output;
}

function generate_zipcode_city(){
	global $dbconnection;

	$query = "SELECT * FROM post_codes";
	$resultQuery = mysqli_query($dbconnection,$query);
	$postcodes = mysqli_fetch_all($resultQuery,MYSQLI_ASSOC);

	$output = "";
	foreach ($postcodes as $postcode) {
		$output .= "<option value='".$postcode['post_code']."'>".$postcode['city']."</option>";
	}

	return $output;
}

function signup_user($formData){
	global $dbconnection;

	$email = $formData['email'];

	$query = "SELECT * FROM users WHERE email='".$email."'";
	$result = mysqli_query($dbconnection, $query);

	if($result->num_rows != 0){
		echo "Desværre, der allerede en som har den email adresse du prøver at tilmelde med";
		die();
	}

	$password = password_hash($formData['password'], PASSWORD_DEFAULT);


	$sql = "INSERT INTO users (email, password, fornavn, efternavn, gender_id, prof_id, birth, post_code, billede_id, cover_id)
	VALUES (
	'".$email."', 
	'".$password."', 
	'".$formData['firstname']."',
	'".$formData['lastname']."',
	'".$formData['gender']."',
	'".$formData['profession']."',
	'".$formData['birthday']."',
	'".$formData['postcode']."',
	'".$formData['']."')";

/* array(8) { ["email"]=> string(22) "player@morningtrain.dk" ["password"]=> string(6) "player" ["firstname"]=> string(4) "Ruba" ["lastname"]=> string(6) "Tester" ["birthday"]=> string(10) "22/11/1992" ["postcode"]=> string(12) "København K" ["gender"]=> string(7) "option1" ["profession"]=> string(13) "Filmkonsulent" } */

	die();

}

