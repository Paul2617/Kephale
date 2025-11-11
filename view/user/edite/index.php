<?php ; new html(); ?>

<body>
         <style>
                .password-container {
                    position: relative;
                    width: 35%;
                }

         
                .toggle-password {
                    position: absolute;
                    top: 50%;
                    right: 10px;
                    transform: translateY(-50%);
                    cursor: pointer;
                    font-size: 18px;
                    color: #555;
                }

                     .toggle-passwordNew {
                    position: absolute;
                    top: 50%;
                    right: 10px;
                    transform: translateY(-50%);
                    cursor: pointer;
                    font-size: 18px;
                    color: #555;
                }
                </style>
    <div class='nav_bare'>
        <section class='retoure'>
            <a style="width: 30px; height: 30px;" href="/user/parametre">
                < </a>
        </section>

    </div>
    <div style=" margin-bottom: 5rem;"></div>

    <div class='div_blok'>
        <section class='section section_width'>
            <form method="POST" enctype="multipart/form-data" autocomplete="off">
                <section class='section'>
                    <input type="file" id="file" name="image">
                    <label for="file">
                        <img style="border-radius: 7px; width: 50px; height: 50px; object-fit: cover;" src="/assets/img_profil/<?= $img_profile ?>" alt="">
                        <h2>Modifie l'image de profile</h2>
                    </label>
                </section>
                <p style="text-align: center; color: red; margin-top: -25px; margin-bottom: 10px;" ><?php if(isset($infoAlte)){ echo $infoAlte;} ?></p>
                <input style="margin-top: -20px; margin-bottom: 20px;" class="submit" type="submit"
                    value="Modifier l'image" name="new_img">

                <p class='formTexte'>Nom complet</p>
                <section style=" display: flex; justify-content: space-between;">
                    <input style="width: 60%;" type="text" name="nom" value="<?= $nom ?>" required>
                    <input class="submit" type="submit" value="Modifier" name="new_nom">
                </section>

                <p class='formTexte'>Numéro de téléphone</p>
                <section style=" display: flex; justify-content: space-between;">
                    <input style="width: 60%;" type="number" name="telephone" value="<?= $numero ?>" required>
                    <input class="submit" type="submit" value="Modifier" name="new_telephone">
                </section>
                <p class='formTexte'>Mot de passe</p>
           
                <section style=" display: flex; justify-content: space-between;">
                    <div class="password-container">
                    <input  id="password" style="width: 100%;"   type="password" name="password" placeholder="Mot de passe"
                        autocomplete="off">
                        <span class="toggle-password" onclick="togglePassword()">👁️</span>
                    </div>
                     <div class="password-container">
                    <input  id="passwordNew" style="width: 100%;"   type="password" name="passwordNew" placeholder="Nouveaux code"
                        autocomplete="off">
                        <span class="toggle-passwordNew" onclick="togglePasswordNew()">👁️</span>
                    </div>
                    <input class="submit" type="submit" value="Modifier" name="new_password">
                </section>
                <input type="hidden" name="csrf_token" value="<?= $csrfToken ?>">
                <p class='formTexte'>Sexe: <?= $sexe ?></p>
                <section style=" display: flex; justify-content: space-between;">
                    <div class="bloc_taille">
                        <div class="form-element-plus">
                            <input type="radio" name="sexe" value="Homme" id="homme">
                            <label for="homme">
                                <div class="title">Homme</div>
                            </label>
                        </div>
                        <div class="form-element-plus">
                            <input type="radio" name="sexe" value="Femme" id="femme">
                            <label for="femme">
                                <div class="title">Femme</div>
                            </label>
                        </div>
                    </div>
                    <input class="submit" type="submit" value="Modifier" name="new_sex">
                </section>

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
    <div style=" margin-bottom: 5rem;"></div>
    <?php new html_nav_bar(info: 'parametre'); ?>
</body>