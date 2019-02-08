<?php 
session_start();
?>
<?php 
//connect to database
require('other/bdd.connexion.php');
require('other/fonction.php');
?>
<?php
if (isset($_SESSION['email']) && !empty($_SESSION['email'])) {?>
<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>::Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

    <!-- Bootstrap core CSS-->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">

    <script src="dist/js/bootstrap-checkbox.js" defer></script>
<style>
html {
    font-family: Lato, 'Helvetica Neue', Arial, Helvetica, sans-serif;
    font-size: 14px;
}

.table {
    border: none;
}

.table-definition thead th:first-child {
    pointer-events: none;
    background: white;
    border: none;
}

.table td {
    vertical-align: middle;
}

.page-item > * {
    border: none;
}

.custom-checkbox {
  min-height: 1rem;
  padding-left: 0;
  margin-right: 0;
  cursor: pointer; 
}
  .custom-checkbox .custom-control-indicator {
    content: "";
    display: inline-block;
    position: relative;
    width: 30px;
    height: 10px;
    background-color: #818181;
    border-radius: 15px;
    margin-right: 10px;
    -webkit-transition: background .3s ease;
    transition: background .3s ease;
    vertical-align: middle;
    margin: 0 16px;
    box-shadow: none; 
  }
    .custom-checkbox .custom-control-indicator:after {
      content: "";
      position: absolute;
      display: inline-block;
      width: 18px;
      height: 18px;
      background-color: #f1f1f1;
      border-radius: 21px;
      box-shadow: 0 1px 3px 1px rgba(0, 0, 0, 0.4);
      left: -2px;
      top: -4px;
      -webkit-transition: left .3s ease, background .3s ease, box-shadow .1s ease;
      transition: left .3s ease, background .3s ease, box-shadow .1s ease; 
    }
  .custom-checkbox .custom-control-input:checked ~ .custom-control-indicator {
    background-color: #84c7c1;
    background-image: none;
    box-shadow: none !important; 
  }
    .custom-checkbox .custom-control-input:checked ~ .custom-control-indicator:after {
      background-color: #84c7c1;
      left: 15px; 
    }
  .custom-checkbox .custom-control-input:focus ~ .custom-control-indicator {
    box-shadow: none !important; 
  }
</style>

  </head>

  <body id="page-top">

    <nav class="navbar navbar-expand   static-top">

      <a class="navbar-brand mr-1" href="index.php">Pharmatie: <?= $_SESSION['nom'] ?></a>

      <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
        <i class="fas fa-bars"></i>
      </button>

      <!-- Navbar Search -->
      <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
        <div class="input-group">
          <input type="text" class="form-control" placeholder="Recherche..." aria-label="Search" aria-describedby="basic-addon2">
          <div class="input-group-append">
            <button class="btn btn-primary" type="button">
              <i class="fas fa-search"></i>
            </button>
          </div>
        </div>
      </form>

      <!-- Navbar -->
      <ul class="navbar-nav ml-auto ml-md-0">
        <li class="nav-item dropdown no-arrow mx-1">
          <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-bell fa-fw"></i>
            <span class="badge badge-danger">9+</span>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="alertsDropdown">
            <a class="dropdown-item" href="#">Notif1</a>
            <a class="dropdown-item" href="#">Notif2</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Voir tous</a>
          </div>
        </li>
        <li class="nav-item dropdown no-arrow mx-1">
          <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-envelope fa-fw"></i>
            <span class="badge badge-danger">7</span>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="messagesDropdown">
            <a class="dropdown-item" href="#">Danielle</a>
            <a class="dropdown-item" href="#">Nicole</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Lire tous</a>
          </div>
        </li>
        <li class="nav-item dropdown no-arrow">
          <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-user-circle fa-fw"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
            <a class="dropdown-item" href="#">Paramètres</a>
            <a class="dropdown-item" href="#">Activités</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Déconnection</a>
          </div>
        </li>
      </ul>

    </nav>

    <div id="wrapper">

      <!-- Sidebar -->


      <div id="content-wrapper">

        <div class="container-fluid">

          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="#">Ma Pharmatie</a>
            </li>
            <li class="breadcrumb-item active">général</li>
          </ol>

          <!-- Icon Cards-->
          <div class="row">
            <div class="col-xl-3 col-sm-6 mb-3">
              <div class="card text-white bg-primary o-hidden h-100">
                <div class="card-body">
                  <div class="card-body-icon">
                    <i class="fas fa-fw fa-comments"></i>
                  </div>
                  <div class="mr-5">26 Nouveaux Messages!</div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="#">
                  <span class="float-left">Voir Details</span>
                  <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                  </span>
                </a>
              </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-3">
              <div class="card text-white bg-warning o-hidden h-100">
                <div class="card-body">
                  <div class="card-body-icon">
                    <i class="fas fa-fw fa-list"></i>
                  </div>
                  <div class="mr-5">11 Nouvelles questions!</div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="#">
                  <span class="float-left">Voir Details</span>
                  <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                  </span>
                </a>
              </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-3">
              <div class="card text-white bg-success o-hidden h-100">
                <div class="card-body">
                  <div class="card-body-icon">
                    <i class="fas fa-fw fa-shopping-cart"></i>
                  </div>
                  <div class="mr-5">123 Nouvelles commandes!</div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="#">
                  <span class="float-left">Voir Details</span>
                  <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                  </span>
                </a>
              </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-3">
              <div class="card text-white bg-danger o-hidden h-100">
                <div class="card-body">
                  <div class="card-body-icon">
                    <i class="fas fa-fw fa-life-ring"></i>
                  </div>
                  <?php $req = $bdd->prepare('SELECT COUNT(*) as total FROM produits');
                  $req->execute();
                  $res=$req->fetch();
                  ?>
                  <div class="mr-5"><?= $res['total'] ?> Produits dans votres Pharmatie!</div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="#">
                  <span class="float-left">View Details</span>
                  <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                  </span>
                </a>
              </div>
            </div>
          </div>

          <!-- DataTables Example -->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-table"></i>
              Médicaments 
              <button href="#" data-toggle="modal" data-target="#addproduct" class="btn btn-primary"> Ajouter</button>
              </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Nom</th>
                      <th>Aperçu</th>
                      <th>Date de saisi</th>
                      <th>prix</th>
                      <th>Disponible</th>
                      <th>Supprimer </th>

                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Nom</th>
                      <th>Aperçu</th>
                      <th>Date de saisi</th>
                      <th>prix</th>
                      <th>Disponible </th>
                      <th>Supprimer </th>

                    </tr>
                  </tfoot>
                  <?php
                  $ins4=$bdd->prepare('SELECT * FROM produits WHERE pharmatie=:pharmatie');
                  $ins4->execute(['pharmatie'=>$_SESSION['nom']]);
                  $reslts=$ins4->fetchAll(PDO::FETCH_OBJ); 
                  ?>
                  <tbody>
                    <?php foreach ($reslts as $reslt): ?>
                    <tr>
                      <td><?= $reslt->produit ?></td>
                      <td> <center><img width="100" src="images/<?= $reslt->id ?>_<?= $reslt->pharmatie ?>_<?= $reslt->apercu ?>" class="img-circle img-responsive" ></center></td>
                      <td><?= $reslt->date ?></td>
                      <td><?= $reslt->prix ?> Franc Cfa</td>
                      <td>
                      <a title='cliquez pour changer' href="traitement2.php?idprod=<?= $reslt->id.'&amp;val='.$reslt->disponibilite ?>" role="button" class="btn <?php if($reslt->disponibilite == 1){ echo 'btn-success';}else{echo 'btn-danger';} ?>">
                      <?php if($reslt->disponibilite == 1){ echo 'OUI';}else{echo 'NON';} ?>
                      </a>
                      </td>
                      <td>
                      <a title='cliquez pour changer' href="traitement3.php?idprod=<?= $reslt->id ?>" role="button" class="btn btn-danger"><i class="fa fa-remove"></i>Supprimer</a>
                      </td>
                    </tr>
                    <?php endforeach ?>
                  </tbody>
                </table>
              </div>
            </div>
            <?php
                  $ins5=$bdd->prepare('SELECT date FROM produits WHERE pharmatie=:pharmatie ORDER BY date Desc LIMIT 1');
                  $ins5->execute(['pharmatie'=>$_SESSION['nom']]);
                  $reslts1=$ins5->fetchAll(PDO::FETCH_OBJ); 
                  ?> <?php foreach ($reslts1 as $reslt1): ?>
            <div class="card-footer small text-muted">Dernière mise à jour :<?= $reslt1->date ?> </div><?php endforeach ?>
          </div>

        </div>
        <!-- /.container-fluid -->

        <!-- Sticky Footer -->
        <footer class="">
          <div class="container my-auto">
            <div class="copyright text-center my-auto">
              <span>Copyright © Votre Pharmatie 2019</span>
            </div>
          </div>
        </footer>

      </div>
      <!-- /.content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Prêt à partir?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Sélectionnez "Déconnexion" ci-dessous si vous êtes prêt à mettre fin à votre session en cours.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Annuler</button>
            <a class="btn btn-primary" href="logout.php">Déconnexion</a>
          </div>
        </div>
      </div>
    </div>

    <!-- ADD product modal-->
    <div class="modal fade col-md-12" id="addproduct" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog"  role="document">
        <div class="modal-content" >
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ajouter un nouveau médicament à la liste.</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
          <form action="traitement.php" method="post" enctype="multipart/form-data">
          <div class="form-group">
              <div class="form-row">
                <div class="col-md-6">
                    <input type="text" value="<?= get_input('nom') ?>"  name="nom" class="form-control" placeholder="Nom du produit" required="required" autofocus="autofocus">
                </div>
                <div class="col-md-6">
                    <input type="text"  value="<?= get_input('prix') ?>"  name="prix" class="form-control" placeholder="son prix" required="required">
                </div>
                
              </div>
          </div>
          
          <div class="form-group">
                    <input type="file" name="image" accept="image/*" required="required"> <a >Choisir un fichier image</a>
          </div>
          
        </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Annuler</button>
            <input type="submit" class="btn btn-primary" value="Ajouter">
          </div>
          </form>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Page level plugin JavaScript-->
    <script src="vendor/chart.js/Chart.min.js"></script>
    <script src="vendor/datatables/jquery.dataTables.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin.min.js"></script>

    <!-- Demo scripts for this page-->
    <script src="js/demo/datatables-demo.js"></script>
    <script src="js/demo/chart-area-demo.js"></script>

  </body>

</html>
<?php }
else {
  echo '<meta http-equiv="refresh" content="0;URL=connexion.php">';
}?>