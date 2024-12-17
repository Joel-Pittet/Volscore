<?php
switch ($_SESSION["languagePreference"]){
    case 'de':
        include("language/de/errorDE.php");
        break;
    case 'it':
        include("language/it/errorIT.php");
        break;
    default:
        include("language/fr/errorFR.php");
        break;   
}

$title = $pageTitle;
ob_start();
?>
<div class="w-100 text-center">
    <img src="/images/error.png" style="width:50px"><br>
    <?= isset($message) ? "<p class='alert alert-primary'>$error[$message]</p>" : "" ?>
    <a href="<?= isset($redirectUrl) ? $redirectUrl : '/' ?>"><?= isset($redirectMsg) ? $redirectMsg : $retour ?></a>
</div>
<?php
$content = ob_get_clean();
require_once 'gabarit.php';
?>
