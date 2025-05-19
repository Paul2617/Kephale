<?php  
    if(isset($_POST["supprimer_categorie"])){
        $id_categorie = $_GET['id_categorie'];
        $stmt = $bd->prepare("SELECT img FROM produit WHERE id_categorie = ? ");
        $stmt->execute([ $id_categorie ]);
        if ($stmt->rowCount() > 0){
            while ($img = $stmt->fetch(PDO::FETCH_ASSOC)){
                $imgs =  $img['img'];
                $img_direction = '../public/asset/img_produit/';
                $img_suprime = $img_direction . $imgs;
                if (file_exists($img_suprime)){
                    unlink($img_suprime);
                    supprimer_produit($bd);
                }else{
                    supprimer_produit($bd);
                }
            }
    
        }

        $id_categorie = $_GET['id_categorie'];
        $stmte = $bd->prepare("SELECT * FROM article WHERE id_categorie = ? ");
        $stmte->execute([ $id_categorie ]);
        if ($stmte->rowCount() > 0){
            $infos = $stmte->fetchAll(PDO::FETCH_ASSOC) ;
              foreach ($infos as $info)
          foreach ($infos as $info){
                $id_article = $info['id']; 

                       $stmt = $bd->prepare("SELECT * FROM liste_achat WHERE id_article = ? ");
                       $stmt->execute([ $id_article]);
                       // si article a deja ete achete on concerve l'aricle
                       if ($stmt->rowCount() > 0){
                         // quan l'image de l'aricle est superieur a 1
                $stmtes = $bd->query("SELECT  COUNT(*) FROM images_article WHERE article_id = '$id_article'");
                $total = $stmtes->fetchColumn();
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
                            supprimer_article($bd, $id_article, $id_image);
                        }else{
                            supprimer_article($bd, $id_article, $id_image);
                        }
                            }
                       }

                
                
            }

        }

        
        $categorie = $bd->prepare("SELECT img FROM categorie WHERE id = ? ");
        $categorie->execute([ $id_categorie ]);

        if ($categorie->rowCount() > 0){
           $img =  $categorie->fetch(PDO::FETCH_ASSOC);
           $img_categorie = $img['img'];
           $img_direction = '../public/asset/img_categori/';
                $img_suprime = $img_direction . $img_categorie;
                if (file_exists($img_suprime)){
                    unlink($img_suprime);
                    supprimer_categori($bd);
                }else{
                    supprimer_categori($bd);
                }
           
        }
       
    }
?>