<?php



$mysqli = require_once('../includes/dbh.inc.php');

print_r($_POST);


$sql = "INSERT INTO user (name, email, password) VALUES (?, ?, ?)";

$stmt = $mysqli->stmt_init();



////delete all this shit??? no fucking clue what to do