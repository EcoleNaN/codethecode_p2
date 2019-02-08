<?php 
//connect to database
require('other/bdd.connexion.php');
require('other/fonction.php');
?>

<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>::Inscription</title>

    <!-- Bootstrap core CSS-->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <link href="css/sb-admin.css" rel="stylesheet">

  </head>

  <body class="bg-dark">
<?php
//php code here. insertion into db

if (isset($_POST)) {
  extract($_POST);
  $errors=[];
     if (!empty($nom) && !empty($email) && !empty($localite) && !empty($password)) {
       //si les champs ne sont pas vide..
                    //si la longueur est inférieur a 4
       if (mb_strlen($nom) <= 4) {
              $errors[]='nom trop cour, 4 caractères minimum';         
       }
                   //si le nom existe déjà
       if (is_already_in_use('nom',$nom, 'utilisateur')) {
              $errors[]='Cette pharmatie existe déjà, connectez-vous ou réessayez';
       }
                  //vérifie la validité de l'email.
       if (!filter_var($email, FILTER_VALIDATE_EMAIL) ) {
              $errors[]='Adressse Email Invalide';
       }
                 //si l'email est déjà utilisé.
       if (is_already_in_use('email',$email, 'utilisateur')) {
              $errors[]='Cette email existe déjà, connectez-vous ou réessayez.';
       }
       if ($password != $conf_password) {
              $errors[]='Les mots de passe ne concordent pas.';
       }
                //validité du mot de passe.
       if (mb_strlen($password) <= 6 ) {
              $errors[]='Mot de passe trop cour, 6 caractères minimums';
       }

       if (count($errors) == 0) {
         $success=[];
                  //insertion dans la base de donnée(...)
         $insertion=$bdd->prepare('INSERT INTO utilisateur(nom,localite,email,password,date) VALUE(:nom, :localite, :email, :password, NOW())');
         $insertion->execute([
           'nom'=>strip_tags($nom),
           'localite'=>strip_tags($localite),
           'email'=>strip_tags($email),
           'password'=>strip_tags($password)
         ]);
                    //si l'insertion a réussi alors...
             if ($insertion) {
               echo ' <meta http-equiv="refresh" content="3;URL=connexion.php">';
               $success[]='Votre compte a bien été créer, vous allez être rediriger dans un instant.';

             }
       }else {
         //dans le cas contraire
         save_input_data();
       }
     }else {
       //si tous les champs sont vides alors ecrire le message
       $errors[]='Veuillez remplir tous les champs';
     }
}

?>


    <div class="container">
      <div class="card card-register mx-auto mt-5">
        <div class="card-header " style="background-color:gray;"><center style="font-weight:bold;">Créer un compte</center> <hr>
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
              <div class="form-row">
                <div class="col-md-6">
                    <input type="text" value="<?= get_input('nom') ?>"  name="nom" class="form-control" placeholder="Nom de la pharamatie" required="required" autofocus="autofocus">
                </div>
                <div class="col-md-6">
                    <input type="text"  value="<?= get_input('localite') ?>"  name="localite" class="form-control" placeholder="localité" required="required">
                </div>
              </div>
            </div>
            <div class="form-group">
                <input type="email"  value="<?= get_input('email') ?>" name="email" class="form-control" placeholder="Address email" required="required">
            </div>
            <div class="form-group">
              <div class="form-row">
                <div class="col-md-6">
                    <input type="password" name="password"  id="inputPassword" class="form-control" placeholder="Mot de pass" required="required">
                </div>
                <div class="col-md-6">
                    <input type="password" name="conf_password" id="confirmPassword" class="form-control" placeholder="Confirmer le mot de passe" required="required">
                </div>
              </div>
            </div>
            <input type="submit" class="form-control btn btn-primary" value='créer' >
            <p><center>En cliquant sur créer vous acceptez <a href="">les termes et conditions d'utilisations</a>.</center></p>
          </form>
          <div class="text-center">
            <a class="d-block small" href="connexion.php">Déjà inscrit? connectez-vous!</a>
          </div>
        </div>
      </div>
    </div><hr>
    <div class="container">
      <div class="card "><div class="card-header "><center style="font-weight:bold;">Informations supplémentaires</center> </div>
        <div class="row">
          <div class="col-md-6">
            <div class="card">
              <div class="card-header" ><center style="font-weight:bold;">Pourquoi Créer un compte</center></div>
              <div class="card-body">
                Vous devez créer un compte si vous êtes une pharmatie car nous avons besoin de vos données pour la creation du compte
                et aussi de la liste des médicaments disponibles chez vous. 
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="card">
              <div class="card-header"><center style="font-weight:bold;">Comment Créer un compte</center>
              </div>
              <div class="card-body">
                Il vous suffit juste de vous inscrire et de suivre les informations pour arriver à votre profil adminitration. 

              </div>
            </div>
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
