<?php
require_once "db.inc.php";
echo '<?xml version="1.0" encoding="UTF-8" ?>';

if(!isset($_POST['magic']) || $_POST['magic'] != "NechAtHa6RuzeR8x") {
    echo '<chess status="no" msg="magic" />';
    exit;
}

process($_POST['game'], $_POST['magic']);

function process($gameID, $magic) {
    // Connect to the database
    $pdo = pdo_connect();

    //deletes the game by ID specifies
    $query = "DELETE FROM chessgames WHERE id=$gameID";
    if($pdo->exec($query)){
        echo '<chess status="yes" msg="game deleted" />';
        exit;
    }
    echo '<chess status="no" msg="game delete failed, record not found" />';

}
