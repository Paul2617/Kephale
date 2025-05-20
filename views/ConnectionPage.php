

<div class='nav_bare'>
    <section class="bloc_nave">
    <a class ='lin_connect'href= "/Kephale/accueil" >
        <img class='retoure' src="public/asset/_icone/retoure.svg" alt="">
        </a>
    <h5></h5>
    </section>

</div>
<div class='bloc_form'>

<section class='block_info_boutique flex'>
<h1>Connexion</h1>
<form class='ffdofjfjjd' method="POST" enctype="multipart/form-data">
        <h5 class='h5d'>Numéro de téléphone</h5>
        <input class='ddfkdmjfkff'  type="number" placeholder="Numéro de téléphone" name="telephone" value="<?php if (isset($telephone)) { echo $telephone;} ?>">
        <h5 class='h5d'>Mot de passe</h5>
        <input class='ddfkdmjfkff' type="password" placeholder="Mot de passe" name="password_user">

<h5 class='h5d'></h5>
        <input class='ddjfkff' type="submit" value="Connexion" name="conection"> 
        <?php if (isset($erreur)) { ?> <h2 class="erreur"><?php echo $erreur ?></h1> <?php } ?>
         <h1 class='dmmefnkfkjfk'>Je <a class='link' href="/Kephale/inscription">m'inscris</a></h1>
    </form>
</section>
    </section>

</div> 
 
