<?php
session_start();
if(empty($_SESSION['token'])) {

  if (strpos($_SERVER['REQUEST_URI'],"Authenticate.php") < 0 ) {
    // echo "is the page " . $_SERVER['REQUEST_URI'] . " ". strpos($_SERVER['REQUEST_URI'],"Authenticate.php");

    header("Location: /SwissCheese/Web/Authenticate.php?#notAuthenticated"); /* Redirect browser */
  }else{
    echo "is not the page " . $_SERVER['REQUEST_URI'] . " ". strpos($_SERVER['REQUEST_URI'],"Authenticate.php");
  }
} else {
    echo 'Welcome ' . $_SESSION['name'];
}
$servername = "localhost";
$username = "root";
$password = "cheese";
$database = "Class";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


function time_elapsed_string($datetime, $full = false) {
  $now = new DateTime;
  $ago = new DateTime($datetime);
  $diff = $now->diff($ago);

  $diff->w = floor($diff->d / 7);
  $diff->d -= $diff->w * 7;

  $string = array(
    'y' => 'year',
    'm' => 'month',
    'w' => 'week',
    'd' => 'day',
    'h' => 'hour',
    'i' => 'minute',
    's' => 'second',
  );
  foreach ($string as $k => &$v) {
    if ($diff->$k) {
      $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
    } else {
      unset($string[$k]);
    }
  }

  if (!$full) $string = array_slice($string, 0, 1);
  return $string ? implode(', ', $string) . ' ago' : 'just now';
}
?>
