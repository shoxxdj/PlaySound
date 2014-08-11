<?php
	require_once('includes/sessions.php');
	if(isset($_SESSION['id']))
		{
			include('includes/head_log.php.inc');
			require_once('includes/bdd.php');
?>