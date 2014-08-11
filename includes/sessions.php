<?php
	session_start();


	if(isset($_POST['disconnect']) && $_POST['disconnect']=="disconnect")
	{
		unset($_SESSION['id']);
		unset($_SESSION['pseudo']);
		header('Location: index.php?disconnected');
	}

?>