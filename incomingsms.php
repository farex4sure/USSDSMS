<?php
include_once './dbconnect.php';
include_once './util.php';
include_once './user.php';

// Check if 'from' and 'text' keys are set in $_POST
// $phoneNumber = isset($_POST['from']) ? $_POST['from'] : '';
// $text = isset($_POST['text']) ? $_POST['text'] : '';

$phoneNumber = $_POST['from'];
$text = $_POST['text'];

// $user = new User($phoneNumber);
// $db = new DBConnector();
// $pdo = $db->connect();

$text = explode(" ", $text);
// $user->setName($text[0]);
// $user->setPin($text[1]);
// $user->setBalance(Util::$USER_BALANCE);

// $user->register($pdo);

$fname1 = $text[0];
$fname2 = $text[1];
$fname = $fname1." ".$fname2;
$pin = $text[2];
$date = time();

$insert = mysqli_query($conn, "INSERT INTO users (fullname,phone,pin,bal,date_reg,language)VALUES('$fname','$phoneNumber','$pin','0','1','$date')");

?>
