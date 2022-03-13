<?php
//Starts the session that's being used
  session_start();
  if($_SESSION["loggedIn"] != "true"){
    header('Location: http://oai-content.co.uk');
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

  <title>UoD Submit Questionnaire</title>
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

    <div class="container">
      <h1>Thank you for taking part in the questionnaire </h1>
      <br><hr><br><h2>
      <!-- Uploading results -->
      <?php
        /*
        foreach ($_POST as $key => $value) {
          echo "Field ".htmlspecialchars($key)." is ".htmlspecialchars($value)."<br>";
        }
        */
        $allWorked = 0;

        foreach ($_POST as $questionID => $answerIn) {
          //Connect to database
          $conn = new mysqli("oaicontezoagile.mysql.db","oaicontezoagile","M5fgq184HDVu","oaicontezoagile");
          if ($conn -> connect_errno) {
            echo "<br>Failed to connect to MySQL: " . $conn -> connect_error;
            exit();
          }

          //Insert the data into the database
          $SQLInput = "CALL CreateResponse(\"{$_SESSION['username']}\", \"{$questionID}\", \"{$answerIn}\")";
          $queryOutput = $conn->query($SQLInput);

          //Check it worked
          if($queryOutput == 0){
            echo "Query Unsuccessful";
            $allWorked = 1;
          }

          $conn ->close();
        }

        if($allWorked == 1){
          echo "There was a problem with storing your results";
        }else{
          echo "All your results were successfully stored";

          //Connect to database
          $conn = new mysqli("oaicontezoagile.mysql.db","oaicontezoagile","M5fgq184HDVu","oaicontezoagile");
          if ($conn -> connect_errno) {
            echo "<br>Failed to connect to MySQL: " . $conn -> connect_error;
            exit();
          }

          $SQLInput = "CALL getQuestionnaireIDFromQuestion(\"{$questionID}\")";
          $queryOutput = $conn->query($SQLInput);

          $conn -> close();

          $questionnaireNum = $queryOutput -> fetch_object() -> QuestionnaireNum;

          //Connect to database
          $conn = new mysqli("oaicontezoagile.mysql.db","oaicontezoagile","M5fgq184HDVu","oaicontezoagile");
          if ($conn -> connect_errno) {
            echo "<br>Failed to connect to MySQL: " . $conn -> connect_error;
            exit();
          }

          $SQLInput = "CALL markCompletedQuestionnaire(\"{$_SESSION['username']}\", \"{$questionnaireNum}\")";
          $queryOutput = $conn->query($SQLInput);
        }
      ?>
      <!-- Uploading results -->
      <br><a href="http://oai-content.co.uk/dashboard.php"> Click here to return to the dashboard </a>
    </h2></div>


<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</head>
</html>
