<div id='gameteams'><div class="sectiontitle"><?=$equipes?></div><div class="text-center"><?= $game->receivingTeamName ?> - <?= $game->visitingTeamName ?></div></div>
<div id='gamelocation'><div class="sectiontitle"><?=$lieu?></div><div class="text-center"><?= $game->place ?></div></div>
<div id='gamevenue'><div class="sectiontitle"><?=$salle?></div><div class="text-center"><?= $game->venue ?></div></div>
<div id='gamedate'><div class="sectiontitle"><?=$date?></div><div class="text-center"><?= date_format(date_create($game->moment),'d M Y') ?></div></div>
<div id='gametime'><div class="sectiontitle"><?=$heure?></div><div class="text-center"><?= date_format(date_create($game->moment),'H:i') ?></div></div>
