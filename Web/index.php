<?php
include_once("TestConnection.php");
if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {

  $name = $_POST["name"];
  $email = $_POST["email"];
  $text = $_POST["notes"];
  $image = $_POST["image"];
  $sql = "insert into Comments values(NULL, '$name', '$email', '$text', '$image', NOW())";
// a', "b", "c", "d", NOW()); select * from Class.Comments; --
// delete from Class.Comments
  printf("<script>console.log('We are going to post $sql');</script>")
  if ($conn->multi_query($sql) === TRUE) {
      // echo "New record created successfully";
  } else {
      echo "Error: " . $conn->error;
  }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" href="favicon.ico">

  <title>Starter Template for Bootstrap</title>

  <!-- Bootstrap core CSS -->
  <link href="dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
  <link href="assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
  <!--[if lt IE 9]><script src="assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
  <script src="assets/js/ie-emulation-modes-warning.js"></script>

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>

<body>

  <nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#">Project name</a>
      </div>
      <div id="navbar" class="collapse navbar-collapse">
        <ul class="nav navbar-nav">
          <li class="active"><a href="#">Home</a></li>
          <li><a href="#about">About</a></li>
          <li><a href="#contact">Contact</a></li>
        </ul>
      </div><!--/.nav-collapse -->
    </div>
  </nav>

  <div class="maincontainer">
    <?php

    /* Select queries return a resultset */
    if ($results = $conn->query("SELECT * FROM Comments order by idComments desc")) {
      foreach ($results as $result) {
        $name = $result["name"];
        $imageurl = $result["image"];
        $text = $result["text"];
        $date = $result["posted"];
        $date = time_elapsed_string($date);
        print <<<END
        <div class="row">
          <div class="col-sm-1 thumbnail">
            <div class="thumbnail">
              <img class="img-responsive user-photo" src="$imageurl">
            </div><!-- /thumbnail -->
          </div><!-- /col-sm-1 -->

          <div class="col-sm-10">
            <div class="panel panel-default">
              <div class="panel-heading">
                <strong>$name</strong> <span class="text-muted">$date</span>
              </div>
              <div class="panel-body">
                $text
              </div><!-- /panel-body -->
            </div><!-- /panel panel-default -->
          </div><!-- /col-sm-5 -->
        </div><!-- /row -->
END;

        // printf($result['name']);
      }
    }else{
      printf("Failed to get anything");
    }
    ?>
    <div class="maincontainer">

      <hr />
      <form method="POST" action="index.php">
        <label for="name">Name</label>
        <input name="name" id="name" placeholder="John Doe"  class="form-control" />
        <label for="email">Email</label>
        <input name="email" id="email" placeholder="test@example.org"  class="form-control" />
        <label for="name">Image</label>
        <input name="image" id="image" placeholder="i.imgur.com"  class="form-control" />
        <label for="textarea">Note</label>
        <textarea name="notes" id="notes" class="form-control" rows="3"></textarea>

        <button type="submit" class="btn btn-default">Confirm identity</button>
      </form>
    </div>

  </div><!-- /.container -->


  <!-- Bootstrap core JavaScript
  ================================================== -->
  <!-- Placed at the end of the document so the pages load faster -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script>window.jQuery || document.write('<script src="assets/js/vendor/jquery.min.js"><\/script>')</script>
  <script src="dist/js/bootstrap.min.js"></script>
  <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
  <script src="assets/js/ie10-viewport-bug-workaround.js"></script>
</body>
</html>
