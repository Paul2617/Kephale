<?php  
// alerte confirme l'achat
    if(empty($_POST["ferme"])){
    if(isset($_POST["confirme"])){
        $titre = "Confirme la livraison de l'article";
        $contenue = "En confirmant la réception de l'article, vous confirmez qu'il vous a été livré.";
        $nameBoutton = 'confirmeLivraison';
        $valueBoutton = 'Confirme la livraison';
        $nameInfoId = 'idArticleConfirme';
        $valueInfoId = $_POST['id_achat'] ;
        require_once ('../components/alerte.php');
        Alerte ( $titre, $contenue, $nameBoutton, $valueBoutton, $nameInfoId, $valueInfoId );
    }
}
// alerte annule l'achat avec motife
if(empty($_POST["ferme"])){
    if(isset($_POST["annulerLachatMotif"])){
        $titre = "Annuler l'achat ";
        $contenue = "Quelles sont les raisons qui vous poussent à annuler votre achat ?";
        $nameBoutton = 'annulerLachatMotife';
        $valueBoutton = "Annuler l'achat";
        $nameInfoId = 'id_achat';
        $valueInfoId = $_POST['id_achat'] ;
        require_once ('../components/alerte.php');
        AlertePlus ( $titre, $contenue, $nameBoutton, $valueBoutton, $nameInfoId, $valueInfoId );
    }
}
// annuler l'achat delait de livraison depasse 
if(empty($_POST["ferme"])){
    if(isset($_POST["annule_lachat"])){
        $titre = "Annuler l'achat";
        $contenue = "Veuillez nous excuser pour le retard de l'ivraison.<br> 
        N'hésitez pas à contacter le service de livraison pour signaler ou annuler votre achat. 
        <br>Service de livraison <a href='' style = 'color: #95C11F;'>+223 94 14 18 04</a>";
        $nameBoutton = 'annule_achat';
        $valueBoutton = "Annuler l'achat";
        $nameInfoId = 'id_achat';
        $valueInfoId = $_POST['id_achat'];
        require_once ('../components/alerte.php');
        Alerte ( $titre, $contenue, $nameBoutton, $valueBoutton, $nameInfoId, $valueInfoId );
    }
}
    ?>
<div class='nav_bare'>
    <section class="bloc_nave">

    <h5>Liste  achats</h5>
    </section>
</div>
<div style="padding-top: 80px;" ></div>

<section class="blockFacture">
<?php
require_once ('../models/solde_affiche/solde.php');

