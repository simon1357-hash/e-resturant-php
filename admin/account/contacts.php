
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Contacts Design</h3>
              </div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5  form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Go!</button>
                    </span>
                  </div>
                </div>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
                <div class="x_panel">
                  <div class="x_content">
                      <div class="col-md-12 col-sm-12  text-center">
                        
                      </div>
                      <?php 
                       $req=$bdd->query("SELECT * FROM lepetqwlepetit.users")  ; ?>
                      <div class="clearfix"></div>
                      <?php  while ($profile=$req->fetch()){?> 
                      <div class="col-md-4 col-sm-4  profile_details">
                        <div class="well profile_view">
                          <div class="col-sm-12">
                            <h4 class="brief"><i>User ID : <?php echo $profile['role']; ?></i></h4>
                            <div class="left col-md-7 col-sm-7">
                              <h2><?php echo $profile['lastname']; ?></h2>
                              <h2><?php echo $profile['firstname']; ?></h2>
                              <p><strong>About: </strong> </p>
                              <ul class="list-unstyled">
                                <li><i class="fa fa-building"></i><?php echo $profile['email']; ?></li>
                              </ul>
                            </div>
                            <div class="right col-md-5 col-sm-5 text-center">
                              <img src="<?= '/lepetqwlepetit/'.$profile['picture']; ?>"  class="img-circle img-fluid">
                            </div>
                          </div>
                          <div class=" profile-bottom text-center">
                            <a class="btn btn-outline-danger" href='index.php?page=delete_account&id=<?= $profile['id']; ?>'>
                              DELETE 
                            </a>
                          </div>
                        </div>
                      </div>
                     <?php }  ?>
                   
                        </div>
                      </div>
                  </div>
                </div>
            </div>
          </div>
        </div>
      