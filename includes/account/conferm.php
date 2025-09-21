<?php
	$user_id = intval(trim(htmlspecialchars($_GET['id'])));
	$token = trim(htmlspecialchars($_GET['token']));
	confirmUser($user_id, $token);
?>
