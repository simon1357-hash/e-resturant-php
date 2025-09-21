<?php
isLogged();

$user = getUserConnected();

$adresses = getAdresses($user['id']);

if(isset($_POST['validAddAdresse'])){
    addAdresse();
}

?>
    <div class="right_col" role="main">   
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
                                <img src="<?= '/lepetqwlepetit/'.$user['picture'] ?>" alt="Admin" height="250px" width="200px">
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
                                        <p class="text-muted font-size-sm"> User PROFILE </p>
                                    <?php } ?>
                                    <br>
                                    <a href="index.php?page=16" class="btn btn-primary custom-primary">
                                        Déconnexion
                                    </a>
                                    <a href="index.php?page=ajouter-une-adresse"
                                        class="btn btn-outline-primary custom-outline-primary">Ajouter une adresse</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card-profil mb-3">
                        <div class="card-profil-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Nom</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <?= $user['lastname'] ?>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Prénom</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <?= $user['firstname'] ?>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Email</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <?= $user['email'] ?>
                                </div>
                            </div>

                        </div>
                        <a href="index.php?page=editer-mon-profil" class="btn btn-primary custom-primary">
                            Editer
                        </a>
                    </div>
                    <div class="col-md-8 col-sm-8 mb-3">
                        <div class="card-profil-body">
                            <h6 class="d-flex align-items-center mb-3">
                                <i class="material-icons text-info mr-2">Mes adresses</i>
                            </h6>
                            <div class="container-fluid">
                                <div class="row">
                         
                                        <?php foreach($adresses as $adresse){?>

                                        <div class="col-md-12 my-1 list-commande-profil p-0">
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <p class="m-0"><?= $adresse['name'] ?></p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p><?= $adresse['adresse'] ?>, <?= $adresse['ville'] ?>,
                                                        <?= $adresse['cp'] ?></p>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="row">
                                                        <a href="index.php?page=supprimer-une-adresse&id=<?= $adresse['id'] ?>"
                                                            class="btn btn-danger-delete">
                                                            <i class="fas fa-trash "></i>
                                                        </a>
                                                        <a href="index.php?page=editer-une-adresse&edit=<?= $adresse['id'] ?>"
                                                            class="btn btn-danger-delete">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <script>
        const btnAd = document.getElementById('ad');
        const adresseView = document.getElementById('adresseView');
        const profilView = document.getElementById('profilView');


        btnAd.addEventListener('click', function () {
            profilView.classList.toggle('hidden');
            adresseView.classList.toggle('hidden');
            if (btnAd.innerHTML == "Mes adresses") {
                btnAd.innerHTML = "A propos";
            } else {
                btnAd.innerHTML = "Mes adresses";
            }
        })

        const btnAdd = document.getElementById('addAdresse');
        const btnEdit = document.getElementById('editBtn');
        const newInput = document.getElementById('formInput');

        btnAdd.addEventListener('click', function () {
            newInput.classList.toggle('hidden');
            if (btnEdit.innerHTML == "Ajouter une adresse") {
                btnEdit.innerHTML = "Annuler";
                let name = document.getElementById('name');
                let adresse = document.getElementById('adresse');
                let cp = document.getElementById('cp');
                let ville = document.getElementById('ville');

                let contentName = name.getAttribute('data-name');
                let contentAdresse = name.getAttribute('data-adresse');
                let contentCP = name.getAttribute('data-cp');
                let contentVille = name.getAttribute('data-ville');

                name.value = contentName;
                adresse.value = contentAdresse;
                cp.value = contentCP;
                ville.value = contentVille;


            } else {
                btnEdit.innerHTML = "Ajouter une adresse";
            }
        })
    </script>