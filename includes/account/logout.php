<?php
	// Détruire la session.
	if(session_status() != PHP_SESSION_NONE)
	{
		// Redirection vers la page de connexion
		unset($_SESSION['auth']);
		
		$_SESSION['flash']['success'] ="<i class='fas fa-sign-out-alt'></i>
    	Vous etes bien deconnecter";
    	header("Location: ?page=1");
    	exit(); 
	}
?>
	<div class="container  mt-3">
       <div class="row">
        <div class="col-12">
            <?php if(isset($_SESSION['flash'])): ?>
                    <?php foreach($_SESSION['flash'] as $type => $message): ?>
                        <div class="alert alert-<?= $type; ?>" role="alert">
                            <?= $message; ?>
                        </div>
                    <?php endforeach; ?>
                <?php unset($_SESSION['flash']); ?>
            <?php endif; ?>
        </div>
    </div>
</div>