if(isset($liste_achats)){

    foreach ($liste_achats as $liste_achat){
        $id_achat = $liste_achat['id'];
        $id_article = $liste_achat['id_article'];
        $id_boutique = $liste_achat['id_boutique'];
        $prix_article = $liste_achat['prix_article'];
        $psa_user = $liste_achat['psa_user'];
        $psa_boutique = $liste_achat['psa_boutique'];
        $promo = $liste_achat['promo'];
        $total = $liste_achat['total'];
        $taille = $liste_achat['taille'];
        $date_achat = $liste_achat['date_achat'];
        $date_livraison = $liste_achat['date_livraison'];
        $etat_livraison = $liste_achat['etat_livraison'];
        // info article
        $info_article = info_article($bd, $id_article);
        // verifie si c'est le client sa payes le psa
       
     
        // verifi si l'article etait en prommo
        if( $promo !== 'non'){
            $promos = solde ($promo);
            $prix_articles = solde ($prix_article);

        }else{
            $prix_articles = solde ($prix_article);
        }
        // gere le tempt de livraison
        $tempsLivraisons = tempsLivraisons($bd, $date_livraison, $date_achat);
        // rec info pour le line de l'article
       $recId = recId ($bd,$id_article,$id_boutique );

       // article livre
        $articlelivre = articlelivre($bd, $id_achat, $etat_livraison);

        // verifie si l'achat est annule
        $achat_annule = achat_annule($bd, $id_achat);
        ?>
<section style='  margin-bottom: 10px;' class="blockFac">

          <section class='blockInfoArticle'>
            <section style='display: flex;'>
                <img style = 'object-fit: cover;' src="public/asset/img_article/<?= $info_article['img_article'] ;?>" alt="">
                <section class='InfoArticle'>
                    <h1><?= $info_article['nom_article'] ;?></h1>
                    <h2><?= $info_article['prix_article'] ;?></h2>
                    <a href="/Kephale/articles&id_boutique=<?= $liste_achat['id_boutique'];?>&id_categorie=<?= $recId['id_categorie'];?>&id_produit=<?= $recId['id_produit'];?>&id_article=<?= $id_article ;?>" style = 'color: #95C11F;' ><h3>Voir l'article</h3></a>
                </section>
            </section>
            <form action="" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id_achat" value="<?= $id_achat?>">
                <button class='dddufduud' name="parame" value="Connexion">
                    <h1>:</h1>
                </button>

            </form>
        </section>

        <section class='infoAchata'>
        <?php 
         if( $promo !== 'non'){
            ?>
            <h2>Prix a l'achat : <span style = 'color: #95C11F;' ><?= $promos ?></span> au lieu de <span style = 'text-decoration: line-through; color: #E94E1B;' ><?= $prix_articles  ?></span></h2>
            <?php 
         }else{
            ?>
        <h2>Prix a l'achat : <span ><?= $prix_articles  ?></span></h2>

             <?php 
         }
        ?>
        <?php

           if( $psa_user === 'non'){
        }else{
            $psa_use = solde ($psa_user);
            ?><h2>psa: <span ><?= $psa_use ?></span> </h2>  <?php
        }
            
        ?>
        <h2>Date d'achat : <span ><?= $tempsLivraisons['dateAchat'] ?></span></h2>
        <h2>Date limite : <span ><?= $date_livraison ?> Jours</span></h2>
        <h2>Totale : <span ><?= solde ($total) ?> </span></h2>
        <section>
        <?php  

        if($etat_livraison === 'non'){
        if($tempsLivraisons['etatLivraion'] === 'non'){
            ?>
            <p class='date_position' style=' color: #E94E1B;' >Délai de livraison passé</p>
            <p class='date_position' style=' color: #E94E1B;' ><?= $tempsLivraisons['dateLivraison'] ;?></p>
            <?php 
        }}
        ?>

        
        </section>
        <form class='blocBotoneListe'  method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id_achat" value="<?= $id_achat?>">
            <input type="hidden" name="id_boutique" value="<?= $liste_achat['id_boutique']?>">
            <?php  
            if($achat_annule === true ){
        if($etat_livraison === 'non'){
            ?>
            <input class="boutton_inpute" class="submit" type="submit" value="Confirme la livraison" name="confirme">
             <?php 
            }else{
                if($articlelivre !== null){
                    if(isset( $articlelivre['verdicte'])){
                        if($articlelivre['verdicte'] === 'traitement'){
                            ?>
                            <p class='date_position'>Votre demande est en cours de traitement...<br> Le service de livraison vous contactera dans les 24 h.</p>
                             <?php 
                        }elseif($articlelivre['verdicte'] === 'accorde'){
                            ?>
                            <p class='date_position'>Votre demande a été accordée.<br>  <a style=' color: #1D71B8;'  href="">Pour plus d'info...</a></p>
                           
                             <?php 
                        }elseif($articlelivre['verdicte'] === 'refuse'){
                            ?>
                            <p class='date_position' style=' color: #E94E1B;'  >Votre demande a été refusée.<br>  <a style=' color: #1D71B8;'  href="">Pour plus d'info...</a></p>
                           
                             <?php 
                        }
                       
                    }else{
                        $temp = $articlelivre['temp'];
                        if ($temp > time()) {
                            $chrono = $articlelivre['chrono'];
                            
                            ?>
                            <input class="boutton_inpute annule" class="submit" type="submit" value="Annuler l'achat" name="annulerLachatMotif">
                            <div>
                            <p class='date_position'>Temps requis pour vérifier l'article.</p>
                            <p class='date_position' ><?= $chrono ;?> minutes restantes</p>
                            </div>
                             <?php 
                        }else{
                            ?>
                            <p class='date_position'>Merci pour votre confiance.</p>
                             <?php 
                        }
                    }

              
            }
        }
             ?>
            <?php  
            if($etat_livraison === 'non'){
            if($tempsLivraisons['etatLivraion'] === 'non' ){
                ?>
            <input class="boutton_inpute annule" class="submit" type="submit" value="Annuler l'achat" name="annule_lachat">
                <?php
            }else{
                ?>
                <div>
                <p class='date_position'>Date limite pour la livraison</p>
                <p class='date_position' ><?= $tempsLivraisons['dateLivraison'] ;?></p>
                </div>
                 <?php
            } }
        }else{
            ?>
            <p class='date_position'>Achat annulé</p>
            <?php
        }
            ?>


            </form>
        
        
        
        </section>
        </section>
        <?php
    }
}
$_GET['url'];
if($_GET['url'] === "userachat"){
    $achaticon = 'home_3.svg';
}else{
     $achaticon = 'home_2.svg';
}
?>


</section>
<div style="padding-top: 80px;"></div>

 <section class="section_menu_icon">

    <a class="lien_icon" href="/Kephale/accueil">
        <img class="icon_menu" src="public/asset/home_svg/home.svg" alt="">
        <p>Kephale</p>
    </a>
    <a class="lien_icon" href="/Kephale/listepanier">
        <img class="icon_menu" src="public/asset/home_svg/panie.svg" alt="">
                <?php
        if($panierInfo > 0){
            ?>
        <section class="alerte_conteur">
            <p class="conteur"><?= $panierInfo  ?></p>
        </section>
            <?php
        }
        ?>
        <p>Panie</p>
    </a>

    <a class="lien_icon" href="/Kephale/user">
        <img class="icon_menu" src="public/asset/home_svg/user.svg" alt="">
        <p>Profil</p>
    </a>
    <a class="lien_icon" href="/Kephale/?url=userachat">
        <img class="icon_menu" src="public/asset/home_svg/<?= $achaticon  ?>" alt="">
              <?php

        if($achatInfo > 0){

            ?>
        <section class="alerte_conteur">
            <p class="conteur"><?php echo $achatInfo  ?></p>
        </section>
            <?php
        }
        ?>
        <p>Achats</p>
    </a>

    <a class="lien_icon" href="/Kephale/userparametre">
        <img class="icon_menu" src="public/asset/home_svg/parametre.svg" alt="">

        <p>Paramètre</p>
    </a>
</section>