<div class='bloc'>
<section class='retour'>
    <a class='link_retour' href="/Kephale/user"> <img class='img_icon' src="public/asset/_icone/retoure.svg" alt=""></a>
</section>
<div class='bloc_form'>

<?php
if($etatDemande === true){
    ?> 
        <section class='bloc_form_p' >
            
        <p>Votre demande est en cours de validation, le service client vous contactera dans les 24h <br> <span class='poppins-extrabold' >Merci pour votre confiance.</span></p>
    </section>
    </section>

</div> 
</div>   
    <?php
}else{
    ?> 
        <section class='bloc_form_p' >
            <style>
                .alte{
                    color : #95C11F;
                    font-size: 14px;
                }
            </style>
            <h6 class='alte' > <?php if(isset($alt)){echo $alt;}?></h6>
        <h1> Boujour  <?= $infoUser["nom"] ?> </h1>
        <p>Pour la création d'une boutique, il est important pour nous de vous garantir et vous expliquer les conditions d'utilisation. On vous contactera pour la signature d’un contrat.</p>
        <form method="POST" enctype="multipart/form-data">
            <section class='bloc_form_input'>
            <input  type="number" placeholder="Numéro" name="telephone" value="<?= $infoUser["tel"] ?>">
            </section>
            <section class ='blocfil'>
            <input type="file" id="file" name="img_demande">
            <label for="file">
            <img src="public/asset/_icone/appareil.svg" alt="">
            <h4>Ajouter</h4>

            </label>
            </section>
            <p>Veuillez ajouter une photo de votre pièce d'identité nationale valide.</p>

            <input class="boutton_inpute" class="submit" type="submit" value="Envoyer la demande" name="demande">

            <?php if (isset($erreur)) { ?> <h2 class="erreur"><?php echo $erreur ?></h1> <?php } ?>
        </form>
    </section>
    </section>

</div> 
</div>   
    <?php
}
?> 
