<?php
require $_SERVER["DOCUMENT_ROOT"] . '/Appdev/config/database.php';
$db = Database::getInstance();
$conn = $db->getConnection();

$stmt = $conn->prepare("INSERT INTO user_admin (first_name, last_name, email, password) VALUES (?,?,?,?)");
$stmt->bind_param("ssss", $firstname, $lastname, $email, $pass_word);

$firstname = $_POST["first_name"];
$lastname = $_POST["last_name"];
$email = $_POST["email"];
$pass_word = password_hash($_POST["pass_word"], PASSWORD_DEFAULT);
$stmt->execute();

$stmt->close();
$conn->close();

header("location: ../admin");
?>
