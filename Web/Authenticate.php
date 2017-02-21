<?php
include_once("TestConnection.php");

$username = $_REQUEST["email"];
$password = $_REQUEST["password"];

$sql = "select name,email,id, sha1(concat(name,email,id,password)) AS token from Users where username = $username AND password = $password";

if ($results = $conn->query($sql)) {
  if ($results->num_rows === 1) {
    // we are good
    $user = $results->fetch_object();
    $id = $user->id;
    $email = $user->email;
    $name = $user->name;
    $token = $user->token;

      session_start();
      $_SESSION['userId'] = $id;
      $_SESSION['email'] = $email;
      $_SESSION['name'] = $name;
      $_SESSION['token'] = $token;
      header("Location: /index.php?name=$name&toekn=$token"); /* Redirect browser */


  }else if ($results->num_rows === 0) {
    printf("Cannot authenticate");
  }else{
    die("somethign went terribally wrong");
  }

}else{
  die("something went even worse");
}

 ?>
