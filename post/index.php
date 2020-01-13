<?php session_start();?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Confession</title>

  <link href="bootstrap.min.css" rel="stylesheet">

  <style>
  .button {
  background-color: #4CAF50;
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
}
</style>

</head>

<body>

  

  <!-- Page Content -->
  <div class="container">

    <div class="row">

      <!-- Post Content Column -->
      <div class="col-lg-8">

        <!-- Title -->
        <h1 class="mt-4">Confession</h1>

        <!-- Author -->
        <p class="lead">
          by
          <?php echo $_GET['name']?>
        </p>

        <!-- Date/Time -->
        <p>
          Name: <?php echo $_GET['pname']?>
        </p>

        <hr>

        <!-- Preview Image -->
        <img class="img-fluid rounded" src="../img/<?php echo $_GET['img']; ?>" alt="">

        <hr>

        <!-- Post Content -->
        <p class="lead"><?php echo $_GET['content']?></p>

        <hr>

        <!-- Comments Form -->
        <?php if (!isset($_GET['xx'])): ?>
        <div class="card my-4">
          <h5 class="card-header">Leave a Comment:</h5>
          <div class="card-body">
            <form method="POST" action="">
              <div class="form-group">
                <textarea class="form-control" rows="3" name="cmnt"></textarea>
              </div>
              <button type="submit" class="btn btn-primary">Submit</button>
            </form>
          </div>
        </div>
      <?php endif;?>

      <?php if (isset($_GET['xx'])): ?>

        <form method="post" action="">
          <input type="submit" name="delete" class="button" value="Delete" />
          <input type="submit" name="update" class="button" value="Update" />
        </form>

        <?php
        $pId = $_GET['id'];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['delete'])) {
                //echo "Delete";
                $conn = mysqli_connect("localhost", "root", "", "myDb");
                $sql = "DELETE FROM post WHERE `id` = '$pId'";
                $sql1 = "DELETE FROM comment WHERE `postId` = '$pId'";
                mysqli_query($conn, $sql);
                mysqli_query($conn, $sql1);
                header('Location: ../userPost.php');
            } 
            elseif(isset($_POST['update'])) {
                //echo "Update";
                $pId = $_GET['id'];
                echo $pId;
                header('Location: ../updatePost.php?val=update&ppid='.$pId);
            }
        }

        ?>

        <h3>Comments</h3><hr>
      <?php endif;?>

        <!-- Single Comment -->
        <?php
        
        if (isset($_POST['cmnt'])) {
          # code...
          $cmnt = $_POST['cmnt'];
          $pId = $_GET['id'];
          $comName = $_SESSION['name'];

          $conn = mysqli_connect("localhost", "root", "", "myDb");
          $sql = "INSERT INTO comment (postId, commenterName, comment)
        VALUES ('$pId', '$comName', '$cmnt')";
          mysqli_query($conn,$sql);
        }
        ?>

        <?php
          $pId = $_GET['id'];
          $conn = mysqli_connect("localhost", "root", "", "myDb");
          $sql = "SELECT * FROM comment WHERE `postId` = '$pId'";
          $res = mysqli_query($conn, $sql);
          $r = mysqli_num_rows($res);
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

        <?php for($i = 0; $i<$r; $i++): ?>
        <div class="media mb-4">
          <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
          <div class="media-body">
            <h5 class="mt-0"><?php echo $row[$i]['commenterName'];?></h5>
            <?php echo $row[$i]['comment'];?>
          </div>
        </div>
        <?php endfor ?>

      </div>

    </div>

  </div>
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>
