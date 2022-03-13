<?php
//Starts the session that's being used
  session_start();
  if ($_SESSION["loggedIn"] != "true") {
      header('Location: http://oai-content.co.uk');
  }
  if($_SESSION["role"] == "CR"){
    //Connect to server
    $conn = new mysqli("oaicontezoagile.mysql.db","oaicontezoagile","M5fgq184HDVu","oaicontezoagile");
    if ($conn -> connect_errno) {
      echo "<br>Failed to connect to MySQL: " . $conn -> connect_error;
      exit();
    }
    $SQLInput = "CALL checkIfFootage(\"{$_SESSION['username']}\")";
    $queryOutput = $conn->query($SQLInput);

    if($queryOutput->fetch_object()->footageValue < 1){
      header('Location: http://oai-content.co.uk/dashboard.php');
    }
  }
?>

<html lang="en">

</html>

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
  <title>Upload a video</title>
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
<?php
if(isset($_POST['upload'])){
   $maxsize = 5242880; // 5MB
   $_SESSION['message'] = "nothing happened ~O~";
   if(isset($_FILES['file']['name']) && $_FILES['file']['name'] != ''){
     if(isset($_POST['user'])){
       $Owner = $_POST['user'];
     }else{
       $Owner = $_SESSION['username'];
     }

       $name = $_FILES['file']['name'];
       $target_dir = "videos/";
       $target_file = $target_dir . $_FILES["file"]["name"];

       // Select file type
       $extension = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

       // Valid file extensions
       $extensions_arr = array("mp4","avi","3gp","mov","mpeg");

       // Check extension
       if( in_array($extension,$extensions_arr) ){

          // Check file size
          if(($_FILES['file']['size'] >= $maxsize) || ($_FILES["file"]["size"] == 0)) {
             $_SESSION['message'] = "File too large. File must be less than 5MB.";
          }else{
             // Upload
             if(move_uploaded_file($_FILES['file']['tmp_name'],$target_file)){
               //Connect to server
               $conn = new mysqli("oaicontezoagile.mysql.db","oaicontezoagile","M5fgq184HDVu","oaicontezoagile");
               if ($conn -> connect_errno) {
                 echo "<br>Failed to connect to MySQL: " . $conn -> connect_error;
                 exit();
               }
               // Insert record
               $query = "INSERT INTO videos(name,location, Owner) VALUES('".$name."','".$target_file."','".$Owner."')";
               $queryOutput = $conn->query($query);
               $conn -> close();
               $_SESSION['message'] = "Upload successfully.";
             }
          }

       }else{
          $_SESSION['message'] = "Invalid file extension.";
       }
   }else{
       $_SESSION['message'] = "Please select a file.";
   }
   header('location: #'); //http://oai-content.co.uk/dashboard.php
   exit;
}
?>
<!-- Upload response -->
<?php
if(isset($_SESSION['message'])){
   echo $_SESSION['message'];
   unset($_SESSION['message']);
}
?>
<div class="container">
  <div id="loginCol">
    <h1> UoD Upload Video </h1><br>
    <form method="post" action="" enctype='multipart/form-data'>
      <div class="form-group">
        <input type='file' name='file' />
      </div>
      <br>
      <?php
        if($_SESSION["role"] == "CR"){
          echo "<div class=\"form-group\">";
            echo "<label for=\"username\">Select the Principle Researcher you want to upload for:</label>";
            echo "<br>";
              //Connect to server
              $conn = new mysqli("oaicontezoagile.mysql.db","oaicontezoagile","M5fgq184HDVu","oaicontezoagile");
              if ($conn -> connect_errno) {
                echo "<br>Failed to connect to MySQL: " . $conn -> connect_error;
                exit();
              }
              $SQLInput = "CALL getFootagePRs(\"{$_SESSION["username"]}\")";
              $queryOutput = $conn->query($SQLInput);
              $conn -> close();

              if($queryOutput->num_rows > 0){
                while($row = $queryOutput->fetch_object()){
                  echo "<input type=\"radio\" id=\"{$row -> PRUsername}\" value=\"{$row -> PRUsername}\" name = \"user\"> <label for=\"{$row -> PRUsername}\">{$row -> PRUsername}</label><br>";
                }
              }else{
                echo "<h1>You currently don't have any co-researchers</h1>";
              }
          echo "</div>";
          echo "<br>";
        }
      ?>
      <div class="form-group">
        <button id="submitBtn" type="submit" value='Upload' class="btn btn-primary" name ="upload">Upload Video</button>
      </div>
    </form>
  </div>
</div>



  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>
