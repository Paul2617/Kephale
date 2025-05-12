<div class='nav_bare'>
    <section class="bloc_nave">
    <a class ='lin_connect'href= "/Kephale/boutiqueparametre" >
        <img class='retoure' src="public/asset/_icone/retoure.svg" alt="">
        </a>
    <h5>Modifications</h5>
    </section>

</div>
<div style="padding-top: 80px;" ></div>

<section class='block_info_boutique flex'>

<form class='ffdofjfjjd' method="POST" enctype="multipart/form-data">

<section class='blocfildd'>
                    <input type="file" id="file" name="img_demande">
                    <label for="file">
                        <img src="public/asset/img_boutique/<?= $info_boutique ["img_boutique"] ?>" alt="">
                        <h4>Mofidie image</h4>
                    </label>
                </section> 
    <h5 class='h5d'>Nom de la Boutique</h5>
        <input class='ddfkdmjfkff'  type="text" name="new_nom_boutque" value="<?= $info_boutique ["nom_boutique"] ?>">
        
        <input class='ddjfkff' type="submit" value="Modifié" name="modifie"> 
        <?php if (isset($erreur)) { ?> <h2 class="erreur"><?php echo $erreur ?></h1> <?php } ?>
    </form>
</section>
<?php  
