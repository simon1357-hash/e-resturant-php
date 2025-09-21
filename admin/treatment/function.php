<?php

function str_random($length)
{
    $alphabet = "0123456789azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN";
    return substr(str_shuffle(str_repeat($alphabet, $length)), 0, $length);
}

/**
 * Summary of logUser
 * @return void
 */
function logUser(){
    require 'db.php';
    if (!empty($_POST) && !empty($_POST['email']) && !empty($_POST['password'])) {
        require 'db.php';
        $req = $bdd->prepare('SELECT * FROM lepetqwlepetit.users WHERE email = :email');
        $req -> execute(array(
            'email' => $_POST['email']
        ));
        $admin = $req->fetch();
        if ($admin === false) {
            $_SESSION['flash']['danger']=  '<i class="fas fa-time"></i> You may need a new registration';
            header("location: index.php?page=profile");
            exit();
        } elseif (password_verify($_POST['password'], $admin['password']) AND $admin['role'] === "Admin") {
            $_SESSION['auth']=$admin;
            $_SESSION['flash']['success']='<i class= "fas fa-check"></i> Wellcome to profile!';
            $msg="Wellcome to Account";
            header('location: index.php?page=profile');
            exit();
        } else {
            $_SESSION['flash']['danger']=  '<i class="fas fa-time"></i> Please check email to access to admin panel!';
             header("location: index.php?page=15");
            exit();
        }
    }
}

