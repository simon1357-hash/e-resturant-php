<?php

  if (isset($_POST["search"])) {
      $name= trim($_POST["search"]);
      $req = $bdd->prepare("SELECT * FROM lepetqwlepetit.products WHERE name LIKE '%$name%'  ");
      $req -> execute();
      $search="";
  }
?>
     <div class="container">
        <div class="row">
            <?php while ($products= $req->fetch()) { ?>
                <div class="col-6 col-sm-4 col-md-3 my-2">
                    <div class="card bg-image" style="border-radius: 25px; background-color: #ffc107; "  >
                        <h5 class="card-title text-center text-danger">
                        <span class="text-info"> Nr°</span> <?= $products['fcode']?> 
                        </h5>
                        <div class="" style="background-color: #FFFDFA;">
                            <a href="index.php?page=singel_categorys&id=<?= $products['id']?>"> 
                                <img src="<?php echo 'admin/uploads/'.$products['photo'] ?>" class="rounded mx-auto d-block card-img-top"  style="object-fit-fill border rounded" >  
                            </a>
                        </div>
                        
                        <div class="card-body text-white bg-card mb-1 mt-1 mr-1 ml-1" style="border-radius:10px; background-color: #212529; ">
                                <h5 class="card-title object-fit-fill  text-center"><?= $products['name']?> </h5>  
                              <p>
                                <h7> <?= $products['text'] ?> </h7>  <br>
                                <h7> PRIX: <?= number_format($products['prix'], 2, ',', ' ');?> € </h7> 
                              </p>   
                        </div>
                    </div>
                </div>
            <?php } ?>   
        </div>
    </div>
