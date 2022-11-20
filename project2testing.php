<?php
$title = "CSE476 proj2 Test Page";
//
//  The user and password below are those you used in your
//  android application.
//

$user = "chessman";
$password = "chesspass";
//$user = "marshall";
//$password = "marshallpass";

$base_url = "https://webdev.cse.msu.edu/~kroskema/cse476/project2/"; // verify that this is the correct path to your web site
$magic = "NechAtHa6RuzeR8x";
?>
<html lang="en">
<head>
    <title><?php echo $title; ?></title>
</head>
<body>
<h1><?php echo $title; ?></h1>
<h2>p2 Testing</h2>
<p>Paste the valid xml created to save a hatting in the input box below,
    then click the "Test create" Button. On the new page that appears use the
    browser "View page source" option to see the results.</p>
<form method="post" target="_blank" action="<?php echo $base_url; ?>chess-creategame.php">
    <p>Userid: <input type="text" name="user" value="<?php echo $user;?>"/></p>
    <p>magic: <input type="text" name="magic" value="<?php echo $magic;?>"/></p>
    <p>Password: <input type="text" name="pw" value="<?php echo $password;?>"/></p>
    <p><input type="submit" value="Test create" /></p>
</form>

<form method="post" target="_blank" action="<?php echo $base_url; ?>chess-deletegame.php">
    <input type="hidden" name="magic" value="<?php echo $magic; ?>" />
    <input type="hidden" name="user" value="<?php echo $user; ?>" />
    <input type="hidden" name="pw" value="<?php echo $password; ?>" />
    <input type="submit" value="Test delete" />
</form>

<form method="get" target="_blank" action="<?php echo $base_url; ?>chess-getgamestate.php">
    <input type="hidden" name="magic" value="<?php echo $magic; ?>" />
    <input type="hidden" name="user" value="<?php echo $user; ?>" />
    <input type="hidden" name="pw" value="<?php echo $password; ?>" />
    <input type="submit" value="Test getgamestate" />
</form>

</body>
</html>