//  RgisterUser
function registerUser(){
    require 'db.php';
    $formPasswordValid = '/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[-+!*$@%_])([-+!*$@%_\w]{6,20})$/';
  if (!empty($_POST)) {
  
      /// Si le contenu est vide ou ne respect pas la forme imposée , une erreur sera stocker dans l'array Errors et affichée à l'utilisateur
      if (empty($_POST['lastname']) || !preg_match('/^[a-zA-Z]+$/', $_POST['lastname'])) {
          $errors['lastname'] = "Nom : champs obligatoire / Lettre uniquement.";
          $_SESSION['flash']['danger'] = "<i class='fas fa-times' style='font-size:18px;'></i>".$errors['lastname']."";
          header("Location: index.php?page=20");
          exit();
      }
      if (empty($_POST['firstname']) || !preg_match('/^[a-zA-Z]+$/', $_POST['firstname'])) {
          $errors['firstname'] = "Prenom : champs obligatoire / Lettre uniquement.";
          $_SESSION['flash']['danger'] = "<i class='fas fa-times' style='font-size:18px;'></i>".$errors['firstname']."";
          header("Location: index.php?page=20");
          exit();
      }
      /// Je vérifie aussi que l'email n'existe pas déjà.
      if (empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
          $errors['email'] = "Votre email n'est pas valide <em>(exemple@exemple.fr)</em>";
          $_SESSION['flash']['danger'] = "<i class='fas fa-times' style='font-size:18px;'></i>".$errors['email']."";
          header("Location: index.php?page=20");
          exit();
      } else {
            $req = $bdd->prepare("SELECT id FROM lepetqwlepetit.users WHERE email = :email");
            $req->bindValue(':email', $_POST['email'], PDO::PARAM_STR);
            $req->execute();
            $admin = $req->fetch();
                if($admin){
                    $errors['email'] = "Cet adresse email est déjà utilisée";
                    $_SESSION['flash']['danger'] = "<i class='fas fa-times' style='font-size:18px; mr-2'></i> ".$errors['email']."";
                    header("Location: index.php?page=15");
                    exit();
                }
            }
      /// Je vérifie aussi que le mot de passe est valide et qu'il est identique au mot de passe de confirmation
      if (empty($_POST['password']) || $_POST['password'] != $_POST['password_confirm']){
          $errors['password'] = "Mot de passe invalide <em>(6 caractères minimum avec un caractère spécial)</em>";
          $_SESSION['flash']['danger'] = "<i class='fas fa-times' style='font-size:18px;'></i>".$errors['password']."";
          header("Location: index.php?page=20");
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
        $role = "Admin";
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
            header('location: index.php?page=profile');
            exit();
            
      }
   }
 }

  // Redirection end 

 function editUser(){
    require 'db.php';
    $formPasswordValid = '/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[-+!*$@%_])([-+!*$@%_\w]{6,20})$/';
    if(!empty($_POST)){
        /// Si le contenu est vide ou ne respect pas la forme imposée , une erreur sera stocker dans l'array Errors et affichée à l'utilisateur
        if(empty($_POST['nom']) || !preg_match('/^[a-zA-Z]+$/', $_POST['nom'])){
            $errors['nom'] = "Nom : champ obligatoire / Lettre uniquement.";
            $_SESSION['flash']['danger'] = "<i class='fas fa-times' style='font-size:18px; mr-2'></i> ".$errors['nom']."";
            header("Location: index.php?page=profile");
            exit();
        }
        if(empty($_POST['prenom']) || !preg_match('/^[a-zA-Z]+$/', $_POST['prenom']) ){
            $errors['prenom'] = "Prenom : champ obligatoire / Lettre uniquement.";
            $_SESSION['flash']['danger'] = "<i class='fas fa-times' style='font-size:18px; mr-2'></i> ".$errors['prenom']."";
            header("Location: index.php?page=profile");
            exit();
        }
        /// Je vérifie aussi que l'email n'existe pas déjà.
        if(empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
            $errors['email'] = "Votre email n'est pas valide <em>(exemple@exemple.fr)</em>";
            $_SESSION['flash']['danger'] = "<i class='fas fa-times' style='font-size:18px; mr-2'></i> ".$errors['email']."";
            header("Location: index.php?page=profile");
            exit();
        }else{
            $req = $bdd->prepare('SELECT id FROM lepetqwlepetit.users WHERE email = :email AND id != :id_user');
            $req->bindValue(':email', $_POST['email']);
            $req->bindValue(':id_user', $_SESSION['auth']['id']);
            $req->execute();
            $admin = $req->fetch();
            if($admin){
                $errors['email'] = "Cet adresse email est déjà utilisée";
                $_SESSION['flash']['danger'] = "<i class='fas fa-times' style='font-size:18px; mr-2'></i> ".$errors['email']."";
                header("Location: index.php?page=profile");
                exit();
            }
        }
        /// Si il n'y a aucune erreur , on insert l'utilisateur en BDD et on envoi un mail de confirmation
        if (empty($errors)){
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
            header('location: index.php?page=profile');
            exit();
        }
    }

}

   
function uploadAvatar($id){
    require 'db.php';
    if($_FILES['photo']['error'] != 4){
        if($_FILES["photo"]["error"] === 0 ){
            $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg","png" => "image/png");
            $filename = $_FILES['photo']['name'];
            $filetype = $_FILES["photo"]["type"];
            $filesize = $_FILES["photo"]["size"];
            // Vérifie l'extension du fichier
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            $newName= uniqid().'.'.$ext;
            // Je crée le chemin que je vais insérer en BDD pour pouvoir afficher mes photo
            $avatar = "images/avatar$newName";
            if(!array_key_exists($ext, $allowed)){
                $_SESSION['flash']['danger'] = "Extension non autorisée.";
                header("Location: index.php?page=profile");
                exit();
            };
            // Vérifie la taille du fichier - 5Mo maximum
            $maxsize = 10 * 1024 * 1024;
            if($filesize > $maxsize){
                $_SESSION['flash']['danger'] = "Image trop lourde. Maximum: 10mo.";
                header("Location: index.php?page=profile");
                exit();
            };
            // Vérifie le type MIME du fichier
            if(in_array($filetype, $allowed)){
                    move_uploaded_file($_FILES['photo']['tmp_name'],$avatar);
                    $insertPicture = $bdd->prepare('UPDATE lepetqwlepetit.users
                                                    SET   picture= :picture
                                                    WHERE id = :id');
                    $insertPicture->bindValue(':picture', $avatar, PDO::PARAM_STR);
                    $insertPicture->bindValue(':id', $id, PDO::PARAM_STR);
                    $insertPicture->execute();
            } else{
                $_SESSION['flash']['danger'] = "Erreur: Il y a eu un problème de téléchargement de votre fichier. Veuillez réessayer.";
                header("Location: index.php?page=profile");
                exit();
            }
        }else{
            $_SESSION['flash']['danger'] =  "Erreur: " . $_FILES["photo"]["error"];
            header("Location: index.php?page=profile");
            exit();
         }
    }
}


    function confirmUser($id,$token){
        require 'db.php';
        $req = $bdd->prepare('SELECT * FROM lepetqwlepetit.users WHERE id = :id');
        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $req->execute();
        $user = $req->fetch();
        if(session_status() == PHP_SESSION_NONE){
            session_start();
        }
        if ($user && $user['confirmation_token'] == $token){
            $req = $bdd->prepare('UPDATE lepetqwlepetit.users SET confirmation_token = NULL, confirmed_at = NOW() WHERE id = :id');
            $req->bindValue(':id', $id, PDO::PARAM_INT);
            $req->execute();
            $_SESSION['flash']['success'] = '<i class="fas fa-check mr-2"></i>  Votre compte a bien été validé . Vous êtes connecté';
            $_SESSION['auth'] = $user;
            header("location: index.php?page=mon-profil&id=$id");
            exit();
        }else{
            $_SESSION['flash']['danger'] = '<i class="fas fa-times mr-2"></i>  Ce lien de confirmation est périmé';
            header('location:  index.php?page=1');
            exit();
        }
    }
 

    function getAdresses($id){
        require 'db.php';
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
    


function checkEdition(){
    if(isset($_GET['edit'])){
        $edit = true;
    }else{
        $edit = false;
    }
    return $edit;
}



function getOneAdresse($id_adresse){
    require 'db.php';
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

  
    function isLogged(){
        if(!isset($_SESSION['auth'])){
            $_SESSION['flash']['danger'] = "<i class='fas fa-times mr-2'></i> Vous devez être connecté";
            header("Location: index.php?page=15");
            exit();
        }
    }
    
    function unLogged(){
        if(isset($_SESSION['auth'])){
            $_SESSION['flash']['danger'] = "<i class='fas fa-times mr-2'></i> Vous êtes déjà connecté";
            header("Location: index.php?page=profile");
            exit();
        }
    }
    
    function emptyAddress(){
        if(isset($_SESSION['auth'])){
            if(getAdresses($_SESSION['auth']['id']) == false){
                $_SESSION['flash']['success'] = "<i class='fas fa-times' style='font-size:18px mr-2'></i> Veuillez ajoutez une adresse de livraison";
                header("Location: index.php?page=profile");
                exit();
            }
        }
    }
    
    function getUserById($id){
        require 'db.php';
        $req = $bdd->prepare('SELECT * FROM lepetqwlepetit.users WHERE id = :id');
        $req->bindValue(':id', $id, PDO::PARAM_STR);
        $req->execute();
        $utilisateur = $req->fetch();
        return $utilisateur;
    }
    

    function addAdresse(){
        require 'db.php';
        if(!empty($_POST)){
            if(empty($_POST['name']) || !preg_match('/^[a-zA-Z]+$/', $_POST['name'])){
                $errors['name'] = "Nom : champs obligatoire .";
                $_SESSION['flash']['danger'] = "<i class='fas fa-times' style='font-size:18px;'></i>".$errors['lastname']."";
                header("Location: index.php?page=13");
                exit();
            }
            if(empty($_POST['adresse'])){
                $errors['adresse'] = "Adresse : champs obligatoire.";
                $_SESSION['flash']['danger'] = "<i class='fas fa-times' style='font-size:18px;'></i>".$errors['adresse']."";
                header("Location: index.php?page=13");
                exit();
            }
            if(empty($_POST['cp'])){
                $errors['cp'] = "Code postal : champs obligatoire.";
                $_SESSION['flash']['danger'] = "<i class='fas fa-times' style='font-size:18px;'></i>".$errors['cp']."";
                header("Location: index.php?page=13");
                exit();
             }
            if(empty($_POST['ville'])){
                $errors['ville'] = "Ville : champs obligatoire.";
                $_SESSION['flash']['danger'] = "<i class='fas fa-times' style='font-size:18px;'></i>".$errors['ville']."";
                header("Location: index.php?page=13");
                exit();
            }
            if (empty($errors)){
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
                header('location: index.php?page=profile');
                exit();
            }
        }
    }
    
    function getUserConnected(){
        $utilisateur = $_SESSION['auth'];
        return $utilisateur;
    }
    
   
    
   