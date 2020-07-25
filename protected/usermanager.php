<?php 
function IsUserLoggedIn() {
	return $_SESSION  != null && array_key_exists('uid', $_SESSION) && is_numeric($_SESSION['uid']);
}

function UserLogout() {
	session_unset();
	session_destroy();
	header('Location: ?P=page');
}

function UserLogin($fnev, $jelszo) {
	$query = "SELECT id,fnev,jelszo FROM users WHERE fnev = :fnev AND jelszo = :jelszo";
	$params = [
		':fnev' => test_input($fnev),
		':jelszo' => sha1(test_input($jelszo))
	]; 
	

	require_once DATABASE_CONTROLLER;
	$record = getRecord($query, $params);
	if(!empty($record)) {
		$_SESSION['uid'] = $record['id'];
		$_SESSION['fnev'] = $record['fnev'];
		$_SESSION['jelszo'] = $record['jelszo'];
		header('Location: ?P=page');
		
	}
	return false;
}

function UserRegister($email, $password, $fname, $lname) {
	$query = "SELECT id FROM users email = :email";
	$params = [ ':email' => $email ];

	require_once DATABASE_CONTROLLER;
	$record = getRecord($query, $params);
	if(empty($record)) {
		$query = "INSERT INTO users (first_name, last_name, email, password) VALUES (:first_name, :last_name, :email, :password)";
		$params = [
			':first_name' => $fname,
			':last_name' => $lname,
			':email' => $email,
			':password' => sha1($password)
		];

		if(executeDML($query, $params)) 
			header('Location: index.php?P=login');
	} 
	return false;
}
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>