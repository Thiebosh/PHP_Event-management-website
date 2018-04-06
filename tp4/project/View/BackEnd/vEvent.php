<?php 
$pageName = 'Détails';

$legendContent = 'Détails de l\'événement';


ob_start(); ?>
    <li>
        <a href="index.php?action=reception"><button>Accueil</button></a>
    </li>
<?php $menuContent = ob_get_clean();


$asideContent = '';


ob_start(); ?>
    <h3><?= htmlspecialchars($dataEvent['name']) ?></h3>
    Organisateur : <?= htmlspecialchars($dataEvent['login']) ?><br>
    Durée : <?= htmlspecialchars($dureeEvent) ?><br>
    De <?= htmlspecialchars($dateStart) ?> à <?= htmlspecialchars($dateEnd) ?><br>
    Nombre de places : <?= htmlspecialchars($dataEvent['nb_place']) ?><br>
    Description :
    <p><?= htmlspecialchars($dataEvent['description']) ?></p>
    <br>
    <a href="index.php?action=edit&amp;id=<?= htmlspecialchars($id) ?>">
        <button>Modifier l'événement</button>
    </a>
    <form method="post" action="index.php?action=detail&amp;id=<?= htmlspecialchars($id) ?>">
        <input type="hidden" name="script_delete" value='true'>
        <input type="submit" value="Supprimer">
    </form>
<?php $articleContent = ob_get_clean();

require('View/template.php');
