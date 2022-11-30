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
    //get check player2
    $query = "SELECT chessuser.user FROM chessgames, chessuser WHERE chessgames.id=$gameID AND chessuser.id=player2id";
    $rows = $pdo->query($query);
    if($row = $rows->fetch()){
        echo "<chess status='yes' msg='player joined' player2='{$row['user']}'/>";
        exit;
    }
    echo '<chess status="no" msg="no player joined yet" />';

}
