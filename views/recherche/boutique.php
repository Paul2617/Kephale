<?php
while ($result = $stmt->fetch()) {
    $boutique_id = $result["boutique_id"];
    $nomBoutique = $result["nom"];
    $imgBoutique = $result["img"];
    $paysBoutique = $result["pays"];
    $user_nom = $result["user_nom"];
    $user_img = $result["user_img"];

    $recCategorie = $bd->prepare("SELECT * FROM categorie WHERE id_boutique = ? LIMIT 3 ");
    $recCategorie->execute(array($boutique_id));

    ?>
    <section class='blocArticlP'>
        <!--Bloc info boutique-->
        <section class='infoBoutique'>
            <section class='blookk'>
                <img class='dkdkdk' src="public/asset/img_user/<?=  $user_img ?>" alt="">
                <section class='infotextebta'>
                    <h1><?=  $user_nom ?></h1>
                    <p><?=  $paysBoutique ?></p>
                </section>
            </section>
        </section>
        <!--Bloc info boutique fin-->

        <!--Bloc img  catégorie-->
        <img class='imgCategori' src="public/asset/img_boutique/<?=  $imgBoutique ?>" alt="">
        <!--Bloc img  catégorie fin-->

        <!--Bloc info  catégorie-->
        <section class='blocinfoCategorie'>
            <h1><?=  $nomBoutique ?></h1>
            <p>Categori</p>
        </section>
        <!--Bloc info  catégorie-->
        <!--Bloc info  produit-->
        <section class="BlockProduit">
            <a href="/Kephale/boutiquepub&id=<?=  $boutique_id ?>">
                <img class="imgContour" src="public/asset/img_boutique/<?=  $imgBoutique ?>" alt="">
                <p class="pColor" >voir +</p>
            </a>
            <?php
            if($recCategorie->rowCount() >= 1){
                while ($result_recCategorie = $recCategorie->fetch()) {
                    $typesC = $result_recCategorie["types"];
                    $imgC = $result_recCategorie["img"];
                    ?>
                    <a >
                <img src="public/asset/img_categori/<?=  $imgC ?>" alt="">
                <p class='p' ><?=  $typesC ?></p>
            </a>
                    <?php
                }
            }
            ?>
        </section>
    </section>
    <?php
}
?>