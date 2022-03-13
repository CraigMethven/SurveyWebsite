<?php
//Starts the session that's being used
  session_start();
  if($_SESSION["loggedIn"] != "true"){
    header('Location: http://oai-content.co.uk');
  }
  if($_SESSION["role"] != "Lab Manager" && $_SESSION["role"] != "PR" && $_SESSION["role"] != "CR"){
    header('Location: http://oai-content.co.uk/dashboard.php');
  }
?>

<?php
  //For downloading a CSV file of the results
  //Collect the questionnaire num they want the results to be printed of
  if(isset($_POST['submitBtn']) && isset($_POST['questionnaireNumIn']))
  {
    $questionnaireNumIn = $_POST['questionnaireNumIn'];

    //Connect to server
    $conn = new mysqli("oaicontezoagile.mysql.db","oaicontezoagile","M5fgq184HDVu","oaicontezoagile");
    if ($conn -> connect_errno) {
      echo "<br>Failed to connect to MySQL: " . $conn -> connect_error;
      exit();
    }

    //Run Query
    $SQLInput = "CALL getWantedCSVTable($questionnaireNumIn)";
    $queryOutput = $conn->query($SQLInput);
    //Add the query results to a file
    if($queryOutput->num_rows > 0){
      //Get title of file and create file using that title
      /*
      $SQLInput1 = "CALL getQuestionnaireTitle(1)";
      $queryResult = $conn->query($SQLInput1);
      $fileName = $queryResult->fetch_object()->Name;
      */
      $fileName = "resultsCSVTemp.csv";
      $csvfile = fopen("{$fileName}", "w") or die();
      while($row = $queryOutput->fetch_object()){
        fwrite($csvfile, "{$row -> Username}, {$row -> Question},{$row -> Answer}\n");
      }
      fclose($csvfile);

      //Download the file
      if (file_exists($fileName)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="'.basename($fileName).'"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($fileName));
        readfile($fileName);
      }
      unlink($fileName);
    }else{
      echo '<h1>0 results, something went wrong</h1>';
    }
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

   <title>UoD Download Results</title>
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

 <!-- html form -->
 <div class="loginSection">
   <div class="container">
     <div class="row">
       <div class="col-md-4 col-xs-1">
          <!--Something on left maybe-->
       </div>
       <div id="loginCol" class="col-md-4 col-xs-10">
         <h1>UoD Download Results</h1> <hr>
         <form action="" method="POST">
           <div class="form-group">
             <label for="username">Select the questionnaire you want to download the results of:</label>
             <br>
             <?php
               //Connect to server
               $conn = new mysqli("oaicontezoagile.mysql.db","oaicontezoagile","M5fgq184HDVu","oaicontezoagile");
               if ($conn -> connect_errno) {
                 echo "<br>Failed to connect to MySQL: " . $conn -> connect_error;
                 exit();
               }

               $queryOutput = 0;

               if($_SESSION["role"]=="CR"){
                 $SQLInput = "CALL getViewableQuestionnaires(\"{$_SESSION["username"]}\")";
                 $queryOutput = $conn->query($SQLInput);
               }
               else{
                 $SQLInput = "CALL getOwnQuestionnaires(\"{$_SESSION["username"]}\")";
                 $queryOutput = $conn->query($SQLInput);
               }

               if($queryOutput->num_rows > 0){
                 while($row = $queryOutput->fetch_object()){
                     echo "<input type=\"radio\" id=\"{$row -> Identifier}\" value={$row -> Identifier} name = \"questionnaireNumIn\"> <label for=\"{$row -> Identifier}\">{$row -> Name}</label><br>";
                 }
               }else{
                 echo 'You currently dont have viewing access to any questionnaire';
               }
             ?>
           </div>
           <button id="submitBtn"type="submit" class="btn btn-primary" name ="submitBtn">Download</button>
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
