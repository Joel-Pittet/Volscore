<?php
switch ($_SESSION["languagePreference"]){
    case 'de':
        include("language/de/gamesDE.php");
        break;
    case 'it':
        include("language/it/gamesIT.php");
        break;
    default:
        include("language/fr/gamesFR.php");
        break;   
}

$title = $pageTitle;
ob_start();
?>

<h1><?php echo $matchs ?></h1>
<table class="table table-bordered">
    <thead>
        <tr><th><?=$date?></th><th><?=$typeMatch?></th><th><?=$ligue?></th><th><?=$recevante?></th><th><?=$visiteur?></th><th><?=$score?></th><th><?=$action?></th></tr>
    </thead>
    <tbody>
    <?php
    foreach ($games as $game)
    {
        echo "<tr><td>".$game->moment."</td><td>".$game->type."</td><td>".$game->league."</td><td>".$game->receivingTeamName."</td><td>".$game->visitingTeamName."</td><td>".(($game->scoreReceiving+$game->scoreVisiting) > 0 ? $game->scoreReceiving."-".$game->scoreVisiting : "")."</td><td>";
        if ($game->isMarkable()) {
            echo "<a href='?action=mark&id=".$game->number."' class='btn btn-sm btn-primary m-1'>". $marquer ."</a>";
        }
        if ($game->isEditable()) {
            echo "<a href='?action=edit&id=".$game->number."' class='btn btn-sm btn-primary m-1'>". $modifier ."</a>";
        }
        if (VolscoreDB::gameIsOver($game)) {
            echo "<a href='?action=sheet&gameid=".$game->number."' class='btn btn-sm btn-primary m-1'>". $consulter ."</a>";
        } elseif (count(VolscoreDB::getSets($game)) > 0) {
            echo "<a href='?action=resumeScoring&gameid=".$game->number."' class='btn btn-sm btn-primary m-1'>". $continuer ."</a>";
        }
        echo "</td></tr>";
    }
    ?>
    </tbody>
</table>

<?php
$content = ob_get_clean();
require_once 'gabarit.php';
?>

