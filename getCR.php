<?php
//Starts the session that's being used
  session_start();
  if($_SESSION["loggedIn"] != "true"){
    header('Location: http://oai-content.co.uk');
  }
  if($_SESSION["role"] != "Lab Manager" && $_SESSION["role"] != "PR"){
    header('Location: http://oai-content.co.uk/dashboard.php');
  }
?>

<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
  <script type="text/javascript" src="./script.js"></script>

  <title>UoD Get CR</title>
</head>

<body>
  <!-- nav bar -->
  <div class="navbar navbar-site navbar-default" role="navigation">
      <div class="navbar-main">
          <div class="container">
              <div class="row">
                  <div class="navbar-header">
                      <div class="logo-group clearfix">
                          <img src="img_UoDLogo.jpg" alt="logo" style="max-width:70%;">
                      </div>
                  </div>
                  <div class="navbar-collapse collapse navbar-responsive-collapse-1">
                      <ul class="nav navbar-nav navbar-right">
                          <li><a href="http://oai-content.co.uk/dashboard.php">Dashboard</a></li>
                          <li><a href="http://oai-content.co.uk/logout.php">
                            Sign Out,
                            <?php
                              echo $_SESSION["username"];
                            ?>
                          </a></li>
                      </ul>
                  </div>
              </div>
          </div>
      </div>
      <div class="clearfix"></div>
</div>
<!-- nav bar -->

<?php
//The PHP for the form input
  if(isset($_POST['submitBtn']) && isset($_POST['username']))
  {
    $usernameIn = $_POST["username"];
    //Connect to server
    $conn = new mysqli("oaicontezoagile.mysql.db","oaicontezoagile","M5fgq184HDVu","oaicontezoagile");
    if ($conn -> connect_errno) {
      echo "<br>Failed to connect to MySQL: " . $conn -> connect_error;
      exit();
    }

    //Create call statement and run it
    $SQLInput2 = "CALL GivePRaCR( \"{$_SESSION["username"]}\", \"{$usernameIn}\")";
    $queryOutput = $conn->query($SQLInput2);

    //Check if query ran
    if($queryOutput == true){
      echo "<script type='text/javascript'>alert('Editted Successfully');</script>";
      die();
    }
    echo "<script type='text/javascript'>alert('Edit Failed');</script>";
  }
?>

<!-- html form -->
<div class="loginSection">
  <div class="container">
    <div class="row">
      <div class="col-md-4 col-xs-1">
         <!--Something on left maybe-->
      </div>
      <div id="loginCol" class="col-md-4 col-xs-10">
        <h1>UoD Add Co-Researcher</h1> <hr>
        <form action="" method="POST">
          <div class="form-group">
            <label for="username"> Your Current Co-Researchers:</label><br>
            <?php
              $ownCRs = [];
              $arrayLength = 0;
              //Connect to server
              $conn = new mysqli("oaicontezoagile.mysql.db","oaicontezoagile","M5fgq184HDVu","oaicontezoagile");
              if ($conn -> connect_errno) {
                echo "<br>Failed to connect to MySQL: " . $conn -> connect_error;
                exit();
              }
              $SQLInput = "CALL GetPRsCRs(\"{$_SESSION["username"]}\")";
              $queryOutput = $conn->query($SQLInput);

              if($queryOutput->num_rows > 0){
                while($row = $queryOutput->fetch_object()){
                    echo "-{$row -> CRUsername}<br>";
                    array_push($ownCRs, $row->CRUsername);
                    $arrayLength++;
                }
              }else{
                echo "<h1>You currently don't have any co-researchers</h1>";
              }
             ?>
          </div>
          <div class="form-group">
            <label for="username">Select the Co-Researcher you wish to add:</label>
            <br>
            <?php
              //Connect to server
              $conn = new mysqli("oaicontezoagile.mysql.db","oaicontezoagile","M5fgq184HDVu","oaicontezoagile");
              if ($conn -> connect_errno) {
                echo "<br>Failed to connect to MySQL: " . $conn -> connect_error;
                exit();
              }
              $SQLInput = "CALL getCRs";
              $queryOutput = $conn->query($SQLInput);

              if($queryOutput->num_rows > 0){
                while($row = $queryOutput->fetch_object()){
                  $running = 0;
                  for($i=0;$i<$arrayLength;$i++){
                    if($row->Username == $ownCRs[$i]){
                      $running = 1;
                    }
                  }
                  if($running == 0){
                    echo "<input type=\"radio\" id=\"{$row -> Username}\" value=\"{$row -> Username}\" name = \"username\"> <label for=\"{$row -> Username}\">{$row -> Username}</label><br>";
                  }
                }
              }else{
                echo '<h1>There are no co-researchers</h1>';
              }
            ?>
          </div>
          <br>
          <button id="submitBtn"type="submit" class="btn btn-primary" name ="submitBtn">Assign Co-Researcher</button>
        </form>
      </div>
      <div class="col-md-4 col-xs-1">
        <!--Something on right maybe-->
      </div>
    </div>
  </div>
</div>
<!-- html form -->

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</head>
</html>
