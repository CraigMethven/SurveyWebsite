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

  <title>UoD Dashboard</title>
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
                              echo $_SESSION["username"] . " (" . $_SESSION["role"] . ")";
                            ?>
                          </a></li>
                      </ul>
                  </div>
              </div>
          </div>
      </div>
      <!-- nav bar -->

      <div class="clearfix"></div>
  </div>
  <div class="container">
    <h1 align="left"> Dashboard </h1>
    <hr>
  </div>
  <?php
    function createBlock($theLink, $theTitle, $theSubtitle){
      echo "<div class=\"column\">";
      echo "<h2><a href=$theLink> $theTitle </a></h2>";
      echo "<br> $theSubtitle";
      echo "<br></div>";
    }

    //What the lab manager can do
    if($_SESSION["role"] == "Lab Manager"){
      echo "<div class=\"container\"><div class=\"row\">";
      createBlock("http://oai-content.co.uk/createUser.php", "Create User", "Make a new user for this system!");
      createBlock("http://oai-content.co.uk/updateUserDetails.php", "Edit User Details", "Edit the role or the password of a user.");
      createBlock("http://oai-content.co.uk/deleteUser.php", "Remove User", "Remove a user, hense making them not be able to access this site.");
      echo "</div><br><hr><br></div>";
    }
    //What the PR can do
    if($_SESSION["role"] == "PR" || $_SESSION["role"] == "Lab Manager"){
      echo "<div class=\"container\"><div class=\"row\">";
      createBlock("http://oai-content.co.uk/getCR.php", "Assign Co-Researcher", "Get a new Co-Reseacher? Tell the system this here!");
      createBlock("http://oai-content.co.uk/giveCRPermissions.php", "Co-Researcher Permissions", "Manage your Co-Researchers permissions here!");
      createBlock("http://oai-content.co.uk/removeCR.php", "Remove Co-Researcher", "Lose a co-researcher? Remove their permissions here");
      echo "</div><br><hr><br></div>";
    }

    //What the CR can do
    if($_SESSION["role"] == "CR" || $_SESSION["role"] == "PR" || $_SESSION["role"] == "Lab Manager"){
      echo "<div class=\"container\"><div class=\"row\">";
      createBlock("http://oai-content.co.uk/resultsCSV.php", "Download Results", "Download the results of the wonderful questionnaires you've created!");
      createBlock("http://oai-content.co.uk/selectGraph.php", "Graph Results", "See the results of the multiple choice or likert questions from your questionnaires as graphs");
      createBlock("http://oai-content.co.uk/QuestionaireCreator", "Create Questionnaire", "Create a questionnaire and allow other users to answer it!");
      echo "</div><br><hr><br></div>";
      echo "<div class=\"container\"><div class=\"row\">";
      //createBlock("#", "Edit Questionnaire", "Make a mistake in a questionnaire? Click here to edit them!");
      createBlock("http://oai-content.co.uk/deleteQuestionaire.php", "Delete Questionnaire", "Delete a questionnaire that you no longer need");
      createBlock("http://oai-content.co.uk/uploadVideo.php", "Upload Video", "Need a video uploaded for your project? Do it here!");
      createBlock("http://oai-content.co.uk/selectVideos.php", "View Videos", "View and Timestamp your videos here.");
      echo "</div><br><hr><br></div>";
    }

    echo "<div class=\"container\"><div class=\"row\">";
    //What everyone can do
    createBlock("http://oai-content.co.uk/selectQuestionnaire.php", "Answer Questionnaire", "Answer any of the questionnaires you have access to.");
    echo "</div><br><hr><br></div>";
  ?>
  </body>
</head>
</html>
