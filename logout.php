<?php
	session_start();
	if($_GET['salir'])
	{
		session_unset();
		session_destroy();
		header('Location: index.php');
	}