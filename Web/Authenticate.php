<?php
include_once("TestConnection.php");
if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
  $mode = $_GET['mode'];
  if (strcmp($mode, "register") === 0) {
    $name = $_REQUEST["name"];
    $email = $_REQUEST["email"];
    $password = $_REQUEST["password"];
    $image = $_REQUEST["image"];
    $sql = "insert into Users values(NULL, '$name', '$email', '$password', '$image', NOW())";

    if ($results = $conn->query($sql)) {
      location_header("/SwissCheese/Web/index.php");
    }else{
      die("Something went wrong");
    }
    }else if(strcmp($mode, "login") === 0){

    $username = $_REQUEST["email"];
    $password = $_REQUEST["password"];

    $sql = "select name,email,id, sha1(concat(name,email,id,password)) AS token from Users where email = '$username' AND password = '$password'";

    if ($results = $conn->query($sql)) {
      if ($results->num_rows === 1) {
        // we are good
        $user = $results->fetch_object();
        $id = $user->id;
        $email = $user->email;
        $name = $user->name;
        $token = $user->token;

        $_SESSION['userid'] = $id;
        $_SESSION['email'] = $email;
        $_SESSION['name'] = $name;
        $_SESSION['token'] = $token;
        location_header("/SwissCheese/Web/index.php");
      }else if ($results->num_rows === 0) {
        printf("Cannot authenticate");
      }else{
        die("somethign went terribally wrong");
      }

    }else{
      die("something went even worse ");
    }
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

  <div class="maincontainer">
    <div class="maincontainer">
      <div class="row">
        <div class="col-md-6">
          <label for="Login">Login</label>
          <form method="POST" action="Authenticate.php?mode=login">
            <label for="email">Email</label>
            <input name="email" id="email" placeholder="test@example.org"  class="form-control" />
            <label for="password">Password</label>
            <input name="password" id="password" placeholder="password" type="password"  class="form-control" />
            <button type="submit" class="btn btn-default">Submit</button>
          </form>
        </div>
        <div class="col-md-6">
          <label for="Regestration">Regestration</label>
          <form method="POST" action="Authenticate.php?mode=register">
            <label for="name">Name</label>
            <input name="name" id="name" placeholder="Jack Johnson"  class="form-control" />
            <label for="email">Email</label>
            <input name="email" id="email" placeholder="test@example.org"  class="form-control" />
            <label for="image">Image</label>
            <input name="image" id="image" placeholder="i.imgur.com/yourpic"  class="form-control" />
            <label for="password">Password</label>
            <input name="password" id="password" placeholder="password" type="password"  class="form-control" />
            <button type="submit" class="btn btn-default">Submit</button>
          </form>      </div>
        </div>
        <blockquote>
          <B style="color:red;">
            We promise that we will keep your email address private. We only use it to allow you to quickly comment.
          </B>
        </blockquote>
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
  <?php
  $conn->close();
  ?>
