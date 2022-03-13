<?php

session_start();
if ($_SESSION["loggedIn"] != "true") {
    header('Location: http://oai-content.co.uk');
}

?>

<!DOCTYPE html>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script type="text/javascript" src="./script.js"></script>
    <script type="text/javascript" src="file.js"></script>
    <title>UoD Questionaire Creator</title>
  </head>
  <body id="bodyQuestion">
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
                                echo $_SESSION["username"] . " (" . $_SESSION["role"] . ")";
                              ?>
                            </a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="clearfix"></div>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-md-12 text-center">
          <div class="card">
            <p style="text-align:center;"> This questionaire has been added to the database. Please wait whilst you are redirected to the Dashboard</p>
          </div>
        </div>
      </div>
    </div>
<strong>

<?php
   if (isset($_POST['submit'])){
     $questionnaireNum = 0;
     $questionID = 0;

     //For each input
      foreach ( $_POST as $key => $value ) {
        //echo "Key: {$key}, Value: {$value}<br>";
        if($key == "submit"){
          continue;
        }

        //Split the key
        $splitKey = explode("_", $key);

        //If to be ignored then ignore it
        if($splitKey[0] == "ignore"){
          //echo "<br>ignored {$key}<br>";
          continue;
        }

        //If the title is being inserted then create the questionnaire and set $questionnaireNum variable
        if($splitKey[0] == "questionnaireTitle"){
          //echo "<br>trying to create questionnaire {$value}";
          $questionnaireTitle = $value;

          //Create questionnaire
          //Connect to database
          $conn = new mysqli("oaicontezoagile.mysql.db","oaicontezoagile","M5fgq184HDVu","oaicontezoagile");
          if ($conn -> connect_errno) {
            echo "<br>Failed to connect to MySQL: " . $conn -> connect_error;
            exit();
          }
          $query = "CALL CreateNewQuestionnaire(\"$value\")";
          $queryOutput = $conn->query($query);
          $conn->close();

          //get questionnaire ID
          //Connect to database
          $conn = new mysqli("oaicontezoagile.mysql.db","oaicontezoagile","M5fgq184HDVu","oaicontezoagile");
          if ($conn -> connect_errno) {
            echo "<br>Failed to connect to MySQL: " . $conn -> connect_error;
            exit();
          }
          $query = "CALL getQuestionnaireIDFromName(\"$value\")";
          $queryOutput = $conn->query($query);
          $questionnaireNum = $queryOutput -> fetch_object() -> Identifier;
          $conn->close();

          //echo "<br>Setting Questionnaire ID to {$questionnaireNum}";

          //Setting this user as the host of this questionnaire
          //Connect to database
          $conn = new mysqli("oaicontezoagile.mysql.db","oaicontezoagile","M5fgq184HDVu","oaicontezoagile");
          if ($conn -> connect_errno) {
            echo "<br>Failed to connect to MySQL: " . $conn -> connect_error;
            exit();
          }
          $query = "CALL addQuestionnaireParticipant(\"{$_SESSION['username']}\",\"{$questionnaireNum}\", \"1\")";
          $queryOutput = $conn->query($query);
          $conn->close();

          continue;
        }

        //If there is a title of a question then create that question and get it's ID saved to $questionID
        if($splitKey[1] == "QTitle"){
          //echo "<br>trying to create question {$value}";
          $type = $splitKey[2];

          //Connect to database
          $conn = new mysqli("oaicontezoagile.mysql.db","oaicontezoagile","M5fgq184HDVu","oaicontezoagile");
          if ($conn -> connect_errno) {
            echo "<br>Failed to connect to MySQL: " . $conn -> connect_error;
            exit();
          }
          $query = "CALL CreateQuestion(\"$questionnaireNum\", \"{$value}\" ,\"{$type}\")";
          $queryOutput = $conn->query($query);
          $conn->close();

          //If multiple choice then save the question ID
          if($type == "MC"){
            //Connect to database
            $conn = new mysqli("oaicontezoagile.mysql.db","oaicontezoagile","M5fgq184HDVu","oaicontezoagile");
            if ($conn -> connect_errno) {
              echo "<br>Failed to connect to MySQL: " . $conn -> connect_error;
              exit();
            }
            $query = "CALL getQuestionID(\"{$value}\",\"$questionnaireNum\")";
            $queryOutput = $conn->query($query);
            $questionID = $queryOutput -> fetch_object() -> Identifier;
            $conn->close();
            //echo "<br>Setting Question ID to {$questionID}";
          }
          continue;
        }

        //If it's a Multiple choice answer add it to the database
        if($splitKey[1] == "MCAnswer"){
          //echo "<br>trying to create MC answer {$value}";
          //Connect to database
          $conn = new mysqli("oaicontezoagile.mysql.db","oaicontezoagile","M5fgq184HDVu","oaicontezoagile");
          if ($conn -> connect_errno) {
            echo "<br>Failed to connect to MySQL: " . $conn -> connect_error;
            exit();
          }
          $query = "CALL CreateMultipleChoiceAnswer(\"$questionID\", \"{$value}\")";
          $queryOutput = $conn->query($query);
          $conn->close();
        }

      }
    }
 ?>

</strong>
  </body>
</html>
