<?php
session_start();
//echo $_SESSION['captcha']['code'];
//echo strtoupper($_POST['cap']);
if( strtoupper($_POST['cap'])==$_SESSION['captcha']['code'])
	{header('Location:../login.php')
	;}else{
	//echo 'Sesión no autorizada';
	header('Location:../captcha/fuera.php');
    }
?>
