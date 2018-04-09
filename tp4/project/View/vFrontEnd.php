<?php
function displayMonth($part, $dataEvent, $dataDay) {
    switch ($part) {
        case 3:
            if ($dataEvent['place'] > 0 || $dataEvent['status']) return true;
            else return false;
        break;
        case 4:
            if ($dataEvent['status']) echo 'class="follow"';
        break;
    }
}

function displayDay($part, $dataEvent, $date) {
    switch ($part) {
        case 2:?>
            <br>Organisateur : <?= htmlspecialchars($dataEvent['organizer']) ?><br>
            <br>
            Inscrit : <?= htmlspecialchars($dataEvent['status']) ?>
        <?php break;
    }
}


function displayEvent($id, $action) {
    ?><form method="post" action="index.php?action=detail&amp;id=<?= htmlspecialchars($id) ?>">
        <input type="hidden" name="script_join" value='true'>
        <input type="submit" value=<?= $action ?>>
    </form><?php
}

