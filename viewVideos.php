<!doctype html>
<html lang="en">

</html>
<?php
//Starts the session that's being used
  session_start();
  if ($_SESSION["loggedIn"] != "true") {
      header('Location: http://oai-content.co.uk');
  }
?>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

  <title>View videos</title>

  <script>
    var videos = []; //array of the current videos
    var play = false; //boolean

    //starts/stops all videos playing
    function startStopVideo(){
      play = !play;
      if (play){
        for (i = 0; i < videos.length; i++){
          document.getElementById(videos[i]).play();
        }
      }else{
        for (i = 0; i < videos.length; i++){
          document.getElementById(videos[i]).pause();
        }
      }
    }

    function addToVideosArray(tempInput){
      videos.push(tempInput);
    }

    //video sync functions
    var currentTimes = [];
    var timeDifference = [];

    function saveSync(){

      synched = !synched;

      //get current times
      for (i = 0; i < videos.length; i++){
        push.currentTimes(videos[i].currentTime);
      }

      //take the first video time and store the other two's difference
      for (i = 1; i < videos.length; i++){
        push.timeDifference(currentTimes[i] - currentTimes[0]);
      }

    }

    function syncVideos(){
      for (i = 1; i < videos.length; i++){
        videos[i].currentTime=(videos[0] + timeDifference[i-1]);
      }
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
                            echo $_SESSION["username"] . " (" . $_SESSION["role"] . ")";
                          ?>
                        </a>
                      </ul>
                  </div>
              </div>
          </div>
      </div>


      <div class="clearfix"></div>
</div>

<!-- nav bar -->
<h1 class="title">Video Viewer</h1> <hr>

<div class = "row">
<!-- Select what videos you wnat to see -->
  <?php
    if(isset($_POST['submitBtn']))
    {
      $counter = 0;
      $videosLocations = array();
      $videosID = array();
      foreach ($_POST as $key => $value) {
        if($key != "submitBtn"){
          $videoID = $value;
          //Connect to database
          $conn = new mysqli("oaicontezoagile.mysql.db","oaicontezoagile","M5fgq184HDVu","oaicontezoagile");
          if ($conn -> connect_errno) {
            echo "<br>Failed to connect to MySQL: " . $conn -> connect_error;
            exit();
          }

          //Insert the data into the database
          $SQLInput = "CALL getVideoFromID(\"{$value}\")";
          $queryOutput = $conn->query($SQLInput);
          $conn -> close();

          $row = $queryOutput ->fetch_object();

          $videoID = $row->name;

          echo "<div class=\"column\" align=\"center\"><div style='float: center; margin-right: 5px; margin-left: 5px;'>
             <video id=\"{$counter}{$row -> name}\" src='/{$row -> location}' controls width='800px' height='450px' ></video>
             <br>
             <span>{$row -> name}</span>
          </div></div>";
          echo "<script type=\"text/javascript\">"," addToVideosArray(\"{$counter}{$row -> name}\");","</script>";

          array_push($videosLocations, $row -> location);
          array_push($videosID, $row->name);
          $counter = $counter + 1;
        }
      }
      $_SESSION['videoLocations'] = $videosLocations;
      $_SESSION['videoNames'] = $videosID;
    }
    else{
      $locationsArray = $_SESSION['videoLocations'];
      $IDArray = $_SESSION['videoNames'];
      $arrayLength = count($locationsArray);
      for($i=0;$i<$arrayLength;$i++){
        echo "<div class=\"column\" align=\"center\"><div style='float: center; margin-right: 5px; margin-left: 5px;'>
           <video id=\"{$i}{$IDArray[$i]}\" src='/{$locationsArray[$i]}' controls width='800px' height='450px' ></video>
           <br>
           <span>{$IDArray[$i]}</span>
        </div></div>";
        echo "<script type=\"text/javascript\">"," addToVideosArray(\"{$i}{$IDArray[$i]}\");","</script>";
        $videoID = $IDArray[$i];
      }
    }
  ?>
</div>

<?php
//The PHP for the form input
  if(isset($_POST['TSBtn']))
  {
    //Take inputs
    $TSText = $_POST["textIn"];
    $tags = $_POST["tagsIn"];
    $supers = $_POST["superIn"];

    //Creating timestamp
    //Connect to server
    $conn = new mysqli("oaicontezoagile.mysql.db","oaicontezoagile","M5fgq184HDVu","oaicontezoagile");
    if ($conn -> connect_errno) {
      echo "<br>Failed to connect to MySQL: " . $conn -> connect_error;
      exit();
    }
    //Create call statement and run it
    $SQLInput = "CALL addTimestamp(\"{$videoID}\", \"{$TSText}\")";
    $queryOutput = $conn->query($SQLInput);
    $conn -> close();
    //!Creating timestamp

    //Find timestampID
    //Connect to server
    $conn = new mysqli("oaicontezoagile.mysql.db","oaicontezoagile","M5fgq184HDVu","oaicontezoagile");
    if ($conn -> connect_errno) {
      echo "<br>Failed to connect to MySQL: " . $conn -> connect_error;
      exit();
    }
    //Create call statement and run it
    $SQLInput = "CALL getTimestampID(\"{$videoID}\")";
    $queryOutput = $conn->query($SQLInput);
    $conn -> close();
    $TimestampID = $queryOutput -> fetch_object() -> Identifier;
    //Find timestampID

    //Creating tags
    $individual = explode(" ", $tags);
    foreach($individual as $oneTag){
      if(strlen($oneTag) > 3){
        //Connect to server
        $conn = new mysqli("oaicontezoagile.mysql.db","oaicontezoagile","M5fgq184HDVu","oaicontezoagile");
        if ($conn -> connect_errno) {
          echo "<br>Failed to connect to MySQL: " . $conn -> connect_error;
          exit();
        }
        //Create call statement and run it
        $SQLInput = "CALL addTag(\"{$oneTag}\", \"0\")";
        $queryOutput = $conn->query($SQLInput);
        $conn -> close();
        //Connect to server
        $conn = new mysqli("oaicontezoagile.mysql.db","oaicontezoagile","M5fgq184HDVu","oaicontezoagile");
        if ($conn -> connect_errno) {
          echo "<br>Failed to connect to MySQL: " . $conn -> connect_error;
          exit();
        }
        //Create call statement and run it
        $SQLInput = "CALL getTagID(\"{$oneTag}\", \"0\")";
        $queryOutput = $conn->query($SQLInput);
        $conn -> close();
        $tagID = $queryOutput -> fetch_object() -> Identifier;
        //Connect to server
        $conn = new mysqli("oaicontezoagile.mysql.db","oaicontezoagile","M5fgq184HDVu","oaicontezoagile");
        if ($conn -> connect_errno) {
          echo "<br>Failed to connect to MySQL: " . $conn -> connect_error;
          exit();
        }
        //Create call statement and run it
        $SQLInput = "CALL linkTSandTag(\"{$TimestampID}\", \"{$tagID}\")";
        $queryOutput = $conn->query($SQLInput);
        $conn -> close();
        $tagID = $queryOutput -> fetch_object() -> Identifier;
      }
    }
    //!Creating tags

    //Creating Supers
    //Creating tags
    $individual = explode(" ", $supers);
    foreach($individual as $oneTag){
      if(strlen($oneTag) > 3){
        //Connect to server
        $conn = new mysqli("oaicontezoagile.mysql.db","oaicontezoagile","M5fgq184HDVu","oaicontezoagile");
        if ($conn -> connect_errno) {
          echo "<br>Failed to connect to MySQL: " . $conn -> connect_error;
          exit();
        }
        //Create call statement and run it
        $SQLInput = "CALL addTag(\"{$oneTag}\", \"1\")";
        $queryOutput = $conn->query($SQLInput);
        $conn -> close();
        //Connect to server
        $conn = new mysqli("oaicontezoagile.mysql.db","oaicontezoagile","M5fgq184HDVu","oaicontezoagile");
        if ($conn -> connect_errno) {
          echo "<br>Failed to connect to MySQL: " . $conn -> connect_error;
          exit();
        }
        //Create call statement and run it
        $SQLInput = "CALL getTagID(\"{$oneTag}\", \"1\")";
        $queryOutput = $conn->query($SQLInput);
        $conn -> close();
        $tagID = $queryOutput -> fetch_object() -> Identifier;
        //Connect to server
        $conn = new mysqli("oaicontezoagile.mysql.db","oaicontezoagile","M5fgq184HDVu","oaicontezoagile");
        if ($conn -> connect_errno) {
          echo "<br>Failed to connect to MySQL: " . $conn -> connect_error;
          exit();
        }
        //Create call statement and run it
        $SQLInput = "CALL linkTSandTag(\"{$TimestampID}\", \"{$tagID}\")";
        $queryOutput = $conn->query($SQLInput);
        $conn -> close();
        $tagID = $queryOutput -> fetch_object() -> Identifier;
      }
    }
    //!Creating Supers
  }
?>

<!--Control buttons -->
<div class="container">
  <br><hr><br>

  <!--Control buttons -->
  <button onclick="startStopVideo()" type = "button" class="btn btn-primary" align=center> Play/Pause </button>
<!--
  <button onclick="saveSync()" id="saveSyncBtn" type="button" class="btn btn-primary" name ="saveSyncBtn">Save Current Time Sync</button>

  <button onclick="syncVideos()" id="syncBtn" type="button" class="btn btn-primary" name ="syncBtn">Sync Videos</button>
-->
<!--Control buttons -->
  <!-- html form -->
  <!--
  <div class="loginSection">
    <div class="container">
      <div class="row">
        <div class="col-md-4 col-xs-1">
        -->
           <!--Something on left maybe-->
        <!-- </div> -->
        <!--<div id="loginCol" class="col-md-4 col-xs-10">-->
        <!--
        <div class="col-md-4 col-xs-10">
          <h1>UoD Add Timestamp</h1> <hr>
          <form action="" method="POST">
            <div class="form-group">
              <label for="username">Enter the message you want to save with the timestamp:</label>
              <input type="text" class="form-control" placeholder="Enter timestamp text" id="textIn" name = "textIn">
              <br>
            </div>
            <div class="form-group">
            -->
              <!--Note to self - check out explode -->
              <!--
              <label for="username">Enter the tags you want on the timestamp (seperated by spaces):</label>
              <input type="text" class="form-control" placeholder="Enter tag text" id="tagsIn" name = "tagsIn">
              <br>
            </div>
            <div class="form-group">
            -->
              <!--Note to self - check out explode -->
              <!--
              <label for="username">Enter the super tags you want on the timestamp (seperated by spaces):</label>
              <input type="text" class="form-control" placeholder="Enter super tag text" id="superIn" name = "superIn">
              <br>
            </div>
            <button id="submitBtn" type="submit" class="btn btn-primary" name ="TSBtn">Add Timestamp</button>
          </form>
        </div>
        <div class="col-md-4 col-xs-1">
        -->
          <!--Something on right maybe-->
          <!--
        </div>
      </div>
    </div>
  </div>
-->
  <!-- html form -->

</div>
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>
