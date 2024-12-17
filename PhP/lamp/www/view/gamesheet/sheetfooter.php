<div id="sheetfooter">
    <div class="d-flex flex-column" style="width:25%">
        <div id="penalties"><div class="sectiontitle"><?=$sanctions?></div><?php require_once 'view/gamesheet/sanctions.php' ?></div>
        <div id="remarks"><div class="sectiontitle"><?=$remarques?></div></div>
    </div>
    <div class="d-flex flex-column align-items-center" style="width:25%">
        <div id="approvals"><div class="sectiontitle"><?=$approbations?></div></div>
        <div id="summary">
            <div class="sectiontitle"><?=$totaux?></div>
            <div  class="d-flex flex-column align-items-center">
                <?php foreach (VolscoreDB::getSets($game) as $set) : ?>
                    <p><?= $set->scoreReceiving ?> - <?= $set->scoreVisiting ?></p>
                <?php endforeach; ?>
                <?php if ($game->scoreReceiving > $game->scoreVisiting) : ?>
                    <p><?= $game->receivingTeamName . " " . $gagnePar. " " . $game->scoreReceiving . " " . $à . " " . $game->scoreVisiting ?></p>
                <?php else : ?>
                    <p><?= $game->visitingTeamName . " " . $gagnePar. " " . $game->scoreVisiting . " " . $à . " " . $game->scoreReceiving ?></p>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div id="teams">
        <div class="sectiontitle"><?=$equipes?></div>
        <div class="d-flex flex-row">
            <div class="w-50">
                <div class="sectiontitle"><?= $game->receivingTeamName ?></div>
                <table>
                    <?php foreach ($receivingRoster as $player) : ?>
                        <tr><td><?= $player->last_name ?></td><td><?= $player->license ?></td><td><?= $player->number ?></td></tr>
                    <?php endforeach; ?>
                </table>
            </div>
            <div class="w-50">
                <div class="sectiontitle"><?= $game->visitingTeamName ?></div>
                <table>
                    <?php foreach ($visitingRoster as $player) : ?>
                        <tr><td><?= $player->last_name ?></td><td><?= $player->license ?></td><td><?= $player->number ?></td></tr>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
    </div>
</div>