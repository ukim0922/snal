<?php
session_start();
require_once('class.user.php');
$user_logout = new USER();


if(isset($_GET['logout']) && $_GET['logout']=="true")
{
	$user_logout->Logout();
	$user_logout->redirect('index.php');
}
