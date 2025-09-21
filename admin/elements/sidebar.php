
<div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="index.php?page=1" class="site_title"><img class="rotate-center" src="images/logo_or.png" width="50px" height="30px" alt="" class=""><span>Le Petit Sushi Japonais </span></a>
    
            </div>
          <?php

               if (!isset($_SESSION['auth']) or $_SESSION['auth']['role'] == 'Client') {
                   $_SESSION['flash']['danger'] = "<i class='fas fa-times' style='font-size:18px'></i> Vous n'avez pas accès à cette page.";
                  header("Location: index.php?page=15");
                   exit();
                }
                
             ?>
            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>Restaurant!</h3>
                <ul class="nav side-menu">
                
                  <li><a><i class="fa fa-edit"></i> Forms <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="index.php?page=profile">Profile</a></li>
                      <li><a href="index.php?page=3">Contacts</a></li>
                    </ul>
                  </li>
                  <li><a> <i class="fa fa-desktop"></i> Office Elements <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="index.php?page=4">InvoiceClint
                              <span class="badge bg-green">
                                 
                              </span>
                           </a>
                      </li>
                      <li><a href="index.php?page=5">Inbox 
                            <span class="badge bg-green">
                            
                            </span>
                          </a>
                       </li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-table"></i> Tables <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="index.php?page=entree">Entree Table </a></li>
                      <li><a href="index.php?page=sushi">Sushi Table</a></li>
                      <li><a href="index.php?page=special_menu">Special Menue Table</a></li>
                      <li><a href="index.php?page=menu_chauds">Menu Chaud</a></li>
                      <li><a href="index.php?page=menu_indianne">Menue Indianne Table</a></li>
                      <li><a href="index.php?page=dessert_et_boisson">Dessert & Boisson Table</a></li>
                      <li><a href="index.php?page=tables_all_dynamic">Table DynamicAll</a></li>
                   <!-- <li><a href="index.php?page=promotion">Promotion Table</a></li> -->
                      <li><a href="index.php?page=tables">Tables Exam.</a></li>
                    </ul>
                  </li>
        
                </ul>
              </div>
              <div class="menu_section">
                <h3>Live On</h3>
                <ul class="nav side-menu">
                  </li>
                
                  <li><a href="index.php?page=31"><i class="fa fa-laptop"></i>User Tips<span class="label label-success pull-right"></span></a></li>
                </ul>
              </div>

            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="logout.php">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>
        <div class="container box-alert mt-3">


        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>
              <nav class="nav navbar-nav">
          
                <ul class=" navbar-right">
                    <li class="nav-item dropdown open" style="padding-left: 15px;">
                      <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                  <!--    <img src=" <?= '/lepetitsushijaponais/'.$user['picture'] ?> " alt="Admin"><?php echo $_SESSION['auth']["lastname"] ?>  -->
                        
                      </a>
                      <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item"  href="index.php?page=2"> Profile</a>
                          <a class="dropdown-item"  href="index.php?page=20">
                            <span>Register</span>
                          </a>
                        <a class="dropdown-item"  href="index.php?page=16"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                      </div>
                    </li>
                </ul>
              
            </nav>
          </div>
        </div>
      
          <div class="row pl-4">
          <div class="col-2">
          </div>
            <div class="col-10">
                <?php if (isset($_SESSION['flash'])): ?>
                        <?php foreach ($_SESSION['flash'] as $type => $message): ?>
                            <div class="alert alert-<?= $type; ?>" role="alert">
                                <?= $message; ?>
                            </div>
                        <?php endforeach; ?>
                    <?php unset($_SESSION['flash']); ?>
                <?php endif; ?>
            </div>
        </div>

        <!-- /top navigation -->