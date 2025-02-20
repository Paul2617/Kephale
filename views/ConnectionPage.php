<div class='bloc'>

<section class='retour'>
    <a class='link_retour' href="/Kephale/accueil"> <img class='img_icon' src="public/asset/_icone/retoure.svg" alt=""></a>
</section>


<div class='bloc_form'>
        <section class='bloc_form_p' >
        <h1>Connexion</h1>
        <form method="POST" enctype="multipart/form-data">
            <section class='bloc_form_input'>
            <h5>Numéro</h5>
            <input  type="number" placeholder="Numéro" name="telephone" value="<?php if (isset($telephone)) { echo $telephone;} ?>">
            <h5>Mot de passe</h5>
            <input  type="password" placeholder="Mot de passe" name="password_user">

            </section>
            <input class="boutton_inpute" class="submit" type="submit" value="Connexion" name="conection">

            <?php if (isset($erreur)) { ?> <h2 class="erreur"><?php echo $erreur ?></h1> <?php } ?>
            <h1 class='text_d' >Je <a class='link' href="/Kephale/inscription">m'inscris</a></h1>
        </form>
    </section>
    </section>

</div> 
</div>   
