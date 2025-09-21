<?php 
require 'includes/db.php';
$user_id = $_SESSION['auth']['id'];
$product_id = trim(htmlspecialchars($_GET['ref']));

$selectProduct = $bdd->prepare('SELECT quantite from istanbolmarket.panier WHERE reference = :product_ref AND users_id = :users_id');
$selectProduct->bindValue(':product_ref',$product_id, PDO::PARAM_STR);
$selectProduct->bindValue(':users_id',$user_id, PDO::PARAM_INT);
$selectProduct->execute();
$productExit = $selectProduct->fetch();
if($productExit[0] > 1){
    $deleteRequest = $bdd->prepare('UPDATE istanbolmarket.panier SET quantite = quantite - 1, pricelot = price * quantite WHERE users_id = :users_id AND reference = :product_ref');
    $deleteRequest->bindValue(':product_ref',$product_id, PDO::PARAM_STR);
    $deleteRequest->bindValue(':users_id',$user_id, PDO::PARAM_INT);
    $deleteRequest->execute();
    header("Location: index.php?page=13");
    exit();
}else{
    $deleteRequest = $bdd->prepare('DELETE FROM istanbolmarket.panier WHERE reference = :product_ref AND users_id = :users_id ');
    $deleteRequest->bindValue(':product_ref',$product_id, PDO::PARAM_STR);
    $deleteRequest->bindValue(':users_id',$user_id, PDO::PARAM_INT);
    $deleteRequest->execute();
    header("Location: index.php?page=13");
    exit();
}

