<?php
include('config/config.php');

function login_user($email, $password){
	global $dbconnection;

	$query = "SELECT * FROM users WHERE email = '".$email."' LIMIT 1";
	$user = mysqli_query($dbconnection,$query)->fetch_assoc();

	if($user){
		if(password_verify($password, $user['password'])){
			$_SESSION['user'] = $user;
			refresh();
		} else {
			echo "Koden passer ikke overens med brugeren";
		}
	} else {
		echo "Brugeren eksistere ikke";
	}
}

function generate_proffesion_options($profession_id = null){
	global $dbconnection;

	$query = "SELECT * FROM profession";
	$resultQuery = mysqli_query($dbconnection,$query);
	$professions = mysqli_fetch_all($resultQuery,MYSQLI_ASSOC);

	$output = "";
	foreach ($professions as $profession) {
		if(isset($profession_id) && $profession_id == $profession['prof_id']){
			$output .= "<option value='".$profession['prof_id']."' selected>".$profession['profession']."</option>";
		} else {
			$output .= "<option value='".$profession['prof_id']."'>".$profession['profession']."</option>";
		}
	}

	return $output;
}

function generate_zipcode_city($postcode_id = null){
	global $dbconnection;

	$query = "SELECT * FROM post_codes";
	$resultQuery = mysqli_query($dbconnection,$query);
	$postcodes = mysqli_fetch_all($resultQuery,MYSQLI_ASSOC);

	$output = "";
	foreach ($postcodes as $postcode) {
		if(isset($postcode_id) && $postcode_id == $postcode['post_code']){
			$output .= "<option value='".$postcode['post_code']."' selected>".$postcode['city']."</option>";
		} else {
			$output .= "<option value='".$postcode['post_code']."'>".$postcode['city']."</option>";
		}
	}

	return $output;
}

function signup_user($formData, $formFiles){
	global $dbconnection;

	$email = $formData['email'];

	$query = "SELECT * FROM users WHERE email='".$email."'";
	$result = mysqli_query($dbconnection, $query);

	if($result->num_rows != 0){
		echo "Desværre, der allerede en som har den email adresse du prøver at tilmelde med";
		die();
	}


	$password = password_hash($formData['password'], PASSWORD_DEFAULT);
	$profilePicturePath = $_FILES['profilepicture']['tmp_name'];
	$profilePictureName = $_FILES['profilepicture']['name'];
	$profilePictureExtension = pathinfo($profilePictureName, PATHINFO_EXTENSION);
	$hashSum = md5($profilePicturePath);

	$profilePicturePath = rename($profilePicturePath, './uploads/profile_pictures/' . $hashSum . "." . $profilePictureExtension);

	$profilePictureID = $hashSum . "." . $profilePictureExtension;


	$query = "INSERT INTO users (email, password, firstname, lastname, gender_id, profession_id, birthday, post_code, profile_picture_path)
	VALUES (
	'".$email."', 
	'".$password."', 
	'".$formData['firstname']."',
	'".$formData['lastname']."',
	'".$formData['gender']."',
	'".$formData['profession']."',
	'".$formData['birthday']."',
	'".$formData['postcode']."',
	'".$profilePictureID."')";


	$dbResponse = mysqli_query($dbconnection,$query);
	if($dbResponse){
		$_SESSION['user']['email'] = $email;
		$_SESSION['user']['firstname'] = $formData['firstname'];
		$_SESSION['user']['lastname'] = $formData['lastname'];
		refresh();
	}


}

function get_user_info(){
	global $dbconnection;

	$query = "SELECT * FROM users WHERE email = '".$_SESSION['user']['email']."' LIMIT 1";
	$user = mysqli_query($dbconnection,$query)->fetch_assoc();

	return $user;
}

function save_profile($formData, $formFiles, $userInfo){
	global $dbconnection; 

	foreach ($formData as $key => $value) {
		$userInfo[$key] = $value;
	}

	if($formFiles['profilepicture']['size'] > 0){
		$profilePicturePath = $formFiles['profilepicture']['tmp_name'];
		$profilePictureName = $formFiles['profilepicture']['name'];
		$profilePictureExtension = pathinfo($profilePictureName, PATHINFO_EXTENSION);
		$hashSum = md5($profilePicturePath);

		$profilePicturePath = rename($profilePicturePath, './uploads/profile_pictures/' . $hashSum . "." . $profilePictureExtension);

		$profilePictureID = $hashSum . "." . $profilePictureExtension;
		$userInfo['profile_picture_path'] = $profilePictureID;
	}


	$query = "UPDATE users SET
	email = '".$userInfo['email']."', 
	firstname = '".$userInfo['firstname']."',
	lastname = '".$userInfo['lastname']."',
	gender_id = '".$userInfo['gender_id']."',
	profession_id = '".$userInfo['profession_id']."',
	birthday = '".$userInfo['birthday']."',
	post_code = '".$userInfo['post_code']."',
	profile_picture_path = '".$userInfo['profile_picture_path']."'
	WHERE user_id = ".$userInfo['user_id']."";

	$execute = mysqli_query($dbconnection,$query);
	refresh("?side=edit-profile");
}

function refresh($page = '?'){
	echo '<script type="text/javascript">
	window.location = "'.$page.'"
	</script>';
}

?>