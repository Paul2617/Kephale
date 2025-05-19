<?php  
if(isset($_GET['id_categorie']))
$id_categorie = htmlspecialchars($_GET['id_categorie']);
if(isset($_GET['id_produit']))
 $id_produit = htmlspecialchars($_GET['id_produit']);
if(isset($_GET['page'])){
    if($page === 'categorie'){
        $retoure = '/Kephale/boutique';
    }elseif($page === 'produit'){
          $retoure = '/Kephale/produit&id_categorie='.$id_categorie;
    }elseif($page === 'article'){
           $retoure = '/Kephale/article&id_categorie='.$id_categorie.'&id_produit='.$id_produit;
    }
}
?>
<div class='nav_bare'>
    <section class="bloc_nave">
        <a class='lin_connect' href="<?=  $retoure ?>"><img class='retoure'
                src='public/asset/_icone/retoure.svg'></a>
        <a class='lin_connect' href="/Kephale/user">
            <img class="<?= $lala ;?>" src="<?= $icon ;?>" alt="">
        </a>
    </section>
</div>
<div style="padding-top: 80px;"></div>

<?php  
if(isset($_GET['page'])){
    $page = htmlspecialchars ($_GET['page']);
    if($page === 'categorie'){
        require_once ('../views/modif_supp/categorie.php');
    }elseif($page === 'produit'){
      require_once ('../views/modif_supp/produit.php');
    }elseif($page === 'article'){
          require_once ('../views/modif_supp/article.php');
    }
}
?>