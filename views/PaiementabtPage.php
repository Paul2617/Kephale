

<div class='nav_bare'>
    <section class="bloc_nave">

    <a class ='lin_connect'href= "/Kephale/abonnement" >
        <img class="retoure" src="public/asset/_icone/retoure.svg" alt="">
        </a>
    <h5>Payement abonnement</h5>
    </section>

</div>
<div style="padding-top: 80px;" ></div>
<div class='listabtn'>
        <section class='bloc_form_p' >
        <p>Entre votre Mot de passe pour confirmer l'achat</p>
        <form method="POST" enctype="multipart/form-data">
            <section class='bloc_form_input'>
            <input  type="number" placeholder="<?= $montantAbt  ?>" readonly>
            <h5>Mot de passe</h5>
            <input  type="password" placeholder="Mot de passe" name="password_user">
            </section>
            <input class="boutton_inpute" class="submit" type="submit" value="Confirme" name="confirme">

            <?php if (isset($erreur)) { ?> <h2 class="erreur"><?php echo $erreur ?></h1> <?php } ?>
        </form>
    </section>
    </section>

</div> 