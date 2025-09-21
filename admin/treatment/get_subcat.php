<?php
    include 'db.php';
	$sub_id=$_POST["sub_id"];
    $req=$bdd->query("SELECT * FROM lepetqwlepetit.sub_categorys WHERE sub_id= $sub_id ");
?>
  <option selected="" disabled=""> selecte subcategory</option>

<?php while($subcat = $req->fetch()) { ?>
	<option value="<?php echo $subcat["id"];?>"><?php echo $subcat["sub_name"];?></option>
<?php } ?>