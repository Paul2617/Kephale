



    <div class='lvgkdjshjgh'>
          <div class="eelllfllekkf">

<?php
if($listePanie !== null){
      require_once ('../models/solde_affiche/solde.php');

    foreach($listePanie  as $listePanies){
           $id_panie = $listePanies["id_panie"];
           if(isset($_POST["achete"])){
            $id_article_post = $_POST["id_article_post"];
             header ('Location: /Kephale/articles&id_article='. $id_article_post);
           }
            if(isset($_POST["supprime_panie"])){
            $id_panie_post = $_POST["id_panie_post"];
            supprimePanier($bd, $id_panie_post);
           }
          ?>
            <div  class='sskddjdj'>
            <img class="lvgkdjshjgh_img" src="public/asset/img_article/<?= $listePanies["nom_image"]?>" alt="">
            <p><span></span><?= $listePanies["descriptions"]?></p>
            <h2><?=  solde ($listePanies["prix"])?></h2>
            <form class='form_panier'  method="POST" enctype="multipart/form-data" >
            <input type="hidden" value="<?= $listePanies["id_article"] ?>" name="id_article_post" >
             <input type="hidden" value="<?= $listePanies["id_panie"] ?>" name="id_panie_post" >
            <input type="submit" value="Achète" name="achete" >
            <input class='suppe' type="submit" value="Supprimer" name="supprime_panie"  >
            </form>
          </div>

        <?php
    
    }
    }
    ?>
    
    

          </div>
    </div>