<?php resetPassword(); ?>
<div class="container bg-dark">
    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card card-signin my-5">
          <div class="card-body bg-warning">
            <h5 class="card-title text-center">Veuillez définir votre mot de passe!</h5>
            <form class="form-signin" action="#" method="post" name="login" >
              <div class="form-label-group">
              <div class="form-label-group">
                  <label for="inputPassword">Mot de passe</label>
                    <input type="password" id="inputPassword" class="form-control" name="password" placeholder="Mot de passe" required >
                  </div>

                  <div class="form-label-group">
                  <label for="inputPassword">Confirmez le mot de passe</label>
                    <input type="password" id="inputPassword" class="form-control" name="password_confirm" placeholder=" Confirmez le mot de passe" required autofocus>
                  </div>
                 <button class="btn btn-lg btn-primary btn-block text-uppercase float-right "  name="login" type="submit"><i class="fas fa-paper-plane"></i></button>
              <hr class="my-4">
              <!-- <button class="btn btn-lg btn-google btn-block text-uppercase" type="submit"><i class="fab fa-google mr-2"></i> Sign in with Google</button>
              <button class="btn btn-lg btn-facebook btn-block text-uppercase" type="submit"><i class="fab fa-facebook-f mr-2"></i> Sign in with Facebook</button> -->
            </form>
          </div>
        </div>
      </div>
    </div>
</div>

  <br><br>