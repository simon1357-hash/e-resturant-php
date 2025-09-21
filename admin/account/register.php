<?php
registerUser();
?>
  
<div class="container bg-dark">
    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card card-signin my-5">
          <div class="card-body bg-warning">
            <h5 class="card-title text-center">Sign UP</h5>
            <form class="form-signin" action="#" method="POST">
                <div class="form-label-group">
                <label for="inputName">Noms d'utilisateur</label>
                <input  type="text" class="form-control" id="exampleInputUsername1" autocomplete="pseudo" placeholder="Votre nom" name="lastname" required>
                  </div>
                  <div class="form-label-group">
                  <label for="inputName">Prénom de l'utilisateur</label>
                  <input  type="text" class="form-control" id="exampleInputUsername1"  autocomplete="pseudo" placeholder="Votre prénom" name="firstname" required>
                  </div>

                  <div class="form-label-group">
                  <label for="inputEmail">Adresse e-mail</label>
                    <input type="email" id="inputEmail" class="form-control" name="email" placeholder="Adresse e-mail" required autofocus>
                  </div>

                  <div class="form-label-group">
                  <label for="inputPassword">Mot de passe</label>
                    <input type="password" id="inputPassword" class="form-control" name="password" placeholder="Mot de passe" required >
                  </div>

                  <div class="form-label-group">
                  <label for="inputPassword">Confirmez le mot de passe</label>
                    <input type="password" id="inputPassword" class="form-control" name="password_confirm" placeholder=" Confirmez le mot de passe" required autofocus>
                  </div>

                  <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit" name="register">Register</button>
                  <hr class="my-4">
                  <!-- <button class="btn btn-lg btn-google btn-block text-uppercase" type="submit"><i class="fab fa-google mr-2"></i> Sign up with Google</button>
                  <button class="btn btn-lg btn-facebook btn-block text-uppercase" type="submit"><i class="fab fa-facebook-f mr-2"></i> Sign up with Facebook</button> -->
              </form>
            <h5> If you have already an account <a href="index.php?page=15"> Click </a></h5>
          </div>
        </div>
      </div>
    </div>
  </div>