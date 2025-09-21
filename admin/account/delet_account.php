<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<div class="right_col" role="main">
    <div class="">
            <?php
                  if(isset($_POST['delete'])){
                        $insert= $bdd->prepare("DELETE  FROM lepetqwlepetit.users WHERE id=" . $_GET["id"]);
                        $edata= $insert->execute();
                        if($edata) {
                              $_SESSION['flash']['success'] = "<i class='fas fa-envelope-open-text'></i>  DATA Succesfully Delete ";
                              header('location: index.php?page=3');
                              exit();
                        }else{
                              $_SESSION['flash']['danger'] = "<i class='fas fa-envelope-open-text'></i>  DATA Error !!! in the Database ";
                              header('location: index.php?page=3');
                              exit();
                        }
                  }
          
            ?>
            <div class="container">
                  <?php $req = $bdd->query("SELECT * FROM lepetqwlepetit.user WHERE id=" . $_GET["id"]);
               
                  ?>
               <?php  while ($profile=$req->fetch()){?> 
                         <div class="content delete bg-danger">
                               <h2>Delete Account row # "<?php echo $profile['id']; ?> "</h2>
                               <p>
                                Are you sure !!! delete  Table  category name = "<?php echo $profile['name']; ?> "
                               </p>

                                <form action="#" method="POST">
                                        <div class="modal-footer">
                                            
                                            <a class="btn btn-secondary"  href="index.php?page=3">close</a>
                                
                                            <button type="submit" name ="delete" class="btn btn-danger">delate</button>
                                        </div>   
                                </form>
                  <?php } ?>
            </div>
      </div>
</div>
                       
  