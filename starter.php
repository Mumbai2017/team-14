<?php 
	session_start();
	if(!isset($_SESSION['user_id']))
		header('location: login.html');
	$name = $_SESSION['username'];
	$email = $_SESSION['email'];
	$role = $_SESSION['role'];
	$phone = $_SESSION['phone'];
	$userid = $_SESSION['user_id'];
 ?>