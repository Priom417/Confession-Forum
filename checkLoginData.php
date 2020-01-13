<?php 

session_start();
  if (!empty($_POST)){
  $email = $_POST["email"];
  $pass = $_POST["psw"];
  }

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $_SESSION["sesErr"] = "<br>* Invalid email format<br>";
      header('Location: login.php');
    }
    else{
    	$conn = mysqli_connect("localhost", "root", "", "myDb");
    	$sql = "SELECT * FROM user WHERE `email` = '$email' AND `password` = '$pass'";
    	$res = mysqli_query($conn, $sql);
    	if (mysqli_num_rows($res) == 1) {
    		# code...
    		while($row = mysqli_fetch_assoc($res)) {
        		$name = $row['name'];
        		if (isset($_POST['remember'])) {
        			# code...
        			$_SESSION['loggedIn'] = "true";
        			header('Location: home.php');
        		}
        		$_SESSION['name'] = $name;
        		$_SESSION['email'] = $email;
        		header('Location: index.php');
    		}
    	}
    	else{
    		header('Location: login.php');
    		$_SESSION["sesErr"] = "<br>* Email Password did not matched<br>";
    	}
    }
}
 ?>