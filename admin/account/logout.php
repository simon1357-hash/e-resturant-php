<?php

	// Détruire la session.
	if(session_status() != PHP_SESSION_NONE)
	{
		// Redirection vers la page de connexion
		unset($_SESSION['auth']);
		
		$_SESSION['flash']['succes']="<i class='fas fa-sign-out-alt'></i>
    	Vous etes bien deconnecter";
    	header("Location: index.php?page=1");
    	exit(); 
	}
?>
