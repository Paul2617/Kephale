<?php
namespace Middleware;


class ConvertionSolde 
{
   public static function newSolde ( $montant_user ) {
    $nonbre = strlen($montant_user);
        $_01_caractaure = 1;
        $_02_caractaure = 2;
        $_03_caractaure = 3;
        $_04_caractaure = 4;
        $_05_caractaure = 5;
        $_06_caractaure = 6;
        $_07_caractaure = 7;
        $_08_caractaure = 8;
        $_09_caractaure = 9;
        $_prefix_fcfa = '.00';
        
        $prefix = ' FCFA';

        if ($nonbre === $_01_caractaure) {
            $resule_finale = $montant_user . $_prefix_fcfa  ;
            return $resule_finale;
        } elseif ($nonbre === $_02_caractaure) {
            $resule_finale = $montant_user;
            return $resule_finale;
        } elseif ($nonbre === $_03_caractaure) {
            $resule_finale = $montant_user ;
            return $resule_finale;
        } elseif ($nonbre === $_04_caractaure) {
            $carataire = (string)$montant_user;
            $unPremierChifre = substr($carataire, 0, 1);
            $deuxDernierChiffre = substr($carataire, 1);
            $resule_p = $unPremierChifre . ' ' . $deuxDernierChiffre;
            $resule_finale = $resule_p  ;
            return $resule_finale;
        } elseif ($nonbre === $_05_caractaure) {
            $carataire = (string)$montant_user;
            $unPremierChifre = substr($carataire, 0, 2);
            $deuxDernierChiffre = substr($carataire, 2);
            $resule_p = $unPremierChifre . ' ' . $deuxDernierChiffre;
            $resule_finale = $resule_p ;
            return $resule_finale;
        } elseif ($nonbre === $_06_caractaure) {
            $carataire = (string)$montant_user;
            $unPremierChifre = substr($carataire, 0, 3);
            $deuxDernierChiffre = substr($carataire, 3);
            $resule_p = $unPremierChifre . ' ' . $deuxDernierChiffre;
            $resule_finale = $resule_p  ;
            return $resule_finale;
        } elseif ($nonbre === $_07_caractaure) {
            $carataire = (string)$montant_user;
            $unPremierChifre = substr($carataire, 0, 1);
            $TroideuxiemeDernierChiffre = substr($carataire, 1, 3);
            $TroiTroisiemeDernierChiffre = substr($carataire, 4, 4);
            $resule_p = $unPremierChifre . ' ' . $TroideuxiemeDernierChiffre . ' ' . $TroiTroisiemeDernierChiffre;
            $resule_finale = $resule_p ;
            return $resule_finale;
        }elseif($nonbre === $_08_caractaure){
            $carataire = (string)$montant_user;
            $unPremierChifre = substr($carataire, 0, 2);
            $TroideuxiemeDernierChiffre = substr($carataire, 2, 3);
            $TroiTroisiemeDernierChiffre = substr($carataire, 5, 5);
            $resule_p = $unPremierChifre . ' ' . $TroideuxiemeDernierChiffre . ' ' . $TroiTroisiemeDernierChiffre;
            $resule_finale = $resule_p   ;
            return $resule_finale;
            
        }elseif($nonbre === $_09_caractaure){
            $carataire = (string)$montant_user;
            $unPremierChifre = substr($carataire, 0, 3);
            $TroideuxiemeDernierChiffre = substr($carataire, 2, 3);
            $TroiTroisiemeDernierChiffre = substr($carataire, 6, 6);
            $resule_p = $unPremierChifre . ' ' . $TroideuxiemeDernierChiffre . ' ' . $TroiTroisiemeDernierChiffre;
            $resule_finale = $resule_p  ;
            return $resule_finale;
        }
    
}
} 