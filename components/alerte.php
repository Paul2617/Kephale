<?php 
function Alerte ($titre, $contenue, $nameBoutton, $valueBoutton, $nameInfoId, $valueInfoId ){
    ?>
    <section class='blocleArte'>
    <section class='bloKleArteb'>
        <section class='blocanule'>
            <form action="" method="POST" enctype="multipart/form-data">
                <button class='dpdiido dddufduud ' name="ferme" value="Connexion">
                    <h1 class='dpdiido'>x</h1>
                </button>
            </form>
        </section>
        <section class='blockinfoAlte'>
            <h4><?= $titre?></h4>
            <p><?= $contenue?></p>
        </section>
        <form method="POST" enctype="multipart/form-data">
        <input type="hidden" name="<?= $nameInfoId?>" value="<?= $valueInfoId?>">
            <input class="boutton_inpute" class="submit" type="submit" value="<?= $valueBoutton?>" name="<?= $nameBoutton?>">
            
        </form>
    </section>
</section>
    <?php 
}

function AlertePlus ($titre, $contenue, $nameBoutton, $valueBoutton, $nameInfoId, $valueInfoId ){
    ?>
    <section class='blocleArte'>
    <section class='bloKleArteb'>
        <section class='blocanule'>
            <form action="" method="POST" enctype="multipart/form-data">
                <button class='dpdiido dddufduud ' name="ferme" value="Connexion">
                    <h1 class='dpdiido'>x</h1>
                </button>
            </form>
        </section>
        <section class='blockinfoAlte'>
            <h4><?= $titre?></h4>
            <p><?= $contenue?></p>
        </section>
        <form class='ddkffjdkfjf' method="POST" enctype="multipart/form-data">
        <input type="hidden" name="<?= $nameInfoId?>" value="<?= $valueInfoId?>">
        <input type="hidden" name="id_boutique" value="<?= $_POST["id_boutique"]?>">
        <input type="hidden" name="annulerLachatMotif" value="annulerLachatMotif">
        <textarea class="jdhjgfd" name="raisons" placeholder="Quelles sont les raisons ?" rows="5"><?php if (isset($raisons)) {echo $raisons;} ?></textarea>
            <input class="boutton_inpute" class="submit" type="submit" value="<?= $valueBoutton?>" name="<?= $nameBoutton?>">
            <?php if (isset($erreur)) { ?> <h2 class="erreur"><?=$erreur ?></h1> <?php } ?>
        </form>
    </section>
</section>
    <?php 
}

?>