<?php
function str_random($length)
{
    $alphabet = "0123456789azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN";
    return substr(str_shuffle(str_repeat($alphabet, $length)), 0, $length);
}


   /*****************
    ** UTILISATEURS **
    /****************/
    function email()
    {
        require 'includes/db.php';

        if (isset($_POST['SendEmail'])) {
            $name  = $_POST['name'];
            $email = $_POST['email'];
            $subject    = $_POST['subject'];
            $text    = $_POST['text'];
            $nr   =$_POST['nr'];

            $insert = $bdd->prepare("INSERT INTO lepetqwlepetit.email (name, email, subject, text, nr ) VALUES ( ?, ?, ?, ?, ?)");
            $insert->execute([$name,  $email, $subject, $text ,$nr]);
            if ($insert) {
                $_SESSION['flash']['success'] = " <i class='fas fa-envelope-open-text'></i>  Votre e-mail a bien été envoyé ";
                header('location: index.php?page=12 ');
                exit();
            } else {
                $error = "Votre e-mail a nespas été envoyé";
                header('location: index.php?page=12');
            }
        }
    }

function logUser()
{
    require 'includes/db.php';
    if (!empty($_POST) && !empty($_POST['email']) && !empty($_POST['password'])) {
        $req = $bdd->prepare('SELECT * FROM lepetqwlepetit.users WHERE email = :email');
        $req -> execute(array( 'email' => $_POST['email']));
        $user = $req->fetch();
        if ($user != true) {
            $_SESSION['flash']['danger']=  '<i class="fas fa-time"></i> You may need new registration';
            header("location: index.php?page=6");
            exit();
        } elseif (password_verify($_POST['password'], $user['password'])) {
            $_SESSION['auth']=$user;
            $_SESSION['flash']['success']='<i class= "fas fa-check"></i> Wellcome to profile!';
            header('location: index.php?page=11');
            exit();
        } else {
            $_SESSION['flash']['danger']=  '<i class="fas fa-time"></i> Votre mot de passe ou votre identifiant e-mail ne correspond pas!';
            header("location: index.php?page=recovery");
            exit();
        }
    }
}

/**
 * Summary of recovery
 * @return void
 */

//function resetPassword()
//{
//}


