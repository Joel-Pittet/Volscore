<?php

switch ($_SESSION["languagePreference"]){
    case 'de':
        include("language/de/prepareSetDE.php");
        break;
    case 'it':
        include("language/it/prepareSetIT.php");
        break;
    default:
        include("language/fr/prepareSetFR.php");
        break;   
}

$title = $pageTitle . " " . $game->number;

ob_start();
?>
<script>
    // Fonction pour mettre à jour les options disponibles pour chaque sélection
    function updateAvailablePlayers() {
        // Récupérer toutes les sélections de joueurs (6 positions pour chaque équipe)
        let posElements = document.querySelectorAll('[id^="pos"]');

        // Créer un tableau pour suivre les joueurs déjà sélectionnés
        let selectedPlayers = [];

        // Récupérer les joueurs déjà sélectionnés et les ajouter au tableau
        posElements.forEach(function(selectElement) {
            let selectedPlayer = selectElement.value;
            if (selectedPlayer) {
                selectedPlayers.push(selectedPlayer);
            }
        });

        // Mettre à jour les options dans chaque sélecteur de poste
        posElements.forEach(function(selectElement) {
            // Réinitialiser les options
            let options = selectElement.querySelectorAll('option');
            options.forEach(function(option) {
                if (selectedPlayers.includes(option.value) && option.value != '') {
                    option.disabled = true;  // Désactiver les options déjà sélectionnées
                } else {
                    option.disabled = false; // Réactiver les options non sélectionnées
                }
            });
        });
    }

    // Appeler la fonction lors de chaque changement de sélection
    document.addEventListener('DOMContentLoaded', function() {
        let posElements = document.querySelectorAll('[id^="pos"]');
        
        posElements.forEach(function(selectElement) {
            selectElement.addEventListener('change', updateAvailablePlayers);
        });

        // Initialiser les sélecteurs à leur état actuel
        updateAvailablePlayers();
    });
</script>

<h2><?= $preparation . " " . $set->number . " " . $match . " " .$game->number ?>, <?= $game->receivingTeamName ?> - <?= $game->visitingTeamName ?></h2>
<table>
    <tr><th class="teamPrep"><?= $position . " " . $game->receivingTeamName ?></th><th class="teamPrep"><?=  $position . " " . $game->visitingTeamName ?></th></tr>
    <tr>
        <td class="teamPrep">
            <?php if ($receivingPositionsLocked) : ?>
                <table>
                    <?php foreach ($receivingPositions as $player) : ?>
                        <tr><td><?= $player->playerInfo['number'] ?></td><td><?= $player->last_name ?></td></tr>
                    <?php endforeach; ?>
                </table>
            <?php else : ?>
                <form method="post" action="?action=setPositions">
                    <input type="hidden" name="gameid" value=<?= $game->number ?> />
                    <input type="hidden" name="setid" value=<?= $set->id ?> />
                    <input type="hidden" name="teamid" value=<?= $game->receivingTeamId ?> />
                    <?php for ($pos = 1; $pos <= 6; $pos++) : ?>
                        <div class="form-group">
                            <label for="pos<?= $pos ?>" class="col-2"><?= romanNumber($pos) ?></label>
                            <select name="position<?= $pos ?>"  id="pos<?= $pos ?> class="form-control form-control-lg">
                                <option value=0></option>
                                <?php foreach ($receivingRoster as $player) : ?>
                                    <option value=<?= $player->playerInfo['playerid'] ?> <?= $player->playerInfo['playerid'] == $receivingPositions[$pos-1]->playerInfo['playerid'] ? "selected" : "" ?>><?= $player->playerInfo['number'] ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= $player->last_name ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <br>
                    <?php endfor; ?>
                    <input type="submit" class="btn btn-primary btn-sm" value="<?=$enregistrer?>"/>
                   
                </form>
            <?php endif; ?>
        </td>
        <td class="teamPrep">
            <?php if ($visitingPositionsLocked) : ?>
                <table>
                    <?php foreach ($visitingPositions as $player) : ?>
                        <tr><td><?= $player->playerInfo['number'] ?></td><td><?= $player->last_name ?></td></tr>
                    <?php endforeach; ?>
                </table>
            <?php else : ?>
                <form method="post" action="?action=setPositions">
                    <input type="hidden" name="gameid" value=<?= $game->number ?> />
                    <input type="hidden" name="setid" value=<?= $set->id ?> />
                    <input type="hidden" name="teamid" value=<?= $game->visitingTeamId ?> />
                    <?php for ($pos = 1; $pos <= 6; $pos++) : ?>
                        <div class="form-group">
                            <label for="pos<?= $pos ?>"><?= $pos ?> : </label>
                            <select name="position<?= $pos ?>"  id="pos<?= $pos ?> class="form-control">
                                <option value=0></option>
                                <?php foreach ($visitingRoster as $player) : ?>
                                    <option value=<?= $player->playerInfo['playerid'] ?> <?= $player->playerInfo['playerid'] == $visitingPositions[$pos-1]->playerInfo['playerid'] ? "selected" : "" ?>><?= $player->playerInfo['number'] ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= $player->last_name ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <br>
                    <?php endfor; ?>
                    <input type="submit" class="btn btn-primary btn-sm" value="<?=$enregistrer?>"/>
                    
                </form>
            <?php endif; ?>
        </td>
    </tr>
</table>
<?php if ($receivingPositionsLocked && $visitingPositionsLocked) : ?>
    <a href="?action=keepScore&setid=<?= $set->id ?>" class="btn btn-primary"><?=$demarrer?></a>
<?php endif; ?>
<?php
$content = ob_get_clean();
require_once 'gabarit.php';
?>
<? 
