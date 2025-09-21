<?php
addProductBasket();
if (isset($_GET['id'])) {
    $id= intval($_GET['id']);

    $req = $bdd->prepare("SELECT products.id as id,
        products.fcode as fcode,
        products.name as name,
        products.text as text,
        products.details as details,
        products.prix as prix,
        products.newprix as newprix,
        products.photo as photo, 
            categorys.slug as slug

    FROM lepetqwlepetit.products
    INNER JOIN lepetqwlepetit.categorys
    ON categorys.id = products.category_id  
    WHERE products.id= :id");
    $req->bindValue(':id', $id, PDO::PARAM_INT);
    $req->execute();
}
 ?>

    <?php  while ($products = $req->fetch()) { ?>        
        <div class="container bg-secondary ">
            <div class="row pb-3 pr-3  ">
                <div class="col-sm-6 col-xs-6 mt-3">
                       <img src="<?= 'admin/uploads/'.$products['photo'] ?>" class="img-fluid bg-white" >    
                </div>
<hr>
                <div class="col-sm-6 col-xs-6 pb-3 bg-warning "  style="justify-content: flex-end; margin-top:auto">
                    <div class="" >
                    <h5 class="card-title text-center text-danger"> <span class="text-info">Code Alimentaire</span> <?= $products['fcode']?> </h5>
                    <h5 class="card-title "><?php echo $products['name'];?></h5> 
                        <hr class="">
                        <h3><?php echo $products['text'] ?></h3>   <hr>
                        <h3><?php echo $products['details'] ?></h3> 
                        <h1> PRIX: <?php echo $products['prix'] ?> €</h1>
                    </div>
                </div>
            </div>   
        </div>  
   <?php } ?> 

