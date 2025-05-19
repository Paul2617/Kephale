<div class='nav_bare'>
    <section class="bloc_nave">
        <a class='lin_connect' href="/Kephale/?url=userparametre">
            <img class='retoure' src="public/asset/_icone/retoure.svg" alt="">
        </a>
        <h5>Modifications</h5>
    </section>

</div>
<div style="padding-top: 80px;"></div>

<section class='block_info_boutique flex'>

    <form class='ffdofjfjjd' method="POST" enctype="multipart/form-data">

        <section class='blocfildd'>
            <input type="file" id="file" name="img_demande">
            <label for="file">
                <img src="public/asset/img_user/<?= $info_user ["img_user"]?>" alt="">
                <h4>Modifier l'image</h4>
            </label>
        </section>
        <h5 class='h5d'>Nom complet </h5>
        <input class='ddfkdmjfkff' type="text" name="new_nom" value="<?= $info_user ["nom_user"] ?>">
        <h5 class='h5d'>Numéro de téléphone</h5>
        <input class='ddfkdmjfkff' type="text" name="new_tel" value="<?= $info_user ["tel_user"] ?>">
        <h5 class='h5d'>Ancien mot de passe</h5>
        <input class='ddfkdmjfkff' type="text" name="encien_password" placeholder="Ancien mot de passe" >
        <h5 class='h5d'>Nouveaux mot de passe</h5>
        <input class='ddfkdmjfkff' type="password" name="new_password" placeholder="Nouveaux mot de passe">

        <input class='ddjfkff' type="submit" value="Modifié" name="modifie">
        <?php if (isset($erreur)) { ?> <h2 class="erreur"><?php echo $erreur ?></h1> <?php } ?>
    </form>
</section>
<?php 