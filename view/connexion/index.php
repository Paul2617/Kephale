<?php new html(); ?>
<body>
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
     <h5>Connexion</h5>
    
</div>

    <div class='div_blok div_blok_tenter' >
        <section class='section section_width' >            
            <form method="POST" enctype="multipart/form-data">
               <p class='formTexte'>Numéro de téléphone</p>
               <input type="number" placeholder="Numéro de téléphone" name="telephone" 
               value="<?php if (isset($telephone)) { echo $telephone;} ?>" required>
               <p class='formTexte'>Mot de passe</p>
               <div class="password-container">
               <input style="width: 100%;"   id="password"   type="password" placeholder="Mot de passe" name="password" required>
               <span class="toggle-password" onclick="togglePassword()">👁️</span>
               </div>
                <input type="hidden" name="csrf_token" value="<?= $csrfToken  ?>">
               <input class="submit" type="submit" value="Connexion" name="connexion"> 
               <?php if (isset($errors)) { ?> <h2 class="erreur"><?php echo $errors ?></h1> <?php } ?>
               <h1 style='font-size: 12px; text-align: center;' >Pas encore de compte ? <br> <a class='link' href="/inscription">Inscrivez-vous gratuitement</a></h1>
            </form>
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
    </script>
</body>
