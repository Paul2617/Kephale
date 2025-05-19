<?php  
// alerte confirme l'achat
    if(empty($_POST["ferme"])){
    if(isset($_POST["supprimerd"])){
        $titre = "Supprimer le produit";
        $contenue = "En supprimant le produit, vous supprimez tous les articles du produit.";
        $nameBoutton = 'supprimer_produit';
        $valueBoutton = 'Supprimer';
        $nameInfoId = 'id_categorie';
        $valueInfoId = $_GET['id_categorie'];
        require_once ('../components/alerte.php');
        Alerte ( $titre, $contenue, $nameBoutton, $valueBoutton, $nameInfoId, $valueInfoId );
    }
}
?>
<?php 

;?>
<section style=' margin-bottom: 100px;' class='block_info_boutique flex'>
<form class='ffdofjfjjd' method="POST" enctype="multipart/form-data">
<section class='blocfildd'>
    <a href="">
                    <label for="file">
                        <img src="public/asset/img_article/<?= $img_article ;?>" alt="">
                        <h4>Modifier l'image</h4>
                    </label>
                    </a>
                </section> 
         <h5 class='h5d'>Nom de l'article </h5>
        <input class='ddfkdmjfkff'  type="text" name="new_nom_article" value="<?=  $nom_article ;?>">
        <h5 class='h5d'>Prix de l'article FCFA</h5>
        <input class='ddfkdmjfkff'  type="number" name="new_prix_article" value="<?=$prix_article ;?>">
         <h5 class='h5d'>Descriptions de l'article</h5>
         <textarea class="doldkdmslls" name="new_descriptions_article" placeholder="Descriptions" rows="3"><?= $descriptions_article ?></textarea>
         <section style=' margin-bottom: -20px;'>
  <?php
                     if($types_produit === 'Vêtement'){
                          ?>    <h5 class='h5d'>Les tailles actuelles sont <?php foreach($blocle as $blocl){ echo $blocl.' ';} ?> </h5> <?php
                        require_once "../views/taille/taille_vetement.php";
                     }elseif($types_produit === 'Chaussure'){
                          ?>    <h5 class='h5d'>Les tailles actuelles sont <?php foreach($blocle as $blocl){ echo $blocl.' ';} ?> </h5> <?php
                        require_once "../views/taille/taille_chaussure.php";
                     }


                ?>
         </section>

             <?php
                // si la boutique est payen par mois
                if($etatAbonnement !== 'G'){
                    if($date_livraison_article === "0"){
   ?>
                    <h5 class='h5d'>Vous pouvez déterminer un délai de livraison.</h5>
                 <section class ='info_radio_djs'>
                 <select class="form_input_ddj" name="new_delais">
                            <option value="">Délai de livraison</option>
                            <option value="432000">(5) jours</option>
                            <option value="864000">(10) jours</option>
                            <option value="1296000">(15) jours</option>
                            <option value="1728000">(20) jours</option>
                        </select>
                 </section>
                     <?php
                    }else{
                           ?>
                    <h5 class='h5d'>Le délai de livraison actuel est de <?=$jour;?> jous.</h5>
                 <section class ='info_radio_djs'>
                 <select class="form_input_ddj" name="new_delais">
                            <option value="">Délai de livraison</option>
                            <option value="00">Annuler</option>
                            <option value="432000">(5) jours</option>
                            <option value="864000">(10) jours</option>
                            <option value="1296000">(15) jours</option>
                            <option value="1728000">(20) jours</option>
                        </select>
                 </section>
                     <?php
                    }
                 
                }
                ?>      
        <input class='ddjfkff' type="submit" value="Modifié" name="modifie_article"> 
        <?php if (isset($erreur)) { ?> <h2 class="erreur"><?php echo $erreur ?></h1> <?php } ?>
    </form>
</section>

<?php 