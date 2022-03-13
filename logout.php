<?php
//Starts the session that's being used
  session_start();
  if($_SESSION["loggedIn"] != "true"){
    header('Location: http://oai-content.co.uk');
  }
  else{
    session_unset();
    header('Location: http://oai-content.co.uk');
  }
?>

<html>
<head>
  <meta http-equiv="refresh" content="5; URL=http://oai-content.co.uk" />
</head>
<body>
  <p>If you are not redirected in five seconds, <a href="http://oai-content.co.uk">click here</a>.</p>
</body>
</html>
