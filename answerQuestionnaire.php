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
  <script type="text/javascript">
      $(window).on('load', function() {
          $('#myModal').modal('show');
      });
  </script>
  <title>UoD Answer Questionnaire</title>
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
<div class="modal show" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Before you start</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Thank you for the participating in this Questionnaire. Before you can begin please read through the University of Dundee ethics policy and our privacy policy. When you click agree you accept both agreements. Clicking disagree will redirect you to the Home page and you will no longer able to participate in the questionnaire. If you have any questions, please speak to the research who oversees the questionnaire.
        <ul class="nav nav-tabs">
          <li class="active"><a data-toggle="tab" href="#Ethics">UOD Ethics</a></li>
          <li><a data-toggle="tab" href="#privacy">Privacy Policy</a></li>
        </ul>
        <div class ="tab-content">
          <div id="Ethics" class="tab-pane fade in active">
            <h3>Ethics</h3>
            <h5>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec eu consectetur augue. In id dui nibh. Sed non tincidunt tortor, rutrum placerat lacus. Mauris lacinia rhoncus sagittis. Cras varius aliquet elementum. Quisque neque lacus, venenatis a elit non, egestas malesuada arcu. Proin sodales urna et lorem viverra dapibus. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Etiam dapibus, tortor vitae luctus congue, justo lectus pellentesque est, eu egestas nisl magna quis purus. Sed sollicitudin quam eget feugiat scelerisque. Aliquam erat volutpat. Integer ac nunc in dui finibus malesuada. Integer eget augue efficitur nibh pharetra imperdiet.

Aliquam erat volutpat. Ut ut arcu arcu. Cras non velit eu augue tincidunt feugiat. Pellentesque faucibus libero nec urna laoreet dapibus varius sed elit. Etiam quis fermentum orci, nec tincidunt felis. Morbi lobortis pellentesque neque in rhoncus. Nullam porta eleifend rutrum.

Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Phasellus et suscipit lacus. Praesent at lacus accumsan, condimentum turpis sed, auctor orci. Morbi nulla quam, venenatis sed libero sed, lacinia cursus lorem. Aliquam erat volutpat. Ut augue quam, tincidunt eget scelerisque ac, bibendum sed sapien. Maecenas a augue at metus hendrerit molestie. Fusce efficitur, nisi et placerat feugiat, est mi pharetra erat, id varius augue nulla id arcu. Donec vitae dui a libero accumsan gravida vel vel eros. Phasellus volutpat tellus sed augue varius condimentum. Sed porta aliquet tellus, a consequat neque rutrum at. In sit amet sapien eget purus aliquam pretium sed quis mi. Suspendisse consectetur imperdiet nunc ut lacinia. Praesent feugiat aliquet nisl et placerat. Nulla at purus nec enim euismod rhoncus sit amet non mauris. Nam sed viverra mi.

Vivamus lacinia vestibulum lectus id aliquam. In ligula sapien, convallis quis suscipit ut, interdum at tortor. Vestibulum elementum tellus at ligula luctus tincidunt. Etiam libero dui, consectetur sed ultrices at, varius at libero. Maecenas arcu nisl, rhoncus nec congue sed, tempor sed lacus. Nunc hendrerit lacus tellus, eu iaculis sem tincidunt sed. Sed gravida tristique arcu quis convallis. Vivamus facilisis nunc ac erat posuere, id cursus nunc tincidunt. Sed eu tempor nisl, vel porttitor enim. Mauris mauris dui, iaculis sed arcu ut, vulputate placerat ante. Aenean viverra ac ante in blandit. Nullam a leo metus. Mauris vehicula massa quis orci faucibus, ut vestibulum magna molestie. Aliquam varius sapien id est imperdiet, eu lacinia ex rutrum.

Proin ultrices dui quis faucibus euismod. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nunc tempor sem et condimentum mollis. Suspendisse vel libero non erat consectetur maximus at vel nunc. Fusce sagittis egestas lectus, non dignissim lectus ullamcorper et. Mauris molestie ultricies ipsum, nec volutpat libero lobortis nec. Sed fermentum dapibus maximus. Duis metus dolor, pulvinar mattis sollicitudin non, consectetur eget ipsum. Integer dictum interdum tempus. Nulla sagittis, libero a efficitur placerat, mauris nibh mattis purus, a fringilla dolor libero semper ipsum. Morbi quis pretium urna, vitae dapibus ligula.

