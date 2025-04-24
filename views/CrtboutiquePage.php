
<div class='nav_bare'>
    <section class="bloc_nave">

    <a class ='lin_connect'href= "/Kephale/user" >
        <img class="retoure" src="public/asset/_icone/retoure.svg" alt="">
        </a>
    <h5>Création boutique</h5>
    </section>

</div>
<div style="padding-top: 80px;" ></div>

<section class='bloc_form_p' >
            <style>
                .alte{
                    color : #95C11F;
                    font-size: 14px;
                }
            </style>
            <h6 class='alte' > <?php if(isset($alt)){echo $alt;}?></h6>
        <h1> Ajouter vots informations</h1>
        <p></p>
        <form method="POST" enctype="multipart/form-data">
            <section class='bloc_form_input'>
            <input  type="text" placeholder="Nom de la boutique" name="nomBoutique" value="<?php if (isset($nomBoutique)) {echo $nomBoutique;} ?>" >
            </section>
            <p>Veuillez ajouter le logo de la boutique.</p>

            <section class ='blocfil'>
            <input type="file" id="file" name="img_demande">
            <label for="file">
            <img src="public/asset/_icone/appareil.svg" alt="">
            <h4>Ajouter</h4>
            </label>
            </section>
            <section class='bloc_form_input'>
            <section class ='info_radio'>
                        <label>
                            <input type="radio" name="paye" value='Mali'>
                            Mali
                        </label>
                        <label>
                            <input type="radio" name="paye" value='Bourkina'>
                            Bourkina
                        </label>
                        <label>
                            <input type="radio" name="paye" value='Niger'>
                            Niger
                        </label>
                    </section>
            </section>
        
            <input class="boutton_inpute" class="submit" type="submit" value="Crée boutique" name="boutique">

            <?php if (isset($erreur)) { ?> <h2 class="erreur"><?php echo $erreur ?></h1> <?php } ?>
        </form>
    </section>
    </section>
