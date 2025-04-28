<div class='nav_bare'>
    <section class="bloc_nave">
    <a class ='lin_connect'href= "/Kephale/user" >
        <img class='retoure' src="public/asset/_icone/retoure.svg" alt="">
        </a>
    <h5>Liste  achats</h5>
    </section>
</div>
<div style="padding-top: 80px;" ></div>
<section class="blockFacture">


<?php


if(isset($liste_achats)){

    foreach ($liste_achats as $liste_achat){
        $id_achat = $liste_achat['id'];
        $id_article = $liste_achat['id_article'];
        $prix_article = $liste_achat['prix_article'];
        $psa = $liste_achat['psa'];
        $promo = $liste_achat['promo'];
        $total = $liste_achat['total'];
        $taille = $liste_achat['taille'];
        $date_achat = $liste_achat['date_achat'];
        $date_livraison = $liste_achat['date_livraison'];
        $etat_livraison = $liste_achat['etat_livraison'];

        ?>
<section style='  margin-bottom: 10px;' class="blockFac">

          <section class='blockInfoArticle'>
            <section style='display: flex;'>
                <img style = 'object-fit: cover;' src="public/asset/img_article/<?= $img_article ;?>" alt="">
                <section class='InfoArticle'>
                    <h1>article non</h1>
                    <h2>prix</h2>
                    <h3>boutique</h3>
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
        <h2>Prix a l'achat: <span ><?= '1000' ?></span></h2>
        <h2>psa: <span ><?= '1000' ?></span></h2>
        <section>
        <p>date achat</p>
        <p>date Livraison</p>
        </section>
        <form action="" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id_achat" value="<?= $id_achat?>">
            <input class="boutton_inpute" class="submit" type="submit" value="Confirme l'achat" name="inscrire">
            </form>
        </section>
        </section>
        <?php
    }
}
?>


</section>