<?php
require_once "db.inc.php";
echo '<?xml version="1.0" encoding="UTF-8" ?>';

if(!isset($_POST['magic']) || $_POST['magic'] != "NechAtHa6RuzeR8x") {
    echo '<hatter status="no" msg="magic" />';
    exit;
}

process($_POST['user'], $_POST['pw'], $_POST['magic']);

function process($user, $password, $magic) {
    // Connect to the database
    $pdo = pdo_connect();
    $userid = getUser($pdo, $user, $password);

    //check if the player is in a game already
    $query1 = "select * from chessgames where player1id = $userid or player2id = $userid";

    if($pdo->exec($query1)){
        echo '<chess status="no" msg="user already has ongoing game" />';
        exit;
    }


    $query2 = "insert into chessgames(player1id) values($userid)";
    if($pdo->exec($query2)){
        echo '<chess status="yes" msg="game created" />';
        exit;
    }
    echo '<chess status="no" msg="game create failed" />';

}

/**
 * Ask the database for the user ID. If the user exists, the password
 * must match.
 * @param $pdo
 * @param $user
 * @param $password
 * @return $id
 */
function getUser($pdo, $user, $password) {
    // Does the user exist in the database?
    $userQ = $pdo->quote($user);
    $query = "SELECT id, password from chessuser where user=$userQ";

    $rows = $pdo->query($query);
    if($row = $rows->fetch()) {
        // We found the record in the database
        // Check the password
        if($row['password'] != $password) {
            echo '<chess status="no" msg="password error" />';
            exit;
        }

        return $row['id'];
    }

    echo '<chess status="no" msg="user error" />';
    exit;
}