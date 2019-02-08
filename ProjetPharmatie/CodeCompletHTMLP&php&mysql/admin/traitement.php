<?php 
session_start();
//connect to database
require('other/bdd.connexion.php');
require('other/fonction.php');
?>
<?php
if (isset($_POST)) {
     extract($_POST);
     $errors=[];
     if (is_already_in_use('produit',$nom,'produits')) {
       $errors[]='Ce produit existe déjà.';
     }
     if (count($errors)==0) {
       $ins2=$bdd->prepare('INSERT INTO produits(produit, apercu, date, prix, disponibilite, pharmatie, idpharmatie) 
                                          VALUE(:produit, :apercu, NOW(), :prix, :disponibilite, :pharmatie, :idpharmatie )');
      $ins2->execute([
        'produit'=>strip_tags($nom),
        'apercu'=>$_FILES['image']['name'],
        'prix'=>strip_tags($prix),
        'disponibilite'=>'1',
        'pharmatie'=>$_SESSION['nom'],
        'idpharmatie'=>$_SESSION['id']
      ]);
      if ($ins2) {
        $ins3=$bdd->prepare('SELECT * FROM produits WHERE pharmatie=:pharmatie');
        $ins3->execute(['pharmatie'=>$_SESSION['nom']]);
        $rs=$ins3->fetch();
        $nouveauNom = $rs['id'].'_'.$rs['pharmatie'].'_'.$_FILES['image']['name'];
                  $destination='../../Fichiers/Actualite/';
                  $se='\\';
                  $result = move_uploaded_file($_FILES['image']['tmp_name'], 'images/'.$nouveauNom);

        echo ' <meta http-equiv="refresh" content="0;URL=index.php">';



      }
     }
}
?>