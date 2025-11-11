<?php
class html 
{
public function __construct ($title = null, $description = null, $image = null, $url = null, $type = null){
    $BASE_URL = '/public/';
    $timestamp = date('Ymd');
    $timestamp_ = time();
              if(isset($title) AND isset($description) AND isset($image) AND isset($url ) AND isset($type )){
                echo <<<HTML
<head>
    <meta charset="UTF-8">
    <title>$title</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="x-icon" href="/assets/logo.png">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

<!-- Activer le mode Web App -->
<meta name="apple-mobile-web-app-capable" content="yes">

<!-- Couleur de la barre de statut -->
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">

<!-- Icône de l’app sur l’écran d’accueil -->
<link rel="apple-touch-icon" href="/assets/logo.png">


<!-- Page de démarrage -->
<link rel="apple-touch-startup-image" href="/assets/logo.png">

    
    <!-- Open Graph pour WhatsApp, Facebook, LinkedIn -->
    <meta property='og:title' content='$title'>
     <meta property='og:description' content='$description'>
     <meta property='og:image' content='$image'>
     <meta property='og:url' content='$url'>
     <meta property='og:type' content='$type'>
    <!-- Recommandé -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Nom de l'app (utilisé sur Android) -->
    <meta name="application-name" content="Kephalé">

    <!-- iOS spécifique : plein écran -->
    <meta name="apple-mobile-web-app-title" content="Kephalé">

    <!-- Windows spécifique -->
    <meta name="msapplication-TileColor" content="#ffffffff">

    <!-- SEO (facultatif mais utile) -->
    <meta name="description" content="Application Kephalé">
    <meta name="author" content="Paul Koné">
    <meta name="keywords" content="Application web, mobile">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/public/style.css?v=$timestamp_">
    <link rel="manifest" href=" /public/manifest.json">
    <script src=" /public/js/axios.min.js" defer></script>

</head>
HTML;
              }else{
                      echo <<<HTML
<head>
    <meta charset="UTF-8">
    <title>Kephalé</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="x-icon" href="/assets/logo.png">
   <!-- Recommandé -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <!-- Activer le mode Web App -->
<meta name="apple-mobile-web-app-capable" content="yes">

<!-- Couleur de la barre de statut -->
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">

<!-- Icône de l’app sur l’écran d’accueil -->
<link rel="apple-touch-icon" href="/assets/logo.png">


<!-- Page de démarrage -->
<link rel="apple-touch-startup-image" href="/assets/logo.png">

    <!-- Open Graph pour WhatsApp, Facebook, LinkedIn -->
    <meta property="og:title" content="Kephalé" data-rh="true">
    <meta property="og:description" content="Découvrez Kephalé dans tout sa dimentions." data-rh="true">
    <meta property="og:image" content="https://kephale.infinityfreeapp.com/assets/logo_kephale.png" data-rh="true">
    <meta property="og:url" content="https://kephale.infinityfreeapp.com/home" data-rh="true">
    <meta property="og:type" content="article">
 

    <!-- Couleur de la barre de statut -->
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">

    <!-- Nom de l'app (utilisé sur Android) -->
    <meta name="application-name" content="Kephalé">

    <!-- iOS spécifique : plein écran -->
    <meta name="apple-mobile-web-app-title" content="Kephalé">
    
    <!-- Windows spécifique -->
    <meta name="msapplication-TileColor" content="#ffffffff">

    <!-- SEO (facultatif mais utile) -->
    <meta name="description" content="Application Kephalé" >
    <meta name="author" content="Paul Koné">
    <meta name="keywords" content="Application web, mobile">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href=" /public/style.css?v=$timestamp_">
    <link rel="manifest" href="/public/manifest.json" >
    <script src=" /public/js/axios.min.js" defer></script>

</head>
HTML;
              }
}
}



?>