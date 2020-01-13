<?php
session_start();
$target_dir = "img/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);

$anon = "false";
if (isset($_POST['anon'])) {
    # code...
    $anon = "true";
}
$fname =  $_FILES["fileToUpload"]["name"];
$content = $_POST['content'];
$uname = $_SESSION['name'];
$pname = $_POST['conName'];
$uemail = $_SESSION['email'];

$conn = mysqli_connect("localhost", "root", "", "myDb");
$sql = "INSERT INTO post (name, pName, email, content, anon, image)
    VALUES ('$uname', '$pname', '$uemail', '$content', '$anon', '$fname')";

mysqli_query($conn, $sql);
header('Location: home.php');


?>