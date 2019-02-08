<?php 
session_start();
//connect to database
require('other/bdd.connexion.php');
require('other/fonction.php');
?>
<?php 
if (isset($_SESSION['email']) && !empty($_SESSION['email'])) {
         if(isset($_GET['idprod']) && !empty($_GET['idprod']) ){
             $ins6=$bdd->prepare('SELECT disponibilite FROM produits WHERE id=:id');
             $ins6->execute(['id'=>$_GET['idprod']]);
             $resultat=$ins6->fetch();
             if ($resultat['disponibilite'] == 0) {
                 $update=$bdd->prepare('UPDATE produits
                 SET disponibilite=1 WHERE id=:id');
                 $update->execute(['id'=>$_GET['idprod']]);
                 if ($update) {
                    echo '<meta http-equiv="refresh" content="0;URL=index.php">';

                 }
             }elseif ($resultat['disponibilite'] == 1 ) {
                $update=$bdd->prepare('UPDATE produits
                SET disponibilite=0 WHERE id=:id');
                $update->execute(['id'=>$_GET['idprod']]);
                if ($update) {
                    echo '<meta http-equiv="refresh" content="0;URL=index.php">';

                }
             }
}
else{ echo '<meta http-equiv="refresh" content="0;URL=index.php">';}


}else {
      echo '<meta http-equiv="refresh" content="0;URL=connexion.php">';}
 ?>    