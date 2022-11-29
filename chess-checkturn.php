<?php
require_once "db.inc.php";
echo '<?xml version="1.0" encoding="UTF-8" ?>';

if(!isset($_GET['magic']) || $_GET['magic'] != "NechAtHa6RuzeR8x") {
    echo '<chess status="no" msg="magic" />';
    exit;
}

process($_GET['game']);

function process($gameID) {
    // Connect to the database
    $pdo = pdo_connect();
    $userid = getUser($pdo, $user, $password);

    //get gamestate
    $query = "SELECT * FROM chessgames WHERE id=$gameID";
    $rows = $pdo->query($query);
    if($row = $rows->fetch()){
        echo "<chess status='yes' msg='game found' turn='{$row['turn']}' piece='{$row['piece']}' x='{$row['x']}' y='{$row['y']}'/>";
        exit;
    }
    echo '<chess status="no" msg="game not found" />';

}
