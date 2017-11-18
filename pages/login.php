<?php
$pageTitel = "Login page";
include('partials/header.php');

if(isset($_GET['action']) && $_GET['action'] == 'login'){
	login_user($_POST['email'], $_POST['password']);
}

if(isset($_GET['action']) && $_GET['action'] == 'signup'){
	var_dump($_FILES, $_POST);
	$data = file_get_contents( $_FILES['profilepicture']['tmp_name'] );
	$base64 = base64_encode($data);
	//var_dump($base64);
	signup_user($_POST);
}

?>
<img src="<?php echo $base64; ?>" alt="">
<?php
die();
?>

<form action="?action=login" method="POST" style="display:none">
	<fieldset class="form-group">
		<label for="inputEmail">Email-address</label>
		<input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
	</fieldset>
	<fieldset class="form-group">
		<label for="inputPassword">Kodeord</label>
		<input type="password" class="form-control" id="password" placeholder="Password" name="password">
	</fieldset>
	<button type="submit" class="btn btn-primary">Login</button>
</form>

<form action=?action=signup method="POST" enctype="multipart/form-data">
	<hr>
	<fieldset class="form-group">
		<label for="inputEmail">Email address</label>
		<input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
	</fieldset>
	<fieldset class="form-group">
		<label for="exampleInputPassword1">Kodeord</label>
		<input type="password" class="form-control" id="password" placeholder="Enter email" name="password">
	</fieldset>
	<hr>
	<fieldset class="form-group">
		<label for="inputFirstname">Fornavn</label>
		<input type="text" class="form-control" id="firstname" placeholder="Skriv fornavn" name="firstname">
	</fieldset>
	<fieldset class="form-group">
		<label for="inputLastname">Efternavn</label>
		<input type="text" class="form-control" id="lastname" placeholder="Skriv efternavn" name="lastname">
	</fieldset>
	<fieldset class="form-group">
		<label for="inputBirthday">Fødselsdag</label>
		<input type="text" class="form-control" id="birthday" placeholder="f.eks. 22/11/1992" name="birthday">
	</fieldset>
	<fieldset class="form-group">
		<label for="selectorPostcodeCity">Postnummer & By</label>
		<select class="form-control" id="postcode" name="postcode">
			<?php echo generate_zipcode_city(); ?>
		</select>
	</fieldset>
	<hr>
	<div class="radio">
		<label>
			<input type="radio" name="gender" id="optionsRadios1" value="0" checked>
			Mand
		</label>
	</div>
	<div class="radio">
		<label>
			<input type="radio" name="gender" id="optionsRadios2" value="1">
			Kvinde
		</label>
	</div>
	<hr>
	<fieldset class="form-group">
		<label for="exampleSelect1">Profession</label>
		<select class="form-control" id="profession" name="profession">
			<?php echo generate_proffesion_options(); ?>
		</select>
	</fieldset>
	<fieldset class="form-group">
		<label for="exampleInputFile">Profilbillede</label>
		<input type="file" class="form-control-file" id="profilepicture" name="profilepicture">
	</fieldset>
	
	<button type="submit" class="btn btn-primary">Submit</button>
</form>



<?php
include('partials/footer.php');
?>