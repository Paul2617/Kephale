<?php

class Articles 
{
    private $_id;
    private $_id_boutique;
    private $_id_produit;
    private $_id_groupe_article;
    private $_id_promo;
    private $_nom;
    private $_descriptions;
    private $_prix;
    private $_taille;
    private $_date_livraison;
    private $_img;

    public function  __construc(array $data){
        $this->hydrate($data);
    }
}
    ?>