Aliquam volutpat in neque a suscipit. Interdum et malesuada fames ac ante ipsum primis in faucibus. Vivamus vulputate condimentum erat vel imperdiet. Integer sit amet placerat urna. Praesent consequat posuere ipsum a vestibulum. Suspendisse ultricies arcu quis libero iaculis, sed venenatis sapien tincidunt. Aliquam hendrerit nisi et semper convallis. Nullam gravida elementum porttitor. Nam tincidunt turpis vel diam accumsan consequat. Fusce sodales leo ante, id accumsan dolor bibendum at. Suspendisse eget suscipit justo. Nulla sit amet turpis ultricies mauris consectetur ullamcorper. Pellentesque in sapien orci. Aliquam tincidunt ipsum sem, et rhoncus urna venenatis ut.

Sed mattis libero eget consequat vulputate. Sed semper, sem nec consectetur mollis, nulla lectus viverra felis, non dictum nulla justo ac elit. Integer non ante vestibulum, sagittis lectus et, sollicitudin purus. Duis eu dolor tellus. Morbi ipsum lectus, efficitur non efficitur sed, lacinia vel enim. Fusce dignissim hendrerit felis, eget elementum sem luctus at. Sed condimentum semper ipsum in aliquet. Fusce sit amet aliquet libero. Donec cursus, turpis in vestibulum molestie, elit diam lobortis eros, ut laoreet felis ipsum sed sem. Nullam blandit diam sit amet consequat scelerisque. Quisque lacinia tincidunt finibus. Morbi eu suscipit arcu, in molestie ex. Aliquam erat volutpat. Vestibulum tincidunt ligula eu urna sollicitudin, at auctor risus sagittis.

Aliquam erat volutpat. Vestibulum mollis sagittis metus non tincidunt. Aliquam erat volutpat. Integer tristique ornare leo, id molestie sapien commodo in. Proin eleifend augue mi, eu euismod ex porttitor vel. Donec quis nibh elit. Curabitur varius pellentesque ornare. Etiam elementum magna in posuere dignissim. Maecenas pretium massa non justo mollis laoreet.

Cras in elit eros. Suspendisse semper vehicula odio ac hendrerit. Integer non malesuada risus. In cursus varius tellus, eget finibus sapien commodo sed. Vivamus iaculis purus id gravida ullamcorper. Etiam consectetur dolor non arcu consectetur, nec mollis metus finibus. Maecenas aliquam velit lacus, ut interdum leo feugiat vel. Aliquam suscipit ultrices lectus, at ornare lorem elementum ac.

Nullam sit amet malesuada turpis, ac elementum dolor. Aliquam placerat sit amet magna vel eleifend. Vestibulum aliquet malesuada sem ac convallis. In viverra dolor eu diam porta placerat. Morbi ipsum ante, imperdiet ut eros ac, bibendum dignissim est. Aliquam aliquam orci sit amet dolor efficitur, a euismod mi tristique. Etiam vitae tincidunt quam, quis interdum lacus. Duis ac orci dignissim dolor pellentesque gravida sed quis justo. Fusce volutpat neque velit, et convallis elit commodo ac. Nam non vehicula nisi. Cras sit amet risus tellus. Interdum et malesuada fames ac ante ipsum primis in faucibus. Donec a ultricies ipsum. Vestibulum rhoncus dolor ut urna viverra, sit amet rutrum quam ultrices. Cras cursus, diam eu feugiat pretium, ligula purus commodo diam, id efficitur elit eros id lorem. Donec blandit imperdiet molestie.</h5>
          </div>
          <div id="privacy" class="tab-pane fade">
            <h3>Privacy Policy</h3>
            <h5>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec eu consectetur augue. In id dui nibh. Sed non tincidunt tortor, rutrum placerat lacus. Mauris lacinia rhoncus sagittis. Cras varius aliquet elementum. Quisque neque lacus, venenatis a elit non, egestas malesuada arcu. Proin sodales urna et lorem viverra dapibus. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Etiam dapibus, tortor vitae luctus congue, justo lectus pellentesque est, eu egestas nisl magna quis purus. Sed sollicitudin quam eget feugiat scelerisque. Aliquam erat volutpat. Integer ac nunc in dui finibus malesuada. Integer eget augue efficitur nibh pharetra imperdiet.

