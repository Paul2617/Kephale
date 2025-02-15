    <div>
    <h1>Connexion</h1>
    <section>
        <form method="POST" enctype="multipart/form-data">
            <section >
            <input  type="number" placeholder="Numéro" name="telephone" value="<?php if (isset($telephone)) { echo $telephone;} ?>">
            <input  type="password" placeholder="Mot de passe" name="password_user">
            </section>
            <input class="boutton_inpute" class="submit" type="submit" value="Connexion" name="conection">
            <?php if (isset($erreur)) { ?> <h1 class="erreur"><?php echo $erreur ?></h1> <?php } ?>
            <h1 >Je <a href="">m'inscris</a></h1>
        </form>
    </section>
</div>