<?php 
session_start();
//connect to database
require('other/bdd.connexion.php');
require('other/fonction.php');
?>
<?php 

if (isset($_SESSION['email']) && !empty($_SESSION['email'])) {
    $dg=$bdd->prepare('SELECT * FROM utilisateur WHERE email=:email');
    $dg->execute([
      'email'=>$_SESSION['email']
    ]);
    $garde=$dg->fetch();
         if(isset($_GET['id']) && !empty($_GET['id']) ){
             if($garde['garde']==0){
             $ins6=$bdd->prepare('UPDATE utilisateur
             SET garde=1 WHERE id=:id');
             $ins6->execute([
                 'id'=>$_GET['id']
                 ]);
             if ($ins6) {
                echo '<meta http-equiv="refresh" content="0;URL=index.php">';
            }
        }else{
            $ins6=$bdd->prepare('UPDATE utilisateur
             SET garde=0 WHERE id=:id');
             $ins6->execute([
                 'id'=>$_GET['id']
                 ]);
             if ($ins6) {
                echo '<meta http-equiv="refresh" content="0;URL=index.php">';
            }
        }
        }

else{ echo '<meta http-equiv="refresh" content="0;URL=index.php">';}


}else {
      echo '<meta http-equiv="refresh" content="0;URL=connexion.php">';}
 ?>    