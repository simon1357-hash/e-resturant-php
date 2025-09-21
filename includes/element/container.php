
       <!-- ############################ carosele first for Product ################################### -->
       <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
         
        <div class="carousel-inner">
            <!--First slide-->
            <div class="carousel-item active">
                <?php
                    $req = $bdd->prepare("SELECT products.id as id,
                    products.fcode as fcode,
                    products.name as name,
                    products.text as text,
                    products.prix as prix,
                    products.newprix as newprix,
                    products.photo as photo, 
                        categorys.cat_id AS cat_id,
                        categorys.slug AS slug
                    FROM lepetqwlepetit.products 
                    INNER JOIN lepetqwlepetit.categorys  ON categorys.id = products.category_id   WHERE category_id= 1 ORDER by id DESC LIMIT 2 ");
                    $req->execute();
                    $search="";
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
                                        
                                        <div class="card-body text-white bg-card mb-1 mt-1 mr-1 ml-1" style="border-radius: 10px; background-color: #212529; ">
                                                <h5 class="card-title object-fit-fill  text-center"><?= $products['name']?> </h5>  
                                            <p>
                                                <h7> <?= $products['text'] ?> </h7>  <br>
                                                <h7> PRIX: <?= number_format($products['prix'], 2, ',', ' ');?> € </h7> 
                                            </p>   
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>   
                            <?php
                                $req = $bdd->prepare("SELECT products.id as id,
                                products.fcode as fcode,
                                products.name as name,
                                products.text as text,
                                products.prix as prix,
                                products.newprix as newprix,
                                products.photo as photo, 
                                    categorys.cat_id AS cat_id,
                                    categorys.slug AS slug
                                FROM lepetqwlepetit.products 
                                INNER JOIN lepetqwlepetit.categorys  ON categorys.id = products.category_id   WHERE category_id= 2 ORDER by id DESC LIMIT 2 ");
                                $req->execute();
                                $search="";
                            ?>
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
                                        
                                        <div class="card-body text-white bg-card mb-1 mt-1 mr-1 ml-1" style="border-radius: 10px; background-color: #212529; ">
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
                    
            </div>
            <div class="carousel-item">
    <!--  /First slide-->
    <!--  2nd slide-->
            <div class="carousel-item active">
                <?php
                    $req = $bdd->prepare("SELECT products.id as id,
                    products.fcode as fcode,
                    products.name as name,
                    products.text as text,
                    products.prix as prix,
                    products.newprix as newprix,
                    products.photo as photo, 
                        categorys.cat_id AS cat_id,
                        categorys.slug AS slug
                    FROM lepetqwlepetit.products 
                    INNER JOIN lepetqwlepetit.categorys  ON categorys.id = products.category_id   WHERE category_id= 3 ORDER by id DESC LIMIT 2 ");
                    $req->execute();
                    $search="";
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
                                        
                                        <div class="card-body text-white bg-card mb-1 mt-1 mr-1 ml-1" style="border-radius: 10px; background-color: #212529; ">
                                                <h5 class="card-title object-fit-fill  text-center"><?= $products['name']?> </h5>  
                                            <p>
                                                <h7> <?= $products['text'] ?> </h7>  <br>
                                                <h7> PRIX: <?= number_format($products['prix'], 2, ',', ' ');?> € </h7> 
                                            </p>   
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>   
                            <?php
                                $req = $bdd->prepare("SELECT products.id as id,
                                products.fcode as fcode,
                                products.name as name,
                                products.text as text,
                                products.prix as prix,
                                products.newprix as newprix,
                                products.photo as photo, 
                                    categorys.cat_id AS cat_id,
                                    categorys.slug AS slug
                                FROM lepetqwlepetit.products 
                                INNER JOIN lepetqwlepetit.categorys  ON categorys.id = products.category_id   WHERE category_id= 4 ORDER by id DESC LIMIT 2 ");
                                $req->execute();
                                $search="";
                            ?>
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
                                        
                                        <div class="card-body text-white bg-card mb-1 mt-1 mr-1 ml-1" style="border-radius: 10px; background-color: #212529; ">
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
              </div>
        <!--  /2nd slide-->
        <!-- 3rd slide-->
            <div class="carousel-item">
            <?php
                    $req = $bdd->prepare("SELECT products.id as id,
                    products.fcode as fcode,
                    products.name as name,
                    products.text as text,
                    products.prix as prix,
                    products.newprix as newprix,
                    products.photo as photo, 
                        categorys.cat_id AS cat_id,
                        categorys.slug AS slug
                    FROM lepetqwlepetit.products 
                    INNER JOIN lepetqwlepetit.categorys  ON categorys.id = products.category_id   WHERE category_id= 3 ORDER by id DESC LIMIT 2 ");
                    $req->execute();
                    $search="";
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
                                        
                                        <div class="card-body text-white bg-card mb-1 mt-1 mr-1 ml-1" style="border-radius: 10px; background-color: #212529; ">
                                                <h5 class="card-title object-fit-fill  text-center"><?= $products['name']?> </h5>  
                                            <p>
                                                <h7> <?= $products['text'] ?> </h7>  <br>
                                                <h7> PRIX: <?= number_format($products['prix'], 2, ',', ' ');?> € </h7> 
                                            </p>   
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>   
                            <?php
                                $req = $bdd->prepare("SELECT products.id as id,
                                products.fcode as fcode,
                                products.name as name,
                                products.text as text,
                                products.prix as prix,
                                products.newprix as newprix,
                                products.photo as photo, 
                                    categorys.cat_id AS cat_id,
                                    categorys.slug AS slug
                                FROM lepetqwlepetit.products 
                                INNER JOIN lepetqwlepetit.categorys  ON categorys.id = products.category_id   WHERE category_id= 4 ORDER by id DESC LIMIT 2 ");
                                $req->execute();
                                $search="";
                            ?>
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
                                        
                                        <div class="card-body text-white bg-card mb-1 mt-1 mr-1 ml-1" style="border-radius: 10px; background-color: #212529; ">
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
              </div>
  <!--  /3rd slide-->
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
        </div>