function registerUser()
{
    require 'includes/db.php';
    $formPasswordValid = '/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[-+!*$@%_])([-+!*$@%_\w]{6,20})$/';
    if (!empty($_POST)) {
  
      /// Si le contenu est vide ou ne respect pas la forme imposée , une erreur sera stocker dans l'array Errors et affichée à l'utilisateur
        if (empty($_POST['lastname']) || !preg_match('/^[a-zA-Z]+$/', $_POST['lastname'])) {
            $errors['lastname'] = "Nom : champs obligatoire / Lettre uniquement.";
            $_SESSION['flash']['danger'] = "<i class='fas fa-times' style='font-size:18px;'></i>".$errors['lastname']."";
            header("Location: index.php?page=2");
            exit();
        }
        if (empty($_POST['firstname']) || !preg_match('/^[a-zA-Z]+$/', $_POST['firstname'])) {
            $errors['firstname'] = "Prenom : champs obligatoire / Lettre uniquement.";
            $_SESSION['flash']['danger'] = "<i class='fas fa-times' style='font-size:18px;'></i>".$errors['firstname']."";
            header("Location: index.php?page=2");
            exit();
        }
        /// Je vérifie aussi que l'email n'existe pas déjà.
        if (empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "Votre email n'est pas valide <em>(exemple@exemple.fr)</em>";
            $_SESSION['flash']['danger'] = "<i class='fas fa-times' style='font-size:18px;'></i>".$errors['email']."";
            header("Location: index.php?page=2");
            exit();
        } else {
            $req = $bdd->prepare("SELECT id FROM lepetqwlepetit.users WHERE email = :email");
            $req->bindValue(':email', $_POST['email'], PDO::PARAM_STR);
            $req->execute();
            $client = $req->fetch();
            if ($client) {
                $errors['email'] = "Cet adresse email est déjà utilisée";
                $_SESSION['flash']['danger'] = "<i class='fas fa-times' style='font-size:18px; mr-2'></i> ".$errors['email']."";
                header("Location: index.php?page=11");
                exit();
            }
        }
        /// Je vérifie aussi que le mot de passe est valide et qu'il est identique au mot de passe de confirmation
        if (empty($_POST['password']) || $_POST['password'] != $_POST['password_confirm']) {
            $errors['password'] = "Mot de passe invalide <em>(6 caractères minimum avec un caractère spécial)</em>";
            $_SESSION['flash']['danger'] = "<i class='fas fa-times' style='font-size:18px;'></i>".$errors['password']."";
            header("Location: index.php?page=2");
            exit();
        }
        /// Si il n'y a aucune erreur , on insert l'utilisateur en BDD et on envoi un mail de confirmation
        if (empty($errors)) {
            $req = $bdd->prepare("INSERT INTO lepetqwlepetit.users( lastname, firstname, password, picture, email, confirmation_token,  role, created_At)
                    VALUES  (:lastname, :firstname, :password, :picture, :email, :token,  :role, :createdAt)");
            $nom = htmlspecialchars(trim($_POST['lastname']));
            $prenom =  htmlspecialchars(trim($_POST['firstname']));
            $email = htmlspecialchars(trim($_POST['email']));
            $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
            $picture = 'img/default.png';
            $createdAt = date('Y-m-d H:i:s');
            $token = str_random(60);
            $role = "Client";
            $req->bindValue(":lastname", $nom, PDO::PARAM_STR);
            $req->bindValue(":firstname", $prenom, PDO::PARAM_STR);
            $req->bindValue(":password", $password, PDO::PARAM_STR);
            $req->bindValue(":picture", $picture, PDO::PARAM_STR);
            $req->bindValue(":email", $email, PDO::PARAM_STR);
            $req->bindValue(":token", $token, PDO::PARAM_STR);
            $req->bindValue(":role", $role, PDO::PARAM_STR);
            $req->bindValue(":createdAt", $createdAt);
            $req->execute();
            

            // Redirection
            $_SESSION['flash']['success'] = "<i class='fas fa-envelope-open-text'></i>  Un email de confirmation vous a été envoyé : pensez à vérifier vos spams";
            header('location: index.php?page=3');
            exit();
        }
    }
}


 function editUser()
 {
     require 'includes/db.php';
     $formPasswordValid = '/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[-+!*$@%_])([-+!*$@%_\w]{6,20})$/';
     if (!empty($_POST)) {
         /// Si le contenu est vide ou ne respect pas la forme imposée , une erreur sera stocker dans l'array Errors et affichée à l'utilisateur
         if (empty($_POST['nom']) || !preg_match('/^[a-zA-Z]+$/', $_POST['nom'])) {
             $errors['nom'] = "Nom : champ obligatoire / Lettre uniquement.";
             $_SESSION['flash']['danger'] = "<i class='fas fa-times' style='font-size:18px; mr-2'></i> ".$errors['nom']."";
             header("Location: index.php?page=11");
             exit();
         }
         if (empty($_POST['prenom']) || !preg_match('/^[a-zA-Z]+$/', $_POST['prenom'])) {
             $errors['prenom'] = "Prenom : champ obligatoire / Lettre uniquement.";
             $_SESSION['flash']['danger'] = "<i class='fas fa-times' style='font-size:18px; mr-2'></i> ".$errors['prenom']."";
             header("Location: index.php?page=11");
             exit();
         }
         /// Je vérifie aussi que l'email n'existe pas déjà.
         if (empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
             $errors['email'] = "Votre email n'est pas valide <em>(exemple@exemple.fr)</em>";
             $_SESSION['flash']['danger'] = "<i class='fas fa-times' style='font-size:18px; mr-2'></i> ".$errors['email']."";
             header("Location: index.php?page=11");
             exit();
         } else {
             $req = $bdd->prepare('SELECT id FROM lepetqwlepetit.users WHERE email = :email AND id != :id_user');
             $req->bindValue(':email', $_POST['email']);
             $req->bindValue(':id_user', $_SESSION['auth']['id']);
             $req->execute();
             $client = $req->fetch();
             if ($client) {
                 $errors['email'] = "Cet adresse email est déjà utilisée";
                 $_SESSION['flash']['danger'] = "<i class='fas fa-times' style='font-size:18px; mr-2'></i> ".$errors['email']."";
                 header("Location: index.php?page=11");
                 exit();
             }
         }
         /// Si il n'y a aucune erreur , on insert l'utilisateur en BDD et on envoi un mail de confirmation
         if (empty($errors)) {
             $req = $bdd->prepare("UPDATE lepetqwlepetit.users
                              SET   lastname= :lastname,
                                    firstname= :firstname,
                                    email= :email
                              WHERE id = :id");
             $id = htmlspecialchars(trim($_SESSION['auth']['id']));
             $lastname = htmlspecialchars(trim($_POST['nom']));
             $firstname =  htmlspecialchars(trim($_POST['prenom']));
             $email = htmlspecialchars(trim($_POST['email']));

             $req->bindValue(":lastname", $lastname, PDO::PARAM_STR);
             $req->bindValue(":firstname", $firstname, PDO::PARAM_STR);
             $req->bindValue(":email", $email, PDO::PARAM_STR);
             $req->bindValue(":id", $id, PDO::PARAM_INT);
             $req->execute();
             uploadAvatar($id);
             $_SESSION['auth'] = getUserById($id);

             // Redirection
             $_SESSION['flash']['success'] = "<i class='fas fa-check mr-2'></i> Votre profil a bien été modifié !";
             header('location: index.php?page=11');
             exit();
         }
     }
 }

    function uploadAvatar($id)
    {
        require 'includes/db.php';
        if ($_FILES['photo']['error'] != 4) {
            if ($_FILES["photo"]["error"] === 0) {
                $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg","png" => "image/png");
                $filename = $_FILES['photo']['name'];
                $filetype = $_FILES["photo"]["type"];
                $filesize = $_FILES["photo"]["size"];
                // Vérifie l'extension du fichier
                $ext = pathinfo($filename, PATHINFO_EXTENSION);
                $newName= uniqid().'.'.$ext;
                // Je crée le chemin que je vais insérer en BDD pour pouvoir afficher mes photo
                $avatar = "img/avatar/$newName";
                if (!array_key_exists($ext, $allowed)) {
                    $_SESSION['flash']['danger'] = "Extension non autorisée.";
                    header("Location: index.php?page=11");
                    exit();
                };
                // Vérifie la taille du fichier - 5Mo maximum
                $maxsize = 10 * 1024 * 1024;
                if ($filesize > $maxsize) {
                    $_SESSION['flash']['danger'] = "Image trop lourde. Maximum: 10mo.";
                    header("Location: index.php?page=11");
                    exit();
                };
                // Vérifie le type MIME du fichier
                if (in_array($filetype, $allowed)) {
                    move_uploaded_file($_FILES['photo']['tmp_name'], $avatar);
                    $insertPicture = $bdd->prepare('UPDATE lepetqwlepetit.users
                                                        SET   picture= :picture
                                                        WHERE id = :id');
                    $insertPicture->bindValue(':picture', $avatar, PDO::PARAM_STR);
                    $insertPicture->bindValue(':id', $id, PDO::PARAM_STR);
                    $insertPicture->execute();
                } else {
                    $_SESSION['flash']['danger'] = "Erreur: Il y a eu un problème de téléchargement de votre fichier. Veuillez réessayer.";
                    header("Location: index.php?page=11");
                    exit();
                }
            } else {
                $_SESSION['flash']['danger'] =  "Erreur: " . $_FILES["photo"]["error"];
                header("Location: index.php?page=11");
                exit();
            }
        }
    }

    function confirmUser($id, $token){
        require 'includes/db.php';
        $req = $bdd->prepare('SELECT * FROM lepetqwlepetit.users WHERE id = :id');
        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $req->execute();
        $user = $req->fetch();
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if ($user && $user['confirmation_token'] == $token) {
            $req = $bdd->prepare('UPDATE lepetqwlepetit.users SET confirmation_token = NULL, confirmed_at = NOW() WHERE id = :id');
            $req->bindValue(':id', $id, PDO::PARAM_INT);
            $req->execute();
            $_SESSION['flash']['success'] = '<i class="fas fa-check mr-2"></i>  Votre compte a bien été validé . Vous êtes connecté';
            $_SESSION['auth'] = $user;
            header("location: index.php?page=11&id=$id");
            exit();
        } else {
            $_SESSION['flash']['danger'] = '<i class="fas fa-times mr-2"></i>  Ce lien de confirmation est périmé';
            header('location:  index.php?page=1');
            exit();
        }
    }





/**
 * Summary of isLogged
 * @return void
 */
function isLogged()
{
    if (!isset($_SESSION['auth'])) {
        $_SESSION['flash']['danger'] = "<i class='fas fa-times mr-2'></i> Vous devez être connecté";
        header("Location: index.php?page=2");
        exit();
    }
}

function unLogged()
{
    if (isset($_SESSION['auth'])) {
        $_SESSION['flash']['danger'] = "<i class='fas fa-times mr-2'></i> Vous êtes déjà connecté";
        header("Location: index.php?page=11");
        exit();
    }
}

function emptyAddress()
{
    if (isset($_SESSION['auth'])) {
        if (getAdresses($_SESSION['auth']['id']) == false) {
            $_SESSION['flash']['success'] = "<i class='fas fa-times' style='font-size:18px mr-2'></i> Veuillez ajoutez une adresse de livraison";
            header("Location: index.php?page=11");
            exit();
        }
    }
}

function getUserById($id)
{
    require 'includes/db.php';
    $req = $bdd->prepare('SELECT * FROM lepetqwlepetit.users WHERE id = :id');
    $req->bindValue(':id', $id, PDO::PARAM_STR);
    $req->execute();
    $utilisateur = $req->fetch();
    return $utilisateur;
}



function addAdresse()
{
    require 'includes/db.php';
    if (!empty($_POST)) {
        if (empty($_POST['name']) || !preg_match('/^[a-zA-Z]+$/', $_POST['name'])) {
            $errors['name'] = "Nom : champs obligatoire .";
            $_SESSION['flash']['danger'] = "<i class='fas fa-times' style='font-size:18px;'></i>".$errors['lastname']."";
            header("Location: index.php?page=11");
            exit();
        }
        if (empty($_POST['adresse'])) {
            $errors['adresse'] = "Adresse : champs obligatoire.";
            $_SESSION['flash']['danger'] = "<i class='fas fa-times' style='font-size:18px;'></i>".$errors['adresse']."";
            header("Location: index.php?page=11");
            exit();
        }
        if (empty($_POST['cp'])) {
            $errors['cp'] = "Code postal : champs obligatoire.";
            $_SESSION['flash']['danger'] = "<i class='fas fa-times' style='font-size:18px;'></i>".$errors['cp']."";
            header("Location: index.php?page=11");
            exit();
        }
        if (empty($_POST['ville'])) {
            $errors['ville'] = "Ville : champs obligatoire.";
            $_SESSION['flash']['danger'] = "<i class='fas fa-times' style='font-size:18px;'></i>".$errors['ville']."";
            header("Location: index.php?page=11");
            exit();
        }
        if (empty($errors)) {
            $req = $bdd->prepare("INSERT INTO lepetqwlepetit.locations (name, adresse,cp, ville)
                              VALUES  (:nameAdresse, :adresse, :cp, :ville)");

            $name = trim(htmlspecialchars(trim($_POST['name'])));
            $adresse =  trim(htmlspecialchars(trim($_POST['adresse'])));
            $cp = trim(htmlspecialchars(trim($_POST['cp'])));
            $ville = trim(htmlspecialchars(trim($_POST['ville'])));
            $id =  trim(htmlspecialchars(trim($_SESSION['auth']['id'])));
            // Insert une nouvelle adresse
            $req->bindValue(":nameAdresse", $name, PDO::PARAM_STR);
            $req->bindValue(":adresse", $adresse, PDO::PARAM_STR);
            $req->bindValue(":cp", $cp, PDO::PARAM_INT);
            $req->bindValue(":ville", $ville, PDO::PARAM_STR);
            $req->execute();
            // Je récupère l'adresse ajoutée
            $idCurrentAdresse = $bdd->lastInsertId();
            // Je réalise la liaison entre l'adresse et l'utilisateur connecté
            $makeRelation = $bdd->prepare("INSERT INTO lepetqwlepetit.location_users ( users_id , location_id )
                                           VALUES  (:users_id, :location_id)");
            $makeRelation->bindValue(":users_id", $id, PDO::PARAM_INT);
            $makeRelation->bindValue(":location_id", $idCurrentAdresse, PDO::PARAM_INT);
            $makeRelation->execute();

            // Redirection
            $_SESSION['flash']['success'] = "<i class='fas fa-check'></i>   L'adresse a bien été ajoutée !";
            header('location: index.php?page=11');
            exit();
        }
    }
}

function getUserConnected()
{
    $utilisateur = $_SESSION['auth'];
    return $utilisateur;
}

/**
     * Retourne les adresses d'un utilisateur
     *
     * @param int $id
     *
     * @return array
     */
    
function getAdresses($id)
{
    require 'includes/db.php';
    $requestAd = $bdd->prepare("SELECT * FROM lepetqwlepetit.location_users 
    INNER JOIN lepetqwlepetit.users 
    ON lepetqwlepetit.location_users.users_id = lepetqwlepetit.users.id
    INNER JOIN lepetqwlepetit.locations
    ON lepetqwlepetit.location_users.location_id = lepetqwlepetit.locations.id
                                WHERE users.id = :id");
    $requestAd->bindValue(':id', $id, PDO::PARAM_INT);
    $requestAd->execute();
    $data = $requestAd->fetchAll();
    return $data;
}


function checkEdition()
{
    if (isset($_GET['edit'])) {
        $edit = true;
    } else {
        $edit = false;
    }
    return $edit;
}



function getOneAdresse($id_adresse)
{
    require 'includes/db.php';
    $users_id = intval(trim(htmlspecialchars($_SESSION['auth']['id'])));
    $id = intval(trim(htmlspecialchars($id_adresse)));
    $requestAd = $bdd->prepare('SELECT * FROM lepetqwlepetit.location_users
                                INNER JOIN lepetqwlepetit.users
                                ON location_users.users_id = users.id
                                INNER JOIN lepetqwlepetit.locations
                                ON location_users.location_id = locations.id
                                WHERE users.id = :users_id
                                AND location_id = :id');
    $requestAd->bindValue(':users_id', $users_id, PDO::PARAM_INT);
    $requestAd->bindValue(':id', $id, PDO::PARAM_INT);
    $requestAd->execute();
    $data = $requestAd->fetch();
    return $data;
}



    /*************
    **  PANIER  **
    /************/



function getBasket()
{
    require 'includes/db.php';
    $id = $_SESSION['auth']['id'];
    $basketRequest = $bdd->prepare('SELECT
                                    products.name as name,
                                    products.id as idProduct,
                                    panier.price as prix,
                                    panier.quantite as quantite,
                                    panier.price as price,
                                    panier.photo as photo,
                                    panier.pricelot as prixlot,
                                    panier.reference as reference,
                                    panier.id as idPanier
                                FROM lepetqwlepetit.panier
                                INNER JOIN lepetqwlepetit.products
                                ON products.id = panier.product_id
                                WHERE users_id = :id_user');
    $basketRequest->bindValue(':id_user', $id, PDO::PARAM_INT);
    $basketRequest->execute();
    $basketReq = $basketRequest->fetchAll();
    return $basketReq;
}


function getPriceHTBasket()
{
    require 'includes/db.php';
    $id = $_SESSION['auth']['id'];
    $totalHTRequest = $bdd->prepare('SELECT SUM(pricelot)
                        FROM lepetqwlepetit.panier
                        WHERE users_id = :id_user');
    $totalHTRequest->bindValue(':id_user', $id, PDO::PARAM_INT);
    $totalHTRequest->execute();
    $totalHT = $totalHTRequest->fetch();
    return  $totalHT[0];
}

function getQuantityBasket()
{
    require 'includes/db.php';
    $users_id = $_SESSION['auth']['id'];
    $reqCountBasket = $bdd->prepare('SELECT SUM(quantite) FROM lepetqwlepetit.panier WHERE users_id = :users_id');
    $reqCountBasket->bindValue(':users_id', $users_id, PDO::PARAM_INT);
    $reqCountBasket->execute();
    $countBasket = $reqCountBasket->fetch();
    return $countBasket[0];
}

function AddOne($id, $reference)
{
    require 'includes/db.php';
    $deleteRequest = $bdd->prepare('UPDATE lepetqwlepetit.panier SET quantite = quantite + 1, pricelot = price * quantite  WHERE users_id = :users_id AND reference = :product_ref');
    $deleteRequest->bindValue(':product_ref', $reference, PDO::PARAM_STR);
    $deleteRequest->bindValue(':users_id', $id, PDO::PARAM_INT);
    $deleteRequest->execute();
    header("Location: index.php?page=13");
    exit();
}

function addProductBasket()
{
    require 'includes/db.php';
    if (!empty($_POST['name']) and
    !empty($_POST['quantity']) and
    !empty($_POST['price']) and
    !empty($_POST['photo']) and
    isset($_POST['name'],$_POST['quantity'],$_POST['price'],$_POST['photo'])
        ) {
        $name      = trim(htmlspecialchars($_POST['name']));
        $quantity  = intval(trim(htmlspecialchars($_POST['quantity'])));
        $price  = htmlspecialchars($_POST['price']);
        $photo = ($_POST['photo']);
        $reference = str_replace(' ', '-', $name);
        $users_id   = $_SESSION['auth']['id'];
        $product_id = $_GET['id'];
      

        $req = $bdd->prepare("SELECT * FROM lepetqwlepetit.panier WHERE product_id = :product_id AND reference = :reference AND users_id = :users_id");
        $req->bindValue(":product_id", $product_id, PDO::PARAM_INT);
        $req->bindValue(":reference", $reference, PDO::PARAM_STR);
        $req->bindValue(":users_id", $users_id, PDO::PARAM_INT);
        $req->execute();
        $produit = $req->fetch();
        if ($produit) {
            $updateBasket = $bdd->prepare("UPDATE lepetqwlepetit.panier SET quantite = :quantite, pricelot = :price * quantite WHERE reference = :reference AND  users_id = :users_id");
            $updateBasket->bindValue(":quantite", $quantity, PDO::PARAM_INT);
            $updateBasket->bindValue(":price", $price, PDO::PARAM_INT);
            $updateBasket->bindValue(":reference", $reference, PDO::PARAM_STR);
            $updateBasket->bindValue(":users_id", $users_id, PDO::PARAM_INT);
            $updateBasket->execute();
            $_SESSION['flash']['success'] = "<i class='fas fa-plus mr-2'></i>Article bien ajouté à votre panier.";
        } else {
            $pricelot = ['$price * $quantity'];
            $req = $bdd->prepare('INSERT INTO lepetqwlepetit.panier (reference, product_id, price, quantite, pricelot, users_id, photo)
                                    VALUES (:reference, :product_id, :price, :quantite, :pricelot, :users_id, :photo)');
            $req->bindValue(":reference", $reference, PDO::PARAM_STR);
            $req->bindValue(":product_id", $product_id, PDO::PARAM_INT);
            $req->bindValue(":price", $price, PDO::PARAM_INT);
            $req->bindValue(":quantite", $quantity, PDO::PARAM_INT);
            $req->bindValue(":pricelot", $pricelot, PDO::PARAM_INT);
            $req->bindValue(":users_id", $users_id, PDO::PARAM_INT);
            $req->bindValue(":photo", $photo, PDO::PARAM_STR);
            $req->execute();
            $_SESSION['flash']['success'] = "<i class='fas fa-plus mr-2'></i> Article ajouté à votre panier.";
        }
    }
}

function deleteItemBasket($product_ref)
{
    require 'includes/db.php';
    $user_id = $_SESSION['auth']['id'];
    $product_ref = trim(htmlspecialchars($_GET['ref']));
    $selectProduct = $bdd->prepare('SELECT quantite from lepetqwlepetit.panier WHERE reference = :product_ref AND users_id = :users_id');
    $selectProduct->bindValue(':product_ref', $product_ref, PDO::PARAM_STR);
    $selectProduct->bindValue(':users_id', $user_id, PDO::PARAM_INT);
    $selectProduct->execute();
    $productExit = $selectProduct->fetch();
    if ($productExit[0] > 1) {
        $deleteRequest = $bdd->prepare('UPDATE lepetqwlepetit.panier SET quantite = quantite - 1 WHERE users_id = :users_id AND reference = :product_ref');
        $deleteRequest->bindValue(':product_ref', $product_ref, PDO::PARAM_STR);
        $deleteRequest->bindValue(':users_id', $user_id, PDO::PARAM_INT);
        $deleteRequest->execute();
        header("Location: index.php?page=13");
        exit();
    } else {
        $deleteRequest = $bdd->prepare('DELETE FROM lepetqwlepetit.panier WHERE reference = :product_ref AND users_id = :users_id ');
        $deleteRequest->bindValue(':product_ref', $product_ref, PDO::PARAM_STR);
        $deleteRequest->bindValue(':users_id', $user_id, PDO::PARAM_INT);
        $deleteRequest->execute();
        header("Location: index.php?page=13");
        exit();
    }
}

function newCommande($totalPrice)
{
    require 'includes/db.php';
    if (!empty($_POST)) {
        /// Si le contenu est vide ou ne respect pas la forme imposée , une erreur sera stocker dans l'array Errors et affichée à l'utilisateur
        if (empty($_POST['livraison'])) {
            $errors['livraison'] =  "Livraison : champ obligatoire.";
            $_SESSION['flash']['danger'] = "<i class='fas fa-times' style='font-size:18px; mr-2'></i>".$errors['livraison']."";
            header("Location: index.php?page=confirmation-du-panier");
            exit();
        }
        /// Si il n'y a aucune erreur , on insert l'utilisateur en BDD et on envoi un mail de confirmation
        if (empty($errors)) {
            $req = $bdd->prepare("INSERT INTO lepetqwlepetit.commande
                                         ( numero ,
                                           reference ,
                                           total ,
                                           client_id ,
                                           adresse ,
                                           livraison ,
                                           date_commande ,
                                           statut_commande )
                                 VALUES  (:numero,
                                          :reference,
                                          :total,
                                          :client_id,
                                          :adresse,
                                          :livraison,
                                          :date_commande,
                                          :statut_commande)");


            $numero = htmlspecialchars(trim($_POST['numero']));
            $reference =  htmlspecialchars(trim($_POST['reference']));
            $total = intval(htmlspecialchars(trim($totalPrice)));
            $client_id = intval(htmlspecialchars(trim($_SESSION['auth']['id'])));
            $adresse = htmlspecialchars(trim($_POST['adresse']));
            $livraison = htmlspecialchars(trim($_POST['livraison']));
            $date_commande = date('Y-m-d H:i:s');
            ;
            $statut_commande = "En attente de paiement";

            $req->bindValue(":numero", $numero, PDO::PARAM_INT);
            $req->bindValue(":reference", $reference, PDO::PARAM_STR);
            $req->bindValue(":total", $total, PDO::PARAM_INT);
            $req->bindValue(":client_id", $client_id, PDO::PARAM_INT);
            $req->bindValue(":adresse", $adresse, PDO::PARAM_STR);
            $req->bindValue(":livraison", $livraison, PDO::PARAM_STR);
            $req->bindValue(":date_commande", $date_commande);
            $req->bindValue(":statut_commande", $statut_commande, PDO::PARAM_STR);
            $req->execute();
            $req = $bdd->prepare("DELETE * FROM lepetqwlepetit.panier WHERE users_id = :id");
            $req->bindValue(':id', $id, PDO::PARAM_INT);
            $req->execute();

            header('location: index.php?page=paiement');
            exit();
        }
    }
}

/**
 * Récupére la dernière commande de l'utilisateur courant
 *
 * @param float $totalPrice
 *
 * @return void
 */
function getCommande()
{
    require 'includes/db.php';
    $id = $_SESSION['auth']['id'];
    $req = $bdd->prepare("SELECT numero FROM lepetqwlepetit.commande WHERE client_id = :id ORDER BY id DESC LIMIT 1");
    $req->bindValue(':id', $id, PDO::PARAM_INT);
    $req->execute();
    $commande = $req->fetch();
    return $commande[0];
}


function getCommandeNumero($id)
{
    require 'includes/db.php';
    $id = $_SESSION['auth']['id'];
    $reqcommande = $bdd->prepare("SELECT * FROM lepetqwlepetit.commande  WHERE users.id = :id");
    $reqcommande->bindValue(':id', $id, PDO::PARAM_INT);
    $reqcommande->execute();
    $numero = $reqcommande->fetchAll();
    return $numero;
}

/**
 * Simule un paiement et envoie un mail de confirmation et vide le panier
 *
 * @param int $numero
 * @return void
 */
function validPaiement($numero)
{
    require 'includes/db.php';

    $statut = "Paiement validé";
    $id = $_SESSION['auth']['id'];
    $email = $_SESSION['auth']['email'];

    $req = $bdd->prepare("UPDATE lepetqwlepetit.commande SET statut_commande = :statut WHERE numero = :numero");
    $req->bindValue(':statut', $statut, PDO::PARAM_STR);
    $req->bindValue(':numero', $numero, PDO::PARAM_INT);
    $req->execute();
    $_SESSION['flash']['success'] = "<i class='fas fa-plus mr-2'></i> votre roue de payment bien acceptée suivez l'email.";


    $req = $bdd->prepare("DELETE * FROM lepetqwlepetit.panier WHERE users_id = :id");
    $req->bindValue(':id', $id, PDO::PARAM_INT);
    $req->execute();

    $user_id = $bdd->lastInsertId();
    $url = $_SERVER['HTTP_HOST'];
    $objet = "ISTANBUL Market- Paiement accepté";
    $message = "Votre paiement à bien été accepté !<br> <br>
    Vous trouverez en pièce jointe votre facture<br><br>
    <br>
     A très bientôt sur la ISTANBUL Market";

    // Envoi du mail
    include 'email.php';
    $email_confirm = new customMailer();
    $email_confirm->sendMail($email, $message, $objet);

    $_SESSION['flash']['success'] = "Le paiement à bien été confirmé. Un email vous a été envoyé.";
    header("Location: index.php?page=1");
    exit();
}
