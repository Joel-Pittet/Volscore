<?php
switch ($_SESSION["languagePreference"]){
    case 'de':
        include("language/de/gameOverDE.php");
        break;
    case 'it':
        include("language/it/gameOverIT.php");
        break;
    default:
        include("language/fr/gameOverFR.php");
        break;   
}

$title = $pageTitle;
ob_start();
?>

<h1><?= $finMatch . " " . $set->number ?></h1>
<table>
    <tr><td class="teamname"><?= $game->receivingTeamName ?></td><td class="teamname"><?= $game->visitingTeamName ?></td></tr>
    <tr><td class="score"><?= $game->scoreReceiving ?></td><td class="score"><?= $game->scoreVisiting ?></td></tr>
    <tr><td colspan=2><a href="/" class="btn btn-primary btn-sm"><?= $continuer ?></a></td></tr>
</table>

<?php
foreach ($teams as $team)
{
    echo "<li>".$team->name."</li>";
}
?>
</ul>

<?php
$content = ob_get_clean();
require_once 'gabarit.php';
?>
