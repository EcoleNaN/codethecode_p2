<?php 
session_start();
//connect to database
require('other/bdd.connexion.php');
require('other/fonction.php');
?>
<?php 
if (isset($_SESSION['email']) && !empty($_SESSION['email'])) {
         if(isset($_GET['idprod']) && !empty($_GET['idprod']) ){
             $ins6=$bdd->prepare('DELETE  FROM produits WHERE id=:id');
             $ins6->execute([
                 'id'=>$_GET['idprod']
                 ]);
             if ($ins6) {
                echo '<meta http-equiv="refresh" content="0;URL=index.php">';
            }
}
else{ echo '<meta http-equiv="refresh" content="0;URL=index.php">';}


}else {
      echo '<meta http-equiv="refresh" content="0;URL=connexion.php">';}
 ?>    