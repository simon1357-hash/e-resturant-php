
<div class="right_col" role="main">
    <div class="">
    <?php
            if (isset($_POST['add'])) {
                $errors = [];
                 // for the database
                   $fcode =  $_POST['fcode'];
                   $name =  $_POST['name'];
                   $photo=   $_FILES["photo"]['name'];
                   $text=   $_POST['text'];
                   $details=   $_POST['details'];
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
                       $msg = "There was an error in the database";
                       $msg_class = "alert-danger";
                   }
                   // Upload image only if no errors
                   if (empty($error)) {
                        if(move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
                            $insert = $bdd->prepare("INSERT INTO lepetqwlepetit.products (fcode, name, photo , text, details, prix, newprix,  category_id, subcategory_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
                            $insert->execute([$fcode, $name, $photo, $text, $details, $prix, $newprix, $category_id, $subcategory_id]);
                            if($insert){
                            $_SESSION['flash']['success'] = "<i class='fas fa-envelope-open-text'></i>  DATA uploaded and saved in the Database ";
                            header('location: index.php?page=17');
                            exit();
                            } else {
                                $_SESSION['flash']['danger'] = "<i class='fas fa-envelope-open-text'></i>  There was an error in the database  DATA not Update";
                                header('location: index.php?page=17');
                                exit();
                            }
                        } else {
                            $msg = "There was an error in the database";
                            $msg_class = "alert-danger";
                        }
                   }
               }
               ?>

                <div class="container bg-info">
                    <h3 class="text-danger"> ADD Article </h3>
                        <form action="" method="POST" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Food Code</label>
                                        <input type="text" class="form-control" id="fcode" name="fcode" placeholder="Food Code">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Name</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Name">
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputPassword1">photo</label>
                                        <input type="file" class="form-control" id="photo" name="photo" placeholder="upload Photo">
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Text Heading</label>
                                        <textarea class="form-control" id="exampleFormControlTextarea1" name="text" rows="3"></textarea>
                                        
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Details</label>
                                        <textarea class="form-control" id="details" name="details" rows="3"></textarea>
                                        
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Prix</label>
                                        <input type="float" class="form-control"   name="prix" placeholder="0.00" >
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputPassword1">newPrix</label>
                                        <input type="float" class="form-control"  name="newprix" placeholder="0.00" >
                                    </div>
                                            <?php  
                                        
                                            $req=$bdd->query("SELECT * FROM lepetqwlepetit.categorys ");
                                            ?> 
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Epicerie</label>
                                                <select class="custom-select" id="category_id" name="category_id">
                                                <option selected="" disabled=""> selecte category</option>
                                                  <?php  while ($categorys = $req->fetch()) { ?>
                                                     <option  value="<?= $categorys['id']?>"> <?= $categorys['name']?> 
                                                     </option> 
                                                  <?php }?>
                                                </select>
                                            </div>

                                        <div class="form-group">
                                            <label for="subcategory_id">subCategorys</label>
                                            <select class="custom-select" id="sub_category" name="subcategory_id" >
                                              <option selected="" disabled="" > selecte subCategory </option>
                                                 
                                            </select>
                                        </div>
                                     
                                
                                        <a class="btn btn-secondary"  href="/lepetqwlepetit/admin/index.php?page=tables_all_dynamic">close</a>
                            <button type="submit" name="add" class="btn btn-success" >Submit</button>
                        </form>
                </div>
        </div>
    </div><!-- Main Col END -->
 </div><!-- body-row END --> 
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