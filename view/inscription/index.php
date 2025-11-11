<?php new html(); ?>

<body>
    <style>
        /* Styles déjà gérés par le CSS global */
        .nav_bare {
          position: fixed;
          top: 0;
          left: 0;
          right: 0;
          z-index: 1000;
          background-color: rgba(255, 255, 255, 0.95);
          backdrop-filter: blur(10px);
          -webkit-backdrop-filter: blur(10px);
          padding: 0.75rem 1rem;
          box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }
        
        body {
          padding-top: 60px;
        }
    </style>
    <div class='nav_bare'>
        <section class='nav_bare_logo'>
            <a href="/home">
                <img style='width: 30px;  height: 30px;' src="/assets/icons/home.svg" alt="">
            </a>
        </section>
        <h5>Inscription</h5>
    </div>

    <div class='div_blok div_blok_tenter'>
        <section class='section section_width'>

            <?php
if(isset($_SESSION['AUTH_CODE'])){
    ?>
            <form method="POST" enctype="multipart/form-data">
                <p class='formTexte'>Nom complet</p>
                <input type="number" placeholder="Code de verifications" name="code"
                    value="<?php if (isset($_POST['code'])) {echo $_POST['code'];} ?>" required>
                <input type="hidden" name="csrf_token" value="<?= $CsrfToken  ?>">
                <input class="boutton_inputee" type="submit" value="Confirme le code " name="code_valide">
                <?php if (isset($errors)) { ?> <h2 class="erreur"><?php echo $errors ?></h1> <?php } ?>
            </form>
            <?php
}else{
    ?>
            <form method="POST" enctype="multipart/form-data" autocomplete="off">
                <section>
                    <h4>Inscription</h4>
                </section>
                <p class='formTexte'>Nom complet</p>
                <input type="text" placeholder="Nom complet" name="nom" value="<?php if (isset($nom)) {echo $nom;} ?>"
                    required autocomplete="off">
                <p class='formTexte'>Numéro de téléphone</p>
                <input type="number" placeholder="Numéro de téléphone" name="telephone"
                    value="<?php if (isset($telephone)) {echo $telephone;} ?>" required autocomplete="off">
                <p class='formTexte'>Mot de passe</p>
                <div class="password-container">
                    <input style="width: 100%;" id="password" type="password" placeholder="Mot de passe" name="password"
                        required>
                    <span class="toggle-password" onclick="togglePassword()">👁️</span>
                </div>
                <p class='formTexte'>Comfirmer mot de passe</p>
                    <div class="password-container">
                    <input style="width: 100%;" id="passwordNew" type="password" placeholder="Comfirme mot de passe" name="password_2"
                        required>
                    <span class="toggle-passwordNew" onclick="togglePasswordNew()">👁️</span>
                </div>
                <input type="hidden" name="csrf_token" value="<?= $CsrfToken  ?>">
                <p class='formTexte'>Sexe</p>

                <div class="bloc_taille">
                    <div class="form-element-plus">
                        <input type="radio" name="sexe" value="Homme" id="Homme">
                        <label for="Homme">
                            <div class="title">Homme</div>
                        </label>
                    </div>
                    <div class="form-element-plus">
                        <input type="radio" name="sexe" value="Femme" id="Femme">
                        <label for="Femme">
                            <div class="title">Femme</div>
                        </label>
                    </div>
                    <div class="form-element-plus">
                        <input type="radio" name="sexe" value="Enfant" id="Enfant">
                        <label for="Enfant">
                            <div class="title">Enfant</div>
                        </label>
                    </div>
                </div>
                <input type="submit" value="S'inscrire" name="inscription">

                <?php if (isset($errors)) { ?> <h2 class="erreur"><?php echo $errors ?></h1> <?php } ?>
                    <h1 style='font-size: 12px; text-align: center;'>Déjà un compte ? <a class='link' href="/connexion">Connectez-vous</a>
                    </h1>

            </form>
            <?php
}
?>


        </section>

    </div>
        <script>
            function togglePassword() {
      const input = document.getElementById("password");
      const icon = document.querySelector(".toggle-password");

      if (input.type === "password") {
        input.type = "text";
        icon.textContent = "🙈"; // change l’icône
      } else {
        input.type = "password";
        icon.textContent = "👁️";
      }
    }

                function togglePasswordNew() {
      const input = document.getElementById("passwordNew");
      const icon = document.querySelector(".toggle-passwordNew");

      if (input.type === "password") {
        input.type = "text";
        icon.textContent = "🙈"; // change l’icône
      } else {
        input.type = "password";
        icon.textContent = "👁️";
      }
    }
    </script>
</body>