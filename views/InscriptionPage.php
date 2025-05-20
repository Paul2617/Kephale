<div class='nav_bare'>
    <section class="bloc_nave">
        <a class='lin_connect' href="/Kephale/accueil">
            <img class='retoure' src="public/asset/_icone/retoure.svg" alt="">
        </a>
        <h5>Inscriptions</h5>
    </section>
</div>

<div style="padding-top: 80px;"></div>



<section class='block_info_boutique flex'>

<form class='ffdofjfjjd' method="POST" enctype="multipart/form-data">
<section class='blocfildd'>
                    <input type="file" id="file" name="img_demande">
                    <label for="file">
                        <img src="public/asset/img_user/logo.png" alt="">
                        <h4>Modifier la photo</h4>
                    </label>
                </section> 
    <h5 class='h5d'>Nom complet</h5>
        <input class='ddfkdmjfkff'  type="text" placeholder="Nom" name="nom_user" value="<?php if (isset($nom_user)) {echo $nom_user;} ?>">
        <h5 class='h5d'>Numéro de téléphone</h5>
        <input class='ddfkdmjfkff'  type="number" placeholder="Numéro de téléphone" name="numeraux_user"value="<?php if (isset($numerau_user)) {echo $numerau_user;} ?>">
        <h5 class='h5d'>Mot de passe</h5>
        <input class='ddfkdmjfkff' type="password" placeholder="Mot de passe" name="password_user">
        <h5 class='h5d'>Comfirmer mot de passe</h5>
        <input class='ddfkdmjfkff' type="password" placeholder=" Comfirme mot de passe" name="password_user_2">
         <h5 class='h5d'>Sexe</h5>
      <div class="bloc_taille">
            <div class="form-element-plus">
            <input type="radio" name="category" value="homme" id="homme">
            <label for="homme">
            <div class="title">Homme</div>
            </label>
            </div>
             <div class="form-element-plus">
            <input type="radio" name="category" value="femme" id="femme">
            <label for="femme">
            <div class="title">Femme</div>
            </label>
            </div>
      </div>
        <input class='ddjfkff' type="submit" value="M'inscrire" name="inscrire"> 
        <?php if (isset($erreur)) { ?> <h2 class="erreur"><?php echo $erreur ?></h1> <?php } ?>
         <h1 class='dmmefnkfkjfk'>Me <a class='link' href="/Kephale/connection">Connecter</a></h1>
    </form>
</section>