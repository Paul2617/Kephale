<?php  
    if(isset($_POST["supprimer_produit"])){

        $id_produit = htmlspecialchars($_GET['id_produit']);
        $id_categorie = htmlspecialchars($_GET['id_categorie']);
        $stmte = $bd->prepare("SELECT * FROM article WHERE id_produit = ? ");
        $stmte->execute([ $id_produit]);

     
        if ($stmte->rowCount() > 0){
            $infos = $stmte->fetchAll(PDO::FETCH_ASSOC) ;

                 foreach ($infos as $infos_plus){
                    $id_article = $infos_plus['id'];
                       $stmt = $bd->prepare("SELECT * FROM liste_achat WHERE id_article = ? ");
                       $stmt->execute([ $id_article]);
                        if ($stmt->rowCount() > 0){
                            // si article a deja ete achete on concerve l'aricle
                            $stmtes = $bd->query("SELECT  COUNT(*) FROM images_article WHERE article_id = '$id_article'");
                            $total = $stmtes->fetchColumn();
                            // quan l'image de l'aricle est superieur a 1
                            if ($total > 1) 
                            {
                                  $limite = $total - 1;
                                  // elle consite a recuper tout l'image d'un article en gardant juste une image de l'article
                    $stmtArticles = $bd->prepare("SELECT id , nom_image as img FROM images_article WHERE article_id = '$id_article'  ORDER BY nom_image DESC LIMIT :limite");
                    $stmtArticles->bindValue(':limite', $limite, PDO::PARAM_INT);
                    $stmtArticles->execute();
                    while ($img_sup = $stmtArticles->fetch(PDO::FETCH_ASSOC)){
                        $id_image = $img_sup ['id'];
                        $nom_image = $img_sup['img'];
                        $img_direction = '../public/asset/img_article/';
                        $img_suprime = $img_direction . $nom_image;
                        if (file_exists($img_suprime)){
                            unlink($img_suprime);
                            // supprimer_article_temp cette fonction consite a concerve l'article
                            supprimer_article_temp($bd, $id_article, $id_image );
                        }else{
                            supprimer_article_temp($bd, $id_article, $id_image );
                        }

                    }
                            }elseif($total === 1 ){
                                // 'article a juste une image on concerve l'article avec une image
                    supprimer_articles ($bd, $id_article );
                        }
                

                        }else{
                            // quan article na pas ete achete on suprime tous l'article 
                            $stmtArticles = $bd->prepare("SELECT id , nom_image as img FROM images_article WHERE article_id = ? ");
                            $stmtArticles->execute([ $id_article]);
                            while ($img_sup = $stmtArticles->fetch(PDO::FETCH_ASSOC)){
                                  $id_image = $img_sup ['id'];
                                  $nom_image = $img_sup['img'];
                                  $img_direction = '../public/asset/img_article/';
                                  $img_suprime = $img_direction . $nom_image;
                        if (file_exists($img_suprime)){
                            unlink($img_suprime);
                            supprimer_article($bd, $id_article, $id_image );
                        }else{
                            supprimer_article($bd, $id_article, $id_image );
                        }
                            }
                        }
                 }

        }
        
        $stmt = $bd->prepare("SELECT img FROM produit WHERE id = ? ");
     $stmt->execute([ $id_produit ]);

        if ($stmt->rowCount() > 0){
            while ($img = $stmt->fetch(PDO::FETCH_ASSOC)){
                $imgs =  $img['img'];
                $img_direction = '../public/asset/img_produit/';
                $img_suprime = $img_direction . $imgs;
                if (file_exists($img_suprime)){
                    unlink($img_suprime);
                    supprimer_produit($bd,$id_produit);
                }else{
                    supprimer_produit($bd,$id_produit );
                }
            }
    
        }
    }
?>