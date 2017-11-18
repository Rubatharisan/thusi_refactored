<?php

$dbconnection = mysqli_connect(
	db_hostname,
	db_username,
	db_password,
	db_database
);


if (mysqli_connect_errno()){
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  die();
}

function close_db_connection(){
	if(isset($dbconnection)){
		mysqli_close($dbconnection);
	}
}