Aliquam erat volutpat. Ut ut arcu arcu. Cras non velit eu augue tincidunt feugiat. Pellentesque faucibus libero nec urna laoreet dapibus varius sed elit. Etiam quis fermentum orci, nec tincidunt felis. Morbi lobortis pellentesque neque in rhoncus. Nullam porta eleifend rutrum.

Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Phasellus et suscipit lacus. Praesent at lacus accumsan, condimentum turpis sed, auctor orci. Morbi nulla quam, venenatis sed libero sed, lacinia cursus lorem. Aliquam erat volutpat. Ut augue quam, tincidunt eget scelerisque ac, bibendum sed sapien. Maecenas a augue at metus hendrerit molestie. Fusce efficitur, nisi et placerat feugiat, est mi pharetra erat, id varius augue nulla id arcu. Donec vitae dui a libero accumsan gravida vel vel eros. Phasellus volutpat tellus sed augue varius condimentum. Sed porta aliquet tellus, a consequat neque rutrum at. In sit amet sapien eget purus aliquam pretium sed quis mi. Suspendisse consectetur imperdiet nunc ut lacinia. Praesent feugiat aliquet nisl et placerat. Nulla at purus nec enim euismod rhoncus sit amet non mauris. Nam sed viverra mi.

Vivamus lacinia vestibulum lectus id aliquam. In ligula sapien, convallis quis suscipit ut, interdum at tortor. Vestibulum elementum tellus at ligula luctus tincidunt. Etiam libero dui, consectetur sed ultrices at, varius at libero. Maecenas arcu nisl, rhoncus nec congue sed, tempor sed lacus. Nunc hendrerit lacus tellus, eu iaculis sem tincidunt sed. Sed gravida tristique arcu quis convallis. Vivamus facilisis nunc ac erat posuere, id cursus nunc tincidunt. Sed eu tempor nisl, vel porttitor enim. Mauris mauris dui, iaculis sed arcu ut, vulputate placerat ante. Aenean viverra ac ante in blandit. Nullam a leo metus. Mauris vehicula massa quis orci faucibus, ut vestibulum magna molestie. Aliquam varius sapien id est imperdiet, eu lacinia ex rutrum.

Proin ultrices dui quis faucibus euismod. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nunc tempor sem et condimentum mollis. Suspendisse vel libero non erat consectetur maximus at vel nunc. Fusce sagittis egestas lectus, non dignissim lectus ullamcorper et. Mauris molestie ultricies ipsum, nec volutpat libero lobortis nec. Sed fermentum dapibus maximus. Duis metus dolor, pulvinar mattis sollicitudin non, consectetur eget ipsum. Integer dictum interdum tempus. Nulla sagittis, libero a efficitur placerat, mauris nibh mattis purus, a fringilla dolor libero semper ipsum. Morbi quis pretium urna, vitae dapibus ligula.

Aliquam volutpat in neque a suscipit. Interdum et malesuada fames ac ante ipsum primis in faucibus. Vivamus vulputate condimentum erat vel imperdiet. Integer sit amet placerat urna. Praesent consequat posuere ipsum a vestibulum. Suspendisse ultricies arcu quis libero iaculis, sed venenatis sapien tincidunt. Aliquam hendrerit nisi et semper convallis. Nullam gravida elementum porttitor. Nam tincidunt turpis vel diam accumsan consequat. Fusce sodales leo ante, id accumsan dolor bibendum at. Suspendisse eget suscipit justo. Nulla sit amet turpis ultricies mauris consectetur ullamcorper. Pellentesque in sapien orci. Aliquam tincidunt ipsum sem, et rhoncus urna venenatis ut.

Sed mattis libero eget consequat vulputate. Sed semper, sem nec consectetur mollis, nulla lectus viverra felis, non dictum nulla justo ac elit. Integer non ante vestibulum, sagittis lectus et, sollicitudin purus. Duis eu dolor tellus. Morbi ipsum lectus, efficitur non efficitur sed, lacinia vel enim. Fusce dignissim hendrerit felis, eget elementum sem luctus at. Sed condimentum semper ipsum in aliquet. Fusce sit amet aliquet libero. Donec cursus, turpis in vestibulum molestie, elit diam lobortis eros, ut laoreet felis ipsum sed sem. Nullam blandit diam sit amet consequat scelerisque. Quisque lacinia tincidunt finibus. Morbi eu suscipit arcu, in molestie ex. Aliquam erat volutpat. Vestibulum tincidunt ligula eu urna sollicitudin, at auctor risus sagittis.

