<?php


switch ($_SESSION["languagePreference"]){
    case 'de':
        include("language/de/selectBookingDE.php");
        break;
    case 'it':
        include("language/it/selectBookingIT.php");
        break;
    default:
        include("language/fr/selectBookingFR.php");
        break;   
}

$title = $pageTitle;

ob_start();
?>

<div class="d-flex flex-column align-items-center">
    <div class="d-flex flex-column align-items-center m-5 w-50">
        <h2><?= $section . " " . $team->name ?></h2>
        <form method="post" action="?action=registerBooking">
            <input type="hidden" name="teamid" value="<?= $team->id ?>" />
            <input type="hidden" name="setid" value="<?= $set->id ?>" />
            <div class="form-group row">
                <label for="dpdPlayer"><?= $joueur ?></label>
                <select name="dpdPlayer"  id="dpdPlayer" class="form-control form-control-lg">
                    <option value=0></option>
                    <?php foreach ($roster as $player) : ?>
                        <option value=<?= $player->playerInfo['playerid'] ?>><?= $player->playerInfo['number'] ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= $player->last_name ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button class="col-6 btn m-5 btn-warning" type="submit" name="severity" value=0><?=$cartonJaune?></button>
            <button class="col-6 btn m-5 btn-warning" type="submit" name="severity" value=1><?=$cartonRouge?></button>
            <button class="col-6 btn m-5 btn-warning" type="submit" name="severity" value=2><?=$cartonRougeJauneEns?></button>
            <button class="col-6 btn m-5 btn-warning" type="submit" name="severity" value=3><?=$cartonRougeJauneSep?></button>
        </form>
    </div>
</div>

<?php
$content = ob_get_clean();
require_once 'gabarit.php';
?>

