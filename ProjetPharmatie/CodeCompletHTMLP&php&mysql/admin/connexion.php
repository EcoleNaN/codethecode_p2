<?php 
session_start();
//connect to database
require('other/bdd.connexion.php');
require('other/fonction.php');
?>
<!DOCTYPE html>
<html lang="fr">
  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>::Connexion</title>

    <!-- Bootstrap core CSS-->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">
  </head>

  <body class="bg-dark">

<?php

if (isset($_POST)) {
  extract($_POST);
  $errors=[];
  if (!empty($email) && !empty($password)) {
    $email_t = strip_tags($email);
    $password_t = strip_tags($password);
      $utilisateur=$bdd->prepare('SELECT * FROM utilisateur WHERE email=:email AND password=:password');
      $utilisateur->execute([
        'email'=>$email_t,
        'password'=>$password_t
      ]);
      $userFound = $utilisateur->rowCount();
      if ($userFound !== 0) {
        $success=[];
        //si l'utilisateur existe.
        $user = $utilisateur->fetch();
        $_SESSION['id'] = $user['id'];
        $_SESSION['nom'] = $user['nom'];
        $_SESSION['email'] = $user['email'];
        echo '<meta http-equiv="refresh" content="3;URL=index.php">';      
        $success[]= 'Bienvenue! Vous allez etre rediriger.';
      }else {
        //si il n'existe pas.
        echo'';
        $errors[]= 'Pseudo ou Mot de passe invalide';
        save_input_data();
      }
  }else {
    $errors[]='Remplissez tous les champs Svp';
    clear_input_data();
  }
}
?>

    <div class="container">
      <div class="card card-login mx-auto mt-5">
        <div class="card-header " style="background-color:gray;"><center style="font-weight:bold;">Connexion</center> <hr>
        <?php if (!empty($errors)): ?>
    <?php foreach($errors as $error): ?>
  
         <div class="alert alert-danger alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
           <strong>Probleme!<strong> <?= $error ?>.
         </div>

         
    <?php endforeach ?>
    <?php endif ?>
    <?php if (!empty($success)) : ?>.
   
   <?php foreach($success as $succes1): ?>
         <div class="alert alert-success alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
           <strong>Sucess!<strong> <?= $succes1 ?>.
         </div> 
         <?php endforeach ?> 
   <?php endif ?>
      </div>
        <div class="card-body">
        <form action="" method="post">
            <div class="form-group">
                <input type="email" value="<?= get_input('email') ?>" name="email" class="form-control" placeholder="Email address" required="required" autofocus="autofocus">
            </div>
            <div class="form-group">
                <input type="password" name="password" class="form-control" placeholder="Mot de passe" required="required">
            </div>
            <div class="form-group">
              <div class="checkbox">
                <label>
                  <input type="checkbox" value="remember-me">
                  Enregistrer mon mot de passe
                </label>
              </div>
            </div>
            <input type="submit" class="btn btn-primary btn-block" value="connexion" >
          </form>
          <div class="text-center">
            <a class="d-block small mt-3" href="connexion.php">Créer un compte</a>
            <a class="d-block small" href="forgot-password.php">Mot de passe oublié?</a>
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  </body>

</html>
