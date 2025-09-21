<div class="right_col" role="main">
    <div class="">
    <?php
       
        if (isset($_POST['update'])) {
            $errors = [];
            // for the database
                    $name =  $_POST['name'];
                    $photo=   $_FILES["photo"]['name'];
                    $text=   $_POST['text'];
                    $prix=   $_POST['prix'];
                    $newprix=   $_POST['newprix'];
                    $category_id=$_POST['category_id'];
                    $subcategory_id=$_POST['subcategory_id'];

            $target_dir = "uploads/";
            $target_file = $target_dir . basename($photo);
            // VALIDATION
            // validate image size. Size is calculated in Bytes
            if($_FILES['photo']['size'] > 1000000) {
            $msg = "Image size should not be greated than 1000Kb";
            $msg_class = "alert-danger";
            }
            // check if file exists
            if(file_exists($target_file)) {
            $msg = "File already exists";
            $msg_class = "alert-danger";
            }
            // Upload image only if no errors
            if (empty($error)) {
            if(move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
                if ($name!="" && $photo!="" && $text!="" && $prix!="" && $newprix!="" && $category_id!="" && $subcategory_id!="") {
                    $insert = $bdd->prepare("UPDATE lepetqwlepetit.products SET name='$name', photo = '$photo', text= '$text', prix = '$prix', newprix='$newprix', category_id = '$category_id', subcategory_id = '$subcategory_id'  WHERE id=" . $_GET["id"]);
                    $edata= $insert->execute();

                     if ($edata) {
                        $_SESSION['flash']['success'] = "<i class='fas fa-envelope-open-text'></i>  DATA uploaded and saved in the Database ";
                        header('location: index.php?page=11');
                        exit();
                    } else {
                        $msg = "There was an error in the database";
                        $msg_class = "alert-danger";
                    }
                }
            } else {
                $error = "There was an erro uploading the file";
                $msg = "alert-danger";
            }
            }
        }
        ?>

        <?php
        $req = $bdd->query("SELECT * FROM  lepetqwlepetit.products WHERE id=" . $_GET["id"]);
        while ($products = $req->fetch()) {
        ?>



        <div class="container bg-warning">
        <h3 class="text-danger"> UPdate Your PRODUCT </h3>
            <form acrion="" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $products['id'];?>">
                        <div class="form-group">
                            <label for="exampleInputPassword1">Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Name" value ="<?php echo $products['name'] ;?>">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">photo</label>
                            <input type="file" class="form-control" id="photo" name="photo" placeholder="Upload Photo" value ="<?php echo $products['photo']; ?>" >
                            <p><img src="<?php echo 'uploads/'.$products['photo'] ?>" width ="60px"  ></p>
                        </div>
                        
                        <div class="form-group">
                            <label for="exampleInputEmail1">Discriptions</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" name="text" value="<?php echo $products['text']; ?> " rows="3"> <?php echo $products['text']; ?> </textarea>
                            
                        </div>

                        <div class="form-group">
                            <label >Prix</label>
                            <input type="float" class="form-control" name="prix" placeholder="Prix" value ="<?= ($products['prix'] )?>" >
                        </div>

                        <div class="form-group">
                            <label>newPrix</label>
                            <input type="float"  class="form-control"  name="newprix" placeholder="newPrix" value ="<?= ($products['newprix'])?>">
                        </div>
                        
                            <?php  
                                            
                                $req=$bdd->query("SELECT * FROM lepetqwlepetit.categorys ");
                                ?> 
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Epicerie</label>
                                    <select class="custom-select" id="category_id" name="category_id">
                                    <option selected="" disabled="" >select category <?php echo $products["category_id"];?></option>
                                        <?php  while ($categorys = $req->fetch()) { ?>
                                            <option  value="<?= $categorys['id']?>"> <?= $categorys['name']?> 
                                            </option> 
                                        <?php }?>
                                    </select>
                                </div>

                            <div class="form-group">
                                <label for="subcategory_id">Epicerie subCategory</label>
                                <select class="custom-select" id="sub_category" name="subcategory_id" >
                                   <option selected="" disabled="" > select sub_catgory <?php echo $products["subcategory_id"];?></option>
                               
                                </select>
                            </div>
                    
                            <a class="btn btn-secondary"  href="/istanbulmarket/admin/production/index.php?page=11">close</a>
                        <button type="submit" name="update" class="btn btn-success">UPDATE</button>
            </form>
        <?php }  ?> 

        </div>
                </div>
            </div><!-- Main Col END -->
        </div><!-- body-row END --> 
   </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
 <script>
$(document).ready(function() {
	$('#category_id').on('change', function() {
			var sub_id = this.value;
			$.ajax({
				url: "get_subcat.php",
				type: "POST",
				data: {
					sub_id: sub_id
				},
				cache: false,
				success: function(dataResult){
					$("#sub_category").html(dataResult);
				}
			});	
        });
    });
</script>