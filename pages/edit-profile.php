<?php
$pageTitel = "Login page";
include('partials/header.php');

$userInfo = get_user_info();
//var_dump($userInfo);
if(isset($_GET['action']) && $_GET['action'] == 'edit'){
	save_profile($_POST, $_FILES, $userInfo);
}
?>

<form id="editProfileForm" action="?side=edit-profile&action=edit" method="POST" enctype="multipart/form-data">
	<hr>
	<fieldset class="form-group">
		<label for="inputEmail">Email address</label>
		<input type="email" class="form-control" id="email" placeholder="Enter email" name="email" value="<?php echo $userInfo['email']; ?>">
	</fieldset>
	<hr>
	<fieldset class="form-group">
		<label for="inputFirstname">Fornavn</label>
		<input type="text" class="form-control" id="firstname" placeholder="Skriv fornavn" name="firstname" value="<?php echo $userInfo['firstname']; ?>">
	</fieldset>
	<fieldset class="form-group">
		<label for="inputLastname">Efternavn</label>
		<input type="text" class="form-control" id="lastname" placeholder="Skriv efternavn" name="lastname" value="<?php echo $userInfo['lastname']; ?>">
	</fieldset>
	<fieldset class="form-group">
		<label for="inputBirthday">Fødselsdag</label>
		<input type="text" class="form-control" id="birthday" placeholder="f.eks. 22/11/1992" name="birthday" value="<?php echo $userInfo['birthday']; ?>">
	</fieldset>
	<fieldset class="form-group">
		<label for="selectorPostcodeCity">Postnummer & By</label>
		<select class="form-control" id="post_code" name="post_code">
			<?php echo generate_zipcode_city($userInfo['post_code']); ?>
		</select>
	</fieldset>
	<hr>
	<div class="radio">
		<label>
			<input type="radio" name="gender_id" id="optionsRadios1" value="0"
			<?php
			if($userInfo['gender_id'] == 0){
				echo "checked";
			}
			?>
			>
			Mand
		</label>
	</div>
	<div class="radio">
		<label>
			<input type="radio" name="gender_id" id="optionsRadios2" value="1"
			<?php
			if($userInfo['gender_id'] == 1){
				echo "checked";
			}
			?>
			>
			Kvinde
		</label>
	</div>
	<hr>
	<fieldset class="form-group">
		<label for="exampleSelect1">Profession</label>
		<select class="form-control" id="profession_id" name="profession_id">
			<?php echo generate_proffesion_options($userInfo['profession_id']); ?>
		</select>
	</fieldset>
	<fieldset class="form-group">
		<label for="exampleInputFile">Profilbillede</label>
		<img src="uploads/profile_pictures/<?php echo $userInfo['profile_picture_path']; ?>" alt="" width="150" height="150">
		<input type="file" class="form-control-file" id="profilepicture" name="profilepicture">
	</fieldset>
	
	<button type="submit" class="btn btn-primary">Submit</button>
</form>

<?php
include('partials/footer.php');
?>