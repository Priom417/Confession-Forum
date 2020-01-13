<?php
session_start();
if (isset($_GET['logout'])) {
  # code...
  if ($_GET['logout'] == 'true') {
    # code...
    setcookie('loggedIn',"", time()-3600);
    setcookie('name',"", time()-3600);
    setcookie('email',"", time()-3600);
  }
}
else if (isset($_COOKIE['loggedIn'])) {
  # code...
  $_SESSION['name'] = $_COOKIE['name'];
  $_SESSION['email'] = $_COOKIE['email'];
  header('Location: home.php');
}

if (isset($_SESSION['loggedIn'])) {
  # code...
  setcookie('loggedIn','true', time()+3600);
  setcookie('name',$_SESSION['name'], time()+3600);
  setcookie('email',$_SESSION['email'], time()+3600);

  header('Location: home.php');
}
if (isset($_SESSION['name'])) {
  # code...
  //header('Location: home.php');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  
  <title>Confession Form</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <style>
  body {
    font: 400 15px/1.8 Lato, sans-serif;
    color: #777;
  }
  h3, h4 {
    margin: 10px 0 30px 0;
    letter-spacing: 10px;      
    font-size: 20px;
    color: #111;
  }
  .container {
    padding: 80px 120px;
  }
  .person {
    border: 10px solid transparent;
    margin-bottom: 25px;
    width: 80%;
    height: 80%;
    opacity: 0.7;
  }
  .person:hover {
    border-color: #f1f1f1;
  }
  .carousel-inner img {
    width: 100%; 
    margin: auto;
  }
  .carousel-caption h3 {
    color: #fff !important;
  }
  @media (max-width: 600px) {
    .carousel-caption {
      display: none; 
  }
  .bg-1 {
    background: #2d2d30;
    color: #bdbdbd;
  }
  .bg-1 h3 {color: #fff;}
  .bg-1 p {font-style: italic;}
  .list-group-item:first-child {
    border-top-right-radius: 0;
    border-top-left-radius: 0;
  }
  .list-group-item:last-child {
    border-bottom-right-radius: 0;
    border-bottom-left-radius: 0;
  }
  .thumbnail {
    padding: 0 0 15px 0;
    border: none;
    border-radius: 0;
  }

  .item {
    height: 650px;
  }

  .thumbnail p {
    margin-top: 15px;
    color: #555;
  }
  .btn {
    padding: 10px 20px;
    background-color: #333;
    color: #f1f1f1;
    border-radius: 0;
    transition: .2s;
  }
  .btn:hover, .btn:focus {
    border: 1px solid #333;
    background-color: #fff;
    color: #000;
  }
  .modal-header, h4, .close {
    background-color: #333;
    color: #fff !important;
    text-align: center;
    font-size: 30px;
  }
  .modal-header, .modal-body {
    padding: 40px 50px;
  }
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
  footer {
    background-color: #2d2d30;
    color: #f5f5f5;
    padding: 32px;
  }
  footer a {
    color: #f5f5f5;
  }
  footer a:hover {
    color: #777;
    text-decoration: none;
  }  
  .form-control {
    border-radius: 0;
  }
  textarea {
    resize: none;
  }
  </style>
</head>
<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="50">

<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="index.php">HOME</a></li>
        <li><a href="allPost.php">ALL CONFESSION</a></li>
        <li><a href="postConfession.php">POST A CONFESSION</a></li>
        <li><a href="#contact">CONTACT</a></li>
        <li><a href="login.php">LOGIN/SIGNUP</a></li>
      </ul>
    </div>
  </div>
</nav>

<div id="myCarousel" class="carousel slide" data-ride="carousel">
    
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>

    
    <div class="carousel-inner" role="listbox">
      <div class="item active">
        <img src="img/113.jpg" alt="New York" width="1000" height="500">
        <div class="carousel-caption">
          <h3></h3>
          <p>“But some secrets are too delicious not to share.” </p>
        </div>      
      </div>

      <div class="item">
        <img src="img/bg111.jpg" alt="Chicago" width="1000" height="500">
        <div class="carousel-caption">
          <h3></h3>
          <p>“Once exposed, a secret loses all its power.”</p>
        </div>      
      </div>
    
      <div class="item">
        <img src="img/112.jpg" alt="Los Angeles" width="1000" height="500">
        <div class="carousel-caption">
          <h3></h3>
          <p>“Some secrets are better left at that -as secrets.”</p>
        </div>      
      </div>
    </div>

    
    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
</div>


<div id="band" class="container text-center">
  <h3>CONFESSION FORUM</h3>
  <p><em>We love your confess!</em></p>
  <p>There are thoughts and deeds that you might not be able to reveal to anyone, although sometimes you feel like your mind might explode or your chest might burst if you don’t. what if you could make your own confessions without revealing your identity?

imagine yourself in a room, alone. you take a piece of paper and you start writing your deepest fears, your wildest fantasies, your craziest memories. no one to judge, no one physically there to criticize, just you and your confessions.

what if you could say out loud what you’ve been keeping inside? what if you could say the whole truth and nothing but the truth? what if you could make your confessions to total strangers without having to fear their reactions? would you take the leap?

an area that is your personal, anonymous, everyday diary. a place that is fully dedicated to your confessions, whether good or bad, shameful or embarrassing. just say it out loud.</p>
  <br>
  
</div>


<div id="contact" class="container">
  <h3 class="text-center">Contact</h3>
  <p class="text-center"><em>We love our fans!</em></p>

  <div class="row">
    <div class="col-md-4">
      <p>Fan? Drop a note.</p>
      <p><span class="glyphicon glyphicon-map-marker"></span>Dhaka, Bangladesh</p>
      <p><span class="glyphicon glyphicon-phone"></span>Phone: +8801766293417</p>
      <p><span class="glyphicon glyphicon-envelope"></span>Email: priom417@gmail.com</p>
    </div>
    <div class="col-md-8">
      <div class="row">
        <div class="col-sm-6 form-group">
          <input class="form-control" id="name" name="name" placeholder="Name" type="text" required>
        </div>
        <div class="col-sm-6 form-group">
          <input class="form-control" id="email" name="email" placeholder="Email" type="email" required>
        </div>
      </div>
      <textarea class="form-control" id="comments" name="comments" placeholder="Comment" rows="5"></textarea>
      <br>
      <div class="row">
        <div class="col-md-12 form-group">
          <button class="btn pull-right" type="submit">Send</button>
        </div>
      </div>
    </div>
  </div>
  <br> 
</div>

<script>
$(document).ready(function(){
  
  $('[data-toggle="tooltip"]').tooltip(); 
  
  
  $(".navbar a, footer a[href='#myPage']").on('click', function(event) {

    
    if (this.hash !== "") {

      
      event.preventDefault();

      
      var hash = this.hash;

      
      $('html, body').animate({
        scrollTop: $(hash).offset().top
      }, 900, function(){
   
        
        window.location.hash = hash;
      });
    }
  });
})
</script>

</body>
</html>