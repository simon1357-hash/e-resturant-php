   <?php
        if (isset($_GET['id'])) {
        $categorys = $_GET['id'];
        }else{
        $categorys = 'product';
        }
        $req = $bdd->query('SELECT * FROM lepetqwlepetit.categorys lIMIT 6 ');
    ?>
  <!-- food section -->

<section class="food_section layout_padding">
    <div class="container">
      <div class="heading_container heading_center">
        <h2>
           Notre Carte
        </h2>
      </div>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  
      <ul class="filters_menu">
        <?php  while ($categorys = $req->fetch()) { ?> 
                <li class="nav-item dropdown btn btn-outline-warning btn-sm btn-rounded"> 
                    <a  type="button" class="nav-link dropdown-toggle" href="index.php?page=categorys&id=<?= $categorys['id']?>"  id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?= $categorys['name']?>
                    </a>
                    <div class="dropdown-menu">
                        <?php 
                            $req1= $bdd->prepare('SELECT * FROM lepetqwlepetit.sub_categorys WHERE sub_id = :sub_id');
                            $req1->execute(array(':sub_id' => $categorys['id']
                            ));
                        ?>
                            <?php while($subcategorys = $req1->fetch())  {?>
                                <a class="dropdown-item" href="index.php?page=sub_categorys&id=<?= $subcategorys['id']?>"> <?= $subcategorys['sub_name']?> </a>
                            <?php } ?>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="index.php?page=categorys&id=<?= $categorys['id']?>">Tout les <?= $categorys['name']?> </a>
                    </div>
                    
                </li>
            <?php } ?>
      </ul>
</nav>
</section>
<!-- 
<?php
      if (isset($_GET['id'])) {
      $categorys = $_GET['id'];
      }else{
      $categorys = 'product';
      }
      $req = $bdd->query('SELECT * FROM lepetqwlepetit.categorys lIMIT 6 ');
  ?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">

  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
      <?php  while ($categorys = $req->fetch()) { ?> 
        <li class="nav-item dropdown">
                    <a  type="button" class="nav-link dropdown-toggle" href="index.php?page=categorys&id=<?= $categorys['id']?>"  id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                     <?= $categorys['name']?>
                    </a>
            <?php 
              $req1= $bdd->prepare('SELECT * FROM lepetqwlepetit.sub_categorys WHERE sub_id = :sub_id');
              $req1->execute(array(':sub_id' => $categorys['id']
              ));
            ?>
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <?php while($subcategorys = $req1->fetch())  {?>
            <a class="dropdown-item" href="index.php?page=sub_categorys&id=<?= $subcategorys['id']?>"> <?= $subcategorys['sub_name']?> </a>
            <?php } ?>
            <hr>
            <a class="dropdown-item" href="index.php?page=categorys&id=<?= $categorys['id']?>">Tout les <?= $categorys['name']?> </a>
          </div>
        </li>
      <?php } ?>
    </ul>
  </div>
</nav>
 -->

