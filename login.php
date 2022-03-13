<?php
//Starts the session that's being used
  session_start();
?>

<?php
//Checks if the inputted credentials are right
if(isset($_POST["username"]) && isset($_POST["pwd"]))
{
  //Take inputs
  $usernameIn = $_POST["username"];
  $passwordIn = $_POST["pwd"];

  //Connect to server
  $conn = new mysqli("oaicontezoagile.mysql.db","oaicontezoagile","M5fgq184HDVu","oaicontezoagile");
  if ($conn -> connect_errno) {
    echo "<br>Failed to connect to MySQL: " . $conn -> connect_error;
    exit();
  }

  //Create call statement and run it
  $SQLInput = "CALL CheckIfUserExists(\"{$usernameIn}\", \"{$passwordIn}\")";
  $queryOutput = $conn->query($SQLInput);


  //Check if found user
  if($queryOutput->num_rows > 0){
    $_SESSION["loggedIn"] = "true";
    $_SESSION["username"] = $usernameIn;
    $_SESSION["role"] = $queryOutput -> fetch_object()->Role;
    echo "User Authenticated! Welcome {$_SESSION["username"]} your role is {$_SESSION["role"]}";
    header('Location: http://oai-content.co.uk/dashboard.php');
    die();
  } else {
    echo "At least one of your credentials were wrong";
    $_SESSION["loggedIn"] = "false";
    header('Location: http://oai-content.co.uk');
    die();
  }
}
?>


<html>
<head>
  <body>
    Please wait to be redirected
    <br> If you don't move to a different webpage then please <a href="http://oai-content.co.uk/dashboard.php">click here</a>.
  </body>
</head>
</html>
