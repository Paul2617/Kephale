<?php
 $cookie = (new cookie());
$nom_cookie = COOKIE_NAME;
$cookie->deleteSecureCookie($nom_cookie);
$_SESSION = array();
session_destroy();
header ('Location: /Kephale/connection'  );