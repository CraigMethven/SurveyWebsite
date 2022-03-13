<html>
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

  <title>UoD Draw Graph</title>

  <script>
    window.onload = function() {
      <?php
        function createChart($title, $dataPoints, $counter){
          echo "\nvar variable{$counter} = new CanvasJS.Chart(\"{$title}\", {animationEnabled: true, title: { text: \"\"},data: [{type: \"pie\",yValueFormatString: \"#,##0.00\\\"%\\\"\",indexLabel: \"{label} ({y})\", dataPoints: ";
          echo json_encode($dataPoints, JSON_NUMERIC_CHECK);
          echo "}]});\n";
          echo "variable{$counter}.render();";
        }

        $questionnaireID = $_POST['questionnaireNumIn'];

        $conn = new mysqli("oaicontezoagile.mysql.db","oaicontezoagile","M5fgq184HDVu","oaicontezoagile");
        if ($conn -> connect_errno) {
          echo "<br>Failed to connect to MySQL: " . $conn -> connect_error;
          exit();
        }

        $SQLInput = "CALL getMCQuestions(\"{$questionnaireID}\")";
        $queryOutput = $conn->query($SQLInput);
        $conn -> close();
        $counter = 0;
        while($entireRow = $queryOutput -> fetch_object()){
          $dataPoints = array();
          $questionNum = $entireRow -> Identifier;
          //Connect to server
          $conn = new mysqli("oaicontezoagile.mysql.db","oaicontezoagile","M5fgq184HDVu","oaicontezoagile");
          if ($conn -> connect_errno) {
            echo "<br>Failed to connect to MySQL: " . $conn -> connect_error;
            exit();
          }

          $SQLInput = "CALL countQuestionResponses(\"{$questionNum}\")";
          $queryOutput1 = $conn->query($SQLInput);
          $numberOfResponses = $queryOutput1 -> fetch_object() -> numResponse;
          $conn -> close();

          //Connect to server
          $conn = new mysqli("oaicontezoagile.mysql.db","oaicontezoagile","M5fgq184HDVu","oaicontezoagile");
          if ($conn -> connect_errno) {
            echo "<br>Failed to connect to MySQL: " . $conn -> connect_error;
            exit();
          }

          $SQLInput = "CALL countAnswers(\"{$questionNum}\")";
          $queryOutput1 = $conn->query($SQLInput);
          while($row = $queryOutput1 -> fetch_object()){
            array_push($dataPoints, array("label"=> $row -> Answer, "y"=> (($row -> numResponses) / $numberOfResponses) * 100));
          }
          $conn -> close();
          createChart($entireRow -> Question, $dataPoints, $counter);
          $counter = $counter + 1;
        }
      ?>
    }
  </script>

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
<!-- the graph -->
  <div class="container">
    <?php
      $counter = 0;
      $conn = new mysqli("oaicontezoagile.mysql.db","oaicontezoagile","M5fgq184HDVu","oaicontezoagile");
      if ($conn -> connect_errno) {
        echo "<br>Failed to connect to MySQL: " . $conn -> connect_error;
        exit();
      }

      $SQLInput = "CALL getMCQuestions(\"{$questionnaireID}\")";
      $queryOutput = $conn->query($SQLInput);
      $conn -> close();
      if($queryOutput->num_rows > 0){
        while($entireRow = $queryOutput -> fetch_object()){
          echo "<h1> {$entireRow->Question} </h1>";
          echo "<div id=\"{$entireRow -> Question}\" style=\"height: 370px; width: 100%;\"></div><hr>";
        }
      }else{
        echo "<h1> This questionnaire doesn't have any multiple choice questions";
        echo "<br><a href=\"http://oai-content.co.uk/selectGraph.php\">Click here to select a different questionnaire</a></h1>";
      }
    ?>
  </div>
<!-- the graph -->
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>
