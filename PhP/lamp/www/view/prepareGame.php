<?php

switch ($_SESSION["languagePreference"]){
    case 'de':
        include("language/de/prepareGameDE.php");
        break;
    case 'it':
        include("language/it/prepareGameIT.php");
        break;
    default:
        include("language/fr/prepareGameFR.php");
        break;   
}



$title = $pageTitle . " " . $game->number;

ob_start();
?>

<div class="d-flex flex-column align-items-center m-5">
    <h1><?= $preparation . " " . $game->number ?></h1>
    <h3><?= $verification ?></h3>
    <table>
        <tr><th><?= $game->receivingTeamName ?></th><th><?= $game->visitingTeamName ?></th></tr>
        <tr>
            <td>
                <table>
                    <?php foreach ($receivingRoster as $player) : ?>
                        <tr><td><?= $player->last_name ?></td><td><?= $player->license ?></td><td><?= $player->number ?></td></tr>
                    <?php endforeach; ?>
                </table>
                <?php if (rosterIsValid($receivingRoster)) : ?>
                    <div><span class="checkmark"></span><?=$presence?></div>
                <?php else : ?>
                    <form method="post" action="?action=validate&game=<?= $game->number ?>&team=<?= $game->receivingTeamId ?>">
                        <input type="submit" class="btn btn-primary btn-sm" value="Valider">
                    </form>
                <?php endif; ?>
            </td>
            <td>
                <table>
                    <?php foreach ($visitingRoster as $player) : ?>
                        <tr><td><?= $player->last_name ?></td><td><?= $player->license ?></td><td><?= $player->number ?></td></tr>
                    <?php endforeach; ?>
                </table>
                <?php if (rosterIsValid($visitingRoster)) : ?>
                    <div><span class="checkmark"></span><?=$presence?></div>
                <?php else : ?>
                    <form method="post" action="?action=validate&game=<?= $game->number ?>&team=<?= $game->visitingTeamId ?>">
                        <input type="submit" class="btn btn-primary btn-sm" value="<?= $valider ?>">
                    </form>
                <?php endif; ?>
            </td>
        </tr>
    </table>
</div>
<div class="d-flex flex-column align-items-center m-5">
    <h3><?= $tirage ?></h3>
    <form method="post" action="?action=registerToss">
        <input type="hidden" name="gameid" value=<?= $game->number ?> />
        <button type="submit" class="btn btn-success btn-sm m-3" name="cmdTossWinner" value="1"><?= $game->receivingTeamName ?></button>
        <button type="submit" class="btn btn-success btn-sm m-3" name="cmdTossWinner" value="2"><?= $game->visitingTeamName ?></button>
    </form>
</div>
<?php
$content = ob_get_clean();
require_once 'gabarit.php';
?>

