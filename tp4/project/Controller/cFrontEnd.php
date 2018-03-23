<?php
require('Model/mFrontEnd.php');

function cEventsMonth($date) {//ok
    if (!isset($date)) {
        $date = date('Y-m');
    }

    $timeStamp = strtotime($date);
    $showDate = strftime('%B %Y', $timeStamp);
    $nbDayMonth = date('t', $timeStamp);

    $split = explode('-', $date);
    $lastMonth = date('Y-m', gmmktime(0, 0, 0, $split[1] - 1, 0, $split[0]));
    $nextMonth = date('Y-m', gmmktime(0, 0, 0, $split[1] + 1, 0, $split[0]));

    $dayName['ang'] = array('Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun');
    $dayName['fr'] = array('Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche');
    $dayStartMonth = date('D', gmmktime(0, 0, 0, $split[1], 1, $split[0]));//pour commencer le tableau d affichage
    $dayEndMonth = date('N', gmmktime(0, 0, 0, $split[1], $nbDay, $split[0]));//pour finir le tableau d affichage

    for ($day = 1; $day <= $nbDayMonth; $day++) {
        $eventsMonth[] = getEventsDay($date, true);//si vide, listEventsMonth[] vaudra false ->verifier requete
    }

    require('View/FrontEnd/vReception.php');
}
/*
close cursor que si récupère des données et ne fait qu'un fetch simple
fetchall ferme le curseur tout seul
*/



function cEventsDay($date) {
    $showDate = strftime('%A %e %B %Y', strtotime($date));

    $split = explode('-', $date);
    $lastDay = date('Y-m-d', gmmktime(0, 0, 0, $split[1], $split[2] - 1, $split[0]));
    $nextDay = date('Y-m-d', gmmktime(0, 0, 0, $split[1], $split[2] + 1, $split[0]));

    $eventsDay = getEventsDay($date, false);
    
    require('View/FrontEnd/vAllEvents.php');
}



function cEvent($dataPage) {
    if (isset($_POST['exist'])) {
        //traite les infos recues
        if ($dataPage['eventJoined']) {
            $dataPage['newStateJoin'] = false;
        }
        else {
            $dataPage['newStateJoin'] = true;
        }//verifier que renvoi d'un post est true ou false
        if (!changeStatusEvent($dataPage)) throw new Exception('Echec d\'enregistrement des données');
    }

    $dataEvent = getEvent($infoPage['idEvent']);
    
    require('View/FrontEnd/vEvent.php');
}