Aliquam erat volutpat. Vestibulum mollis sagittis metus non tincidunt. Aliquam erat volutpat. Integer tristique ornare leo, id molestie sapien commodo in. Proin eleifend augue mi, eu euismod ex porttitor vel. Donec quis nibh elit. Curabitur varius pellentesque ornare. Etiam elementum magna in posuere dignissim. Maecenas pretium massa non justo mollis laoreet.

Cras in elit eros. Suspendisse semper vehicula odio ac hendrerit. Integer non malesuada risus. In cursus varius tellus, eget finibus sapien commodo sed. Vivamus iaculis purus id gravida ullamcorper. Etiam consectetur dolor non arcu consectetur, nec mollis metus finibus. Maecenas aliquam velit lacus, ut interdum leo feugiat vel. Aliquam suscipit ultrices lectus, at ornare lorem elementum ac.

Nullam sit amet malesuada turpis, ac elementum dolor. Aliquam placerat sit amet magna vel eleifend. Vestibulum aliquet malesuada sem ac convallis. In viverra dolor eu diam porta placerat. Morbi ipsum ante, imperdiet ut eros ac, bibendum dignissim est. Aliquam aliquam orci sit amet dolor efficitur, a euismod mi tristique. Etiam vitae tincidunt quam, quis interdum lacus. Duis ac orci dignissim dolor pellentesque gravida sed quis justo. Fusce volutpat neque velit, et convallis elit commodo ac. Nam non vehicula nisi. Cras sit amet risus tellus. Interdum et malesuada fames ac ante ipsum primis in faucibus. Donec a ultricies ipsum. Vestibulum rhoncus dolor ut urna viverra, sit amet rutrum quam ultrices. Cras cursus, diam eu feugiat pretium, ligula purus commodo diam, id efficitur elit eros id lorem. Donec blandit imperdiet molestie.</h5>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" input type ="button" id="agree" class="btn btn-primary" data-dismiss="modal">Agree</button>
        <a href="http://oai-content.co.uk/"<button type="button" class="btn btn-secondary" role="button">Disagree</a>
      </div>
    </div>
    </div>
    </div>
  </div>
<!-- nav bar -->

      <div class="clearfix"></div>
