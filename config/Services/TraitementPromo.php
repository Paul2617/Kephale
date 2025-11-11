<?php
namespace Services;


class TraitementPromo 
{
    public static function newPromo ($article_promo, $article_prix){
        if($article_promo === 0){
        return false;
        }else{
            $i = $article_prix / 100 * $article_promo;
            $u = $article_prix - $i;
            return $u;
        }
    } 
}