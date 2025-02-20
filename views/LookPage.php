
<div class='nav_bare'>
    <a class ='lin_connect'href= "/Kephale/user" >
        <img class="icon_user" src="public/asset/_icone/retoure.svg" alt="">
        </a>
    <h5>Boutique</h5>
</div>
<div style="padding-top: 80px;" ></div>

<section class='bloc_form_p' >
        <h1>Entre votre mot de passe</h1>
        <p></p>
        <form method="POST" enctype="multipart/form-data">
            <section class='bloc_form_input'>
            <input  type="password" placeholder="Mot de passe" name="password_user">
            </section>
            <input class="boutton_inpute" class="submit" type="submit" value="Confirme" name="confirme">

            <?php if (isset($erreur)) { ?> <h2 class="erreur"><?php echo $erreur ?></h1> <?php } ?>
        </form>
    </section>
    </section>