</div>
  <div class="loginSection">
    <div class="container">
      <div class="row">
        <div class="col-md-4 col-xs-1">
           <!--Something on left maybe-->
        </div>
        <div id="loginCol" class="col-md-4 col-xs-10">
          <h1>
            <?php
            $_SESSION['nameIn'] = $_POST['name'];
            $nameIn = $_SESSION['nameIn'];

            //Connect to database
            $conn = new mysqli("oaicontezoagile.mysql.db","oaicontezoagile","M5fgq184HDVu","oaicontezoagile");
            if ($conn -> connect_errno) {
              echo "<br>Failed to connect to MySQL: " . $conn -> connect_error;
              exit();
            }
            //Run Query
           $SQLInput = "Call getQuestionnaireTitle(\"$nameIn\")";
           $queryOutput = $conn->query($SQLInput);
           //Output Results of query
           echo $queryOutput->fetch_object()->Name;
           $conn -> close();
           ?>
        </h1> <hr>
          <form action="/submitQuestionnaire.php" method="POST">

            <?php
              $idIn = $_POST['name'];
              //Connect to database
              $conn = new mysqli("oaicontezoagile.mysql.db","oaicontezoagile","M5fgq184HDVu","oaicontezoagile");
              if ($conn -> connect_errno) {
                echo "<br>Failed to connect to MySQL: " . $conn -> connect_error;
                exit();
              }
              $SQLInput = "Call getQuestionnairesQuestions(\"$idIn\")";
              $queryOutput = $conn->query($SQLInput);
              $conn -> close();

              if($queryOutput->num_rows > 0){
                while($row = $queryOutput->fetch_object()){
                  echo "<div class=\"form-group\">";
                  echo "<label for=\"{$row->Identifier}\">{$row->Question}</label>";

                  if($row->Type == "Text"){
                    echo "<input type=\"text\" class=\"form-control\" placeholder=\"Type Here\" id=\"{$row->Identifier}\" name = \"{$row->Identifier}\"><br><br>";
                  }

                  if($row->Type == "Likert"){
                    echo "<table style=\"width:100%; word-wrap: break-word\"><tr>";
                    echo "<td style=\"width:20%\"> <input type=\"radio\" id=\"StrongDisagree\" value=\"Strongly Disagree\" name = \"{$row -> Identifier}\"> <label for=\"StrongDisagree\">Strongly Disagree</label></th>";
                    echo "<td style=\"width:20%\"> <input type=\"radio\" id=\"Disagree\" value=\"Disagree\" name = \"{$row -> Identifier}\"> <label for=\"Disagree\">Disagree</label></th>";
                    echo "<td style=\"width:20%\"> <input type=\"radio\" id=\"Neutral\" value=\"Neutral\" name = \"{$row -> Identifier}\"> <label for=\"Neutral\">Neutral</label></th>";
                    echo "<td style=\"width:20%\"> <input type=\"radio\" id=\"Agree\" value=\"Agree\" name = \"{$row -> Identifier}\"> <label for=\"Agree\">Agree</label></th>";
                    echo "<td style=\"width:20%\"> <input type=\"radio\" id=\"StrongAgree\" value=\"Strongly Agree\" name = \"{$row -> Identifier}\"> <label for=\"StrongAgree\">Strongly Agree</label></th>";
                    echo "</tr></table>";
                  }

                  if($row->Type == "Multiple Choice" || $row->Type == "MC"){
                    echo "<br>";
                    //Connect to database
                    $conn = new mysqli("oaicontezoagile.mysql.db","oaicontezoagile","M5fgq184HDVu","oaicontezoagile");
                    if ($conn -> connect_errno) {
                      echo "<br>Failed to connect to MySQL: " . $conn -> connect_error;
                      exit();
                    }
                    $MultipleChoiceSQLInput = "Call FindQuestionAnswers(\"{$row->Identifier}\")";
                    $MultipleChoiceQueryOutput = $conn->query($MultipleChoiceSQLInput);
                    $conn -> close();
                    if($MultipleChoiceQueryOutput == 0){
                      echo "<br>Query Unsuccessful. ";
                    }

                    if($MultipleChoiceQueryOutput->num_rows > 0){
                      while($MultipleChoiceRow = $MultipleChoiceQueryOutput->fetch_object()){
                        echo "<input type=\"radio\" id=\"{$MultipleChoiceRow -> Identifier}\" value={$MultipleChoiceRow -> Answer} name = \"{$row -> Identifier}\"> <label for=\"{$MultipleChoiceRow -> Identifier}\">{$MultipleChoiceRow -> Answer}</label><br>";
                      }
                    }else{
                      echo "No multiple choice answers were found";}
                    }
                  echo "</div>";
                }
              }else{
                echo '<h1>This questionnaire doesnt have any questions</h1>';
              }
            ?>
            <br><br>
            <button id="submitBtn"type="submit" class="btn btn-primary">Submit</button>
          </form>
        </div>
        <div class="col-md-4 col-xs-1">
          <!--Something on right maybe-->
        </div>
      </div>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>






<?php
/*
//The PHP for the form input
  if(isset($_POST['submitBtn']) && isset($_POST['name']))
  {
    $name = $_POST["name"];
    //Connect to server
    $conn = new mysqli("oaicontezoagile.mysql.db","oaicontezoagile","M5fgq184HDVu","oaicontezoagile");
    if ($conn -> connect_errno) {
      echo "<br>Failed to connect to MySQL: " . $conn -> connect_error;
      exit();
    }

    $SQLInput = "CALL DeleteUser(\"{$usernameIn}\")";
    $queryOutput = $conn->query($SQLInput);

    //Check if query ran
    if($queryOutput == true){
      echo "<script type='text/javascript'>alert('Delete Successfully');</script>";
      die();
    }
    echo "<script type='text/javascript'>alert('Delete Failed');</script>";
  }
  */
?>
