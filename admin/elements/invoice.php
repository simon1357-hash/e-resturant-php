<!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Invoice <small></small></h3>
              </div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5   form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                      <button class="btn btn-secondary" type="button">Go!</button>
                    </span>
                  </div>
                </div>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Invoice Design <small>Sample user invoice design</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="#">Settings 1</a>
                            <a class="dropdown-item" href="#">Settings 2</a>
                          </div>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <section class="content invoice">
                      <!-- title row -->
                      <div class="row">
                        <div class="  invoice-header">
                          <h1>
                                          <i class="fa fa-globe"></i> Invoice.
                                       
                                      </h1>
                        </div>
                        <!-- /.col -->
                      </div>
              
                      <!-- Table row -->
                      <div class="row">
                        <div class="  table">
                          <table class="table table-striped">
                            <thead>
                              <tr>
                                <th>numero</th>
                                <th>reference</th>
                                <th>total</th>
                                <th>client_id</th>
                                <th style="width: 39%">adresse</th>
                                <th>date_commande</th>
                                <th>statut_commande</th>
                                <th >Action</th>
                              </tr>
                            </thead>
                            <tbody>
                            <?php 
                             $req = $bdd->query("SELECT * FROM istanbolmarket.commande ");
                            ?>
                         <?php  while ($commande = $req->fetch()) { ?>
                              <tr>
                                <td> <?= $commande ['numero']?> </td>
                                <td><?= $commande['reference']?></td>
                                <td><?= $commande ['total']?>€</td>
                                <td> <?= $commande ['client_id']?></td>
                                <td><?= $commande ['adresse']?></td>
                                <td> <?= $commande ['date_commande']?></td>
                                <td><?= $commande['statut_commande']?></td>
                                <td>  <a class="btn btn-outline-danger" href='index.php?page=32&id=<?= $commande['id']; ?>'> <i class="far fa-trash-alt"></i>
                                </a>
                          </td>
                              </tr>
                            <?php  }?>
                            </tbody>
                          </table>
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- /.row -->


                      <!-- this row will not appear when printing -->
                      <div class="row no-print">
                       
                      </div>
                    </section>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->
