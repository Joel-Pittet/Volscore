<?php

use Symfony\Component\VarDumper\VarDumper;

$title = 'Equipes';

ob_start();
?>

<h1><?php echo $team->name?></h1>
<ul>

<?php

foreach ($players as $player)
{
    echo "<li>".$player->first_name." ".$player->last_name."</li>";
}
?>
</ul>

<?php
$content = ob_get_clean();
require_once 'gabarit.php';
?>
