<?php 
require 'db.php';
$users_id = $_SESSION['auth']['id'];
$location_id = trim(htmlspecialchars($_GET['id']));

$deleteLiaison = $bdd->prepare('DELETE FROM lepetqwlepetit.location_users WHERE users_id = :users_id AND location_id = :location_id');
$deleteLiaison->bindValue(':users_id',$users_id, PDO::PARAM_INT);
$deleteLiaison->bindValue(':location_id',$location_id, PDO::PARAM_INT);
$deleteLiaison->execute();
$productExit = $deleteLiaison->fetch();

$deleteLocation = $bdd->prepare('DELETE FROM lepetqwlepetit.locations WHERE id = :location_id');
$deleteLocation->bindValue(':location_id',$location_id, PDO::PARAM_INT);
$deleteLocation->execute();
$productExit = $deleteLocation->fetch();

$_SESSION['flash']['success'] = "<i class='fas fa-check'></i>   L'adresse a bien été supprimée !";
header('location: index.php?page=2');
exit();