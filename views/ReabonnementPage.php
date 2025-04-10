<div class='nav_bare'>
    <a class ='lin_connect'href= "/Kephale/user" >
        <img class="icon_user" src="public/asset/_icone/retoure.svg" alt="">
        </a>
</div>

<section class="bloc_form">

<section class='bloc_form_p' >
        <h4>Abonnement épuisé !</h4>
        <p>Bonjour cher client votre abonnement du mois est epuise merci de vous réabonne pour continue à utilise votre Boutique.</p>

        <form method="POST" enctype="multipart/form-data">
            <section class='bloc_form_input'>
            <h2 style = "font-size: 11px;">Entre votre mote de passe pour vous réabonne.</h2>
            <input  type="password" placeholder="Mot de passe" name="password_user" required>
            </section>
            <input class="boutton_inpute" class="submit" type="submit" value="Confirme" name="confirme">

            <?php
            if (isset($erreur)) { ?> <h2 class="erreur"><?php echo $erreur ?></h1> <?php } ?>
        </form>
    </section>
    </section>
</section>