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

  <title>UoD Give CR Permissions</title>
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
  if(isset($_POST['submitBtn']))
  {
    $usernameIn = $_POST["CRUsername"];
    $questionnaireNum = $_POST["questionnaireNumIn"];
    $viewer = 0;
    $editor = 0;
    $deleter = 0;
    $footager = 0;
    $creator = 0;

    if(isset($_POST['view'])){
      if($_POST['view'] == "true"){
        $viewer = 1;
      }
    }
    if(isset($_POST['edit'])){
      if($_POST['edit'] == "true"){
        $editor = 1;
      }
    }
    if(isset($_POST['delete'])){
      if($_POST['delete'] == "true"){
        $deleter = 1;
      }
    }

    //Delete Previous Permissions
    //Connect to server
    $conn = new mysqli("oaicontezoagile.mysql.db","oaicontezoagile","M5fgq184HDVu","oaicontezoagile");
    if ($conn -> connect_errno) {
      echo "<br>Failed to connect to MySQL: " . $conn -> connect_error;
      exit();
    }

    $SQLInput = "CALL deleteCRPerms(\"{$usernameIn}\", \"{$questionnaireNum}\")";
    $queryOutput = $conn->query($SQLInput);
    $conn -> close();
    //Delete Previous Permissions

    //Get CRPRID
    $conn = new mysqli("oaicontezoagile.mysql.db","oaicontezoagile","M5fgq184HDVu","oaicontezoagile");
    if ($conn -> connect_errno) {
      echo "<br>Failed to connect to MySQL: " . $conn -> connect_error;
      exit();
    }
    $SQLInput = "CALL getCRPRID(\"{$usernameIn}\", \"{$_SESSION['username']}\")";
    $queryOutput = $conn->query($SQLInput);
    $CRPRID = $queryOutput -> fetch_object() -> Identifier;
    $conn -> close();

    //Add the new Permissions
    $conn = new mysqli("oaicontezoagile.mysql.db","oaicontezoagile","M5fgq184HDVu","oaicontezoagile");
    if ($conn -> connect_errno) {
      echo "<br>Failed to connect to MySQL: " . $conn -> connect_error;
      exit();
    }

    $SQLInput = "CALL newCRPerms(\"{$usernameIn}\", \"{$questionnaireNum}\", \"{$viewer}\", \"{$editor}\", \"{$deleter}\",\"{$CRPRID}\")";
    $queryOutput = $conn->query($SQLInput);
    $conn -> close();
    //Add the new Permissions

    //For creating
    if(isset($_POST['create'])){
      if($_POST['create'] == "true"){
        $creator = 1;
      }
    }
    if(isset($_POST['footage'])){
      if($_POST['footage'] == "true"){
        $footager = 1;
      }
    }
    $conn = new mysqli("oaicontezoagile.mysql.db","oaicontezoagile","M5fgq184HDVu","oaicontezoagile");
    if ($conn -> connect_errno) {
      echo "<br>Failed to connect to MySQL: " . $conn -> connect_error;
      exit();
    }
    $SQLInput = "CALL makeCreator(\"{$usernameIn}\", \"{$_SESSION['username']}\", \"{$creator}\",\"{$footager}\")";
    $queryOutput = $conn->query($SQLInput);
    $conn -> close();
    //For creating

    echo "<script type='text/javascript'>alert('Permissions set');</script>";
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
        <h1>UoD Give Co-Researcher Permissions</h1> <hr>
        <form action="" method="POST">
          <div class="form-group">
            <label for="CRUsername"> Select Co-Researcher you want to change the permissions of:</label><br>
            <?php
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
                    echo "<input type=\"radio\" id=\"{$row -> CRUsername}\" value=\"{$row -> CRUsername}\" name = \"CRUsername\"> <label for=\"{$row -> CRUsername}\">{$row -> CRUsername}</label><br>";
                }
              }else{
                echo "<h1>You currently don't have any co-researchers</h1>";
              }
             ?>
          </div>
          <div class="form-group">
            <label for="questionnaireNumIn"> Select the Questionnaire you want to change their access to:</label><br>
            <?php
              //Connect to server
              $conn = new mysqli("oaicontezoagile.mysql.db","oaicontezoagile","M5fgq184HDVu","oaicontezoagile");
              if ($conn -> connect_errno) {
                echo "<br>Failed to connect to MySQL: " . $conn -> connect_error;
                exit();
              }
              $SQLInput = "CALL getOwnQuestionnaires(\"{$_SESSION["username"]}\")";
              $queryOutput = $conn->query($SQLInput);

              if($queryOutput->num_rows > 0){
                while($row = $queryOutput->fetch_object()){
                    echo "<input type=\"radio\" id=\"{$row -> Identifier}\" value={$row -> Identifier} name = \"questionnaireNumIn\"> <label for=\"{$row -> Identifier}\">{$row -> Name}</label><br>";
                }
              }else{
                echo '<h1>You currently dont have admin access to any questionnaire</h1>';
              }
            ?>
          </div>
          <div class="form-group">
            <label for="Permissions"> Select the permissions you want the Co-Researcher to have for this questionnaire:</label><br>
            <input type="checkbox" id="view" name="view" value="true">
            <label for="view"> View the Results</label><br>
            <input type="checkbox" id="edit" name="edit" value="true">
            <label for="edit"> Edit</label><br>
            <input type="checkbox" id="delete" name="delete" value="true">
            <label for="delete"> Delete</label><br>
          </div>
          <div class="form-group">
            <label for="create"> Select the general permissions you want to grant them:</label><br>
            <input type="checkbox" id="create" name="create" value="true">
            <label for="create"> Create Questionnaires</label><br>
            <input type="checkbox" id="footage" name="footage" value="true">
            <label for="footage"> Review and Upload Video Footage</label><br>
          </div>
          <br>
          <button id="submitBtn"type="submit" class="btn btn-primary" name ="submitBtn">Assign Permissions</button>
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
