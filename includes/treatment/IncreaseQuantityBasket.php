<?php 
require 'includes/db.php';
$user_id = $_SESSION['auth']['id'];
$product_id = trim(htmlspecialchars($_GET['ref']));
$deleteRequest = $bdd->prepare('UPDATE istanbolmarket.panier SET quantite = quantite + 1, pricelot = price * quantite  WHERE users_id = :users_id AND reference = :product_ref');
$deleteRequest->bindValue(':product_ref',$product_id, PDO::PARAM_STR);
$deleteRequest->bindValue(':users_id',$user_id, PDO::PARAM_INT);
$deleteRequest->execute();
header("Location: index.php?page=13");
exit();

