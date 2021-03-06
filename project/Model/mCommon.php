<?php
define('MAX_LIST', 5);


function dbConnect() {
    $errMsg = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
    $dbName = 'eventCalendar';
    $dbUser = 'root';
    $dbPass = '';
    
    $dataBase = new PDO('mysql:host=localhost;dbname='.$dbName.';charset=utf8', $dbUser, $dbPass, $errMsg);
    if (!$dataBase) throw new Exception("Base De Données : Echec de connexion");

    return $dataBase;
}

function getEventStatus($idEvent) {//value or false
    $bdd = dbConnect();

    $query = 'SELECT iduser_participates_events
            FROM user_participates_events
            WHERE id_event = :event AND id_participant = :user';
    $table = array('event' => $idEvent, 'user' => $_SESSION['id']);

    $request = $bdd->prepare($query);
    if (!$request->execute($table)) throw new Exception("Base De Données : Echec d'exécution");
    $table = $request->fetch();
    $request->closeCursor();

    return $table['iduser_participates_events'];
}
