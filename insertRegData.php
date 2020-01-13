<?php
  session_start();
  if (!empty($_POST)){
  $email = $_POST["email"];
  $pass = $_POST["psw"];
  $name = $_POST["name"];
  $conPass = $_POST["psw-repeat"];
  }
  

  $flag = 0;

  
  if ($_SERVER["REQUEST_METHOD"] == "POST"){
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $_SESSION["sesErr"] = "* Invalid email format<br>";
      header('Location: reg.php');
      $flag = 1; 
    }

    else if (strlen($pass)<4) {
      $_SESSION["sesErr"] = "* Password  length should be minimum 4<br>";
      header('Location: reg.php');
      $flag = 1;
    }

    else if ($pass == $conPass) {
      # code...
      $conn = mysqli_connect("localhost", "root", "", "myDb");
      $sql = "INSERT INTO user (name, email, password)
        VALUES ('$name', '$email', '$pass')";
      $sql1 = "SELECT email FROM user WHERE `email` = '$email'";

      $res = mysqli_query($conn, $sql1);

      if (mysqli_num_rows($res)) {
        # code...
        $_SESSION["sesErr"] = "* Email is alredy registered. Please select another one<br>";
        header('Location: reg.php');
      }
      else{
        mysqli_query($conn, $sql);
        header('Location: login.php');
      }

    }
    else{
      $_SESSION["sesErr"] = "* Password and repeated password did not matched<br>";
      header('Location: reg.php');
    }


}


?>