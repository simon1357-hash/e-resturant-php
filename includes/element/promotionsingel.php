<?php 
    addProductBasket();
    $req = $bdd->query("SELECT products.id as id,
    products.name as name,
    products.text as text,
    products.prix as prix,
    products.newprix as newprix,
    products.photo as photo,
        categorys.slug as slug,
        categorys.color as color

    FROM lepetqwlepetit.products
    INNER JOIN lepetqwlepetit.categorys  ON categorys.id = products.category_id  
    WHERE products.id=". $_GET["id"]);
?>
    
    <?php  while ($products = $req->fetch()) { ?>        
        <div class="container text-white <?php echo $products['color']?>">
            <div class="row pb-3 pr-3  ">
                <div class="col-sm-6 col-xs-6 mt-3 ">
                     <img src="<?php echo 'admin/production/uploads/'.$products['photo'] ?>" class="img-fluid  bg-white"  >      
                </div>

                <div class="col-sm-6 col-xs-6 pb-3 "  style="justify-content: flex-end; margin-top:auto">
                <h5 class="card-title"><?php echo $products['name'];?></h5> 
                    <p class="card-text"> Product Discription:</p>
                    <hr>
                    <h3><?php echo $products['text'] ?></h3>
                    <h4> PRIX:<s class="bg-danger"><?= number_format($products['prix'] , 2 , ' , ' , ' ' );?> </S>€ </h4>
                           <h4>NewPRIX:<?= number_format($products['newprix'] , 2 , ' , ' , ' ' );?> € </h4>
                        <hr>
                    <form action="#" method="POST" enctype="multipart/form-data">
                        <input type="text"  value="<?= $products['photo'] ?>" name="photo" hidden />
                        <input type="text" value="<?= $products['name'] ?>" name="name" hidden/>
                        <input type="float"  value="<?= $products['newprix'];?>" min="0" name="price" hidden/> 
                        <input type="number" value="1" mini="1" name="quantity" hidden>
                        <?php if(isset($_SESSION['auth'])):        ?> <!--if clint is connected -->
                            <button type="submit" name="add_shoppingcart" class="btn <?= $products['color'];?>" titel="Add your Product"  hidden><i class="fas fa-cart-plus">Shopping cart</i>
                        </button>  
                        <i class="far fa-heart"> Add to favorite</i>
                            <?php  else:   ?>  <!--if clint is not connected -->
                                <a class="btn-largeFigurine btn_nologger" href="index.php?page=3">
                                    <i class="far fa-heart"> Add to favorite</i>
                                </a>
                            <?php  endif; ?>   
                    </form> 
                </div>
            </div>   
        </div>  
   <?php } ?> 
 
