<div class='bloc'>

    <section class='retour'>
        <a class='link_retour' href="/kephale/accueil"> <img class='img_icon' src="public/asset/_icone/retoure.svg"
                alt=""></a>
    </section>


    <div class='bloc_form'>
        <section class='bloc_form_p'>
            <h1>Inscription</h1>
            <form method="POST" enctype="multipart/form-data">
                <section class='bloc_form_input'>
                    <h5>Nom complet</h5>
                    <input class="form_input" type="text" placeholder="Nom" name="nom_user"
                        value="<?php if (isset($nom_user)) {echo $nom_user;} ?>">
                    <h5>Numéro de téléphone</h5>
                    <input class="form_input" type="number" placeholder="Numéro de téléphone" name="numeraux_user"
                        value="<?php if (isset($numerau_user)) {
                                                                                                                            echo $numerau_user;                                                                                                        } ?>">

                    <h5>Mot de passe</h5>
                    <input type="password" placeholder="Mot de passe" name="password_user">
                    <h5>Comfirmer mot de passe</h5>
                    <input type="password" placeholder=" Comfirme mot de passe" name="password_user_2">
                    <section class ='info_radio'>
                        <label>
                            <input type="radio" name="category" value='homme'>
                            Homme
                        </label>
                        <label>
                            <input type="radio" name="category" value='femme'>
                            Femme
                        </label>
                        <label>
                            <input type="radio" name="category" value='enfant'>
                            Enfant
                        </label>
                    </section>

                </section>
                <input class="boutton_inpute" class="submit" type="submit" value="M'inscrire" name="inscrire">

                <?php if (isset($erreur)) { ?> <h2 class="erreur"><?php echo $erreur ?></h1> <?php } ?>
                    <h1 class='text_d'>Me <a class='link' href="/kephale/connection">Connecter</a></h1>
            </form>
        </section>
        </section>

    </div>
</div>