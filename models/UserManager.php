<?php
require_once ('../models/Model.php');

$info_user = recTable ( $bd, 'utilisateur', '2');


while ($result = $info_user->fetch(PDO::FETCH_ASSOC)){

}
var_dump ($info_user);

    ?>