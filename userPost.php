<?php

  session_start();
  if (!isset($_SESSION['name'])) {
    # code...
    header('Location: login.php');
    $_SESSION['sesErr'] = "Please login first to post";
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
  
  <title>Confession By You</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Karma">
  <style>
body,h1,h2,h3,h4,h5,h6 {font-family: "Karma", sans-serif}
.w3-bar-block .w3-bar-item {padding:20px}
.nav-tabs li a {
    color: #777;
  }
  #googleMap {
    width: 100%;
    height: 400px;
    -webkit-filter: grayscale(100%);
    filter: grayscale(100%);
  }  
  .navbar {
    font-family: Montserrat, sans-serif;
    margin-bottom: 0;
    background-color: #2d2d30;
    border: 0;
    font-size: 11px !important;
    letter-spacing: 4px;
    opacity: 0.9;
  }
  .navbar li a, .navbar .navbar-brand { 
    color: #d5d5d5 !important;
  }
  .navbar-nav li a:hover {
    color: #fff !important;
  }
  .navbar-nav li.active a {
    color: #fff !important;
    background-color: #29292c !important;
  }
  .navbar-default .navbar-toggle {
    border-color: transparent;
  }
  .open .dropdown-toggle {
    color: #fff;
    background-color: #555 !important;
  }
  .dropdown-menu li a {
    color: #000 !important;
  }
  .dropdown-menu li a:hover {
    background-color: red !important;
  }
</style>

</head>
<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="50">

<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container-fluid">
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="index.php">HOME</a></li>
        <li><a href="allPost.php">ALL CONFESSION</a></li>
        <li><a href="postConfession.php">POST A CONFESSION</a></li>
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">
            <?php if (isset($_SESSION['name'])) {
            # code...
            echo $_SESSION['name'];
          } ?>
          <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="userPost.php">My Post</a></li>
            <li><a href="#">Change Password</a></li>
            <li><a href="logout.php">Logout</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>
<br><br><br>
<h3 align="center">All Posts By You</h3>

<?php
  $conn = mysqli_connect("localhost", "root", "", "myDb");
  $email = $_SESSION['email'];
  $sql = "SELECT * FROM post WHERE `email` = '$email'";
  $res = mysqli_query($conn, $sql);
  $r = mysqli_num_rows($res);
  $x = ceil($r/4);

  $z = 0;

  $row = array();
  if ($r) {
    # code...
    $i = 0;
    while ($rr = mysqli_fetch_assoc($res)) {
      # code...
      $row[$i] = $rr;
      //print_r($row[$i]);
      $i++;
    }
  }

?>

<div class="w3-main w3-content w3-padding" style="max-width:1200px;margin-top:10px">
  

  <?php for($i = 0; $i<$x; $i++): ?>
  <div class="w3-row-padding w3-padding-16 w3-center" id="food">

    <?php for($j = 0; $j<4; $j++): ?>
    <?php 

    if($z == $r)
      break;
     ?>
    <div class="w3-quarter">
      <img src="img/<?php echo $row[$z]['image']; ?>" alt="Sandwich" style="width:100%">

      <?php
        $nn = $row[$z]['name'];
      ?>

      <h4>Name: <?php echo $row[$z]['pName']?></h4>

      <h4>Post by: <?php echo $nn?></h4>

      <?php
          $vv = $row[$z]['content'];
          $idd = $row[$z]['id'];
          $pp = $row[$z]['pName'];
          $mm = $row[$z]['image'];
          $ff = "";
          for($k = 0; $k<strlen($vv); $k++){
            $ff = $ff.$vv[$k];
            if($k > 100){
              break;
            }
          }
          for($k = 0; $k<5; $k++){
            $ff=$ff.".";
          }
      ?>
      <?php echo "<a href='post/index.php?name=$nn&pname=$pp&content=$vv&img=$mm&id=$idd&xx=1'><p>$ff</p></a>"?>
    </div>

    <?php $z++; ?>

    <?php endfor ?>

  </div>
  <?php endfor ?>

  <div class="w3-center w3-padding-32">
    <div class="w3-bar">
      <a href="#" class="w3-bar-item w3-button w3-hover-black">«</a>
      <a href="#" class="w3-bar-item w3-black w3-button">1</a>
      <a href="#" class="w3-bar-item w3-button w3-hover-black">2</a>
      <a href="#" class="w3-bar-item w3-button w3-hover-black">3</a>
      <a href="#" class="w3-bar-item w3-button w3-hover-black">4</a>
      <a href="#" class="w3-bar-item w3-button w3-hover-black">»</a>
    </div>
  </div>
</div>

</body>
</html>