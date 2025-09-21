<?php
isLogged();
$user = getUserConnected();
$adresses = getAdresses($user['id']);
editUser();

?>
<?php if(empty($adresses)){ ?>
        <div class="container box-adresse-empty">
            <div class="row">
                <div class="col-md-12">
                    <i class="fas fa-info-circle"></i>
                    Veuillez renseigner une adresse :
                    <a href="index.php?page=ajouter-une-adresse"> Cliquez ici</a>
                </div>
            </div>
        </div>
<?php } ?>
<div class="container container-profil my-3">
    <div class="main-body">
        <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
                <div class="card-profil">
                    <div class="card-profil-body">
                        <div class="d-flex flex-column align-items-center text-center">
                        <img src="<?= $user['picture'] ?>" alt="Admin"  class="img-fluid"  height="300px" width="200px">
                            <div class="mt-3">
                            <h4><?= $user['lastname'].' '.$user['firstname'] ?></h4>
                                    <?php if(empty($adresses)){ ?>
                                        <p class="text-muted font-size-sm"> <br>
                                            Aucune adresse, pensez à en ajouter une.
                                            <a href="index.php?page=ajouter-une-adresse"
                                                style="color:rgba(72, 52, 212,1.0); text-decoration:none">
                                                <strong>Cliquez ici</strong>
                                            </a>
                                        </p>
                                    <?php }else{ ?>
                                        <p class="text-muted font-size-sm"> Nombre de commande : 20 </p>
                                    <?php } ?>
                                <br>
                                <a href="index.php?page=4" class="btn btn-primary custom-primary">
                                    Déconnexion
                                </a>
                                <a href="index.php?page=11" class="btn btn-outline-primary custom-outline-primary">Retour</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card-profil mb-3">
                    <div class="card-profil-body">
                        <div class="col-md-9 ">
                            <form method="POST" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group mb-3">
                                            <label class="label-custom-register" for="nom">Votre nom</label>
                                            <input type="text" class="form-control" name="nom" required
                                                value="<?= $user['lastname'] ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group mb-3">
                                            <label class="label-custom-register" for="prenom">Votre prenom</label>
                                            <input type="text" class="form-control" name="prenom" required
                                                value="<?= $user['firstname'] ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group mb-3">
                                            <label class="label-custom-register" for="email">Votre email</label>
                                            <input type="email" class="form-control" name="email" required
                                                value="<?= $user['email'] ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="label-custom-register" for="fileUpload">Photo de profil</label>
                                        <div class="form-group my-3">
                                            <input type="file" name="photo" id="fileUpload">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <button type="submit" class="btnRegister">Valider</button>
                                    </div>
                                </div>
                        </div>
                    </div>

                </div>
                </form>
            </div>
        </div>
    </div>
</div>
