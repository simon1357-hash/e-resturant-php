<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<div class="right_col" role="main">
    <div class="">
            <?php
                  if(isset($_POST['delete'])){
                        $insert= $bdd->prepare("DELETE  FROM lepetqwlepetit.email WHERE id=" .$_GET["id"]);
                        $edata= $insert->execute();
                        if($edata) {
                              $_SESSION['flash']['success'] = "<i class='fas fa-envelope-open-text'></i>  Message Succesfully Delete ";
                              header('location: index.php?page=5');
                              exit();
                        }else{
                              $_SESSION['flash']['danger'] = "<i class='fas fa-envelope-open-text'></i>  DATA Error !!! in the Database ";
                              header('location: index.php?page=5');
                              exit();
                        }
                  }
          
            ?>


                  
            <div class="container">

                  <?php $req = $bdd->query("SELECT * FROM lepetqwlepetit.email WHERE id=" .$_GET["id"]);
                  while ($email = $req->fetch()) {
                  ?>

                  <div class="content delete bg-warning">
                        <h2>Delete Table row # "<?= $email['id']; ?> "</h2>
                  
                              <p>Are you sure !!! delete  message From = "<?= $email['name']; ?> "</p>

                              <form action="#" method="POST">
                                    <div class="modal-footer">
                                          
                                    <a class="btn btn-secondary"  href="/istanbulmarket/admin/production/index.php?page=5">close</a>
                              
                                          <button type="submit" name ="delete" class="btn btn-danger">delate</button>
                                    </div>

                                    
                              </form>
                  <?php } ?>
            </div>
      </div>
</div>
                       
                                              
