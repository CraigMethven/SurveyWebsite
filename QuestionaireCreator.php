<!doctype html>
<html lang="en">

</html>
<?php
//Starts the session that's being used
  session_start();
  if ($_SESSION["loggedIn"] != "true") {
      header('Location: http://oai-content.co.uk');
  }

  $t = (date("Y.m.d"));
  @$fp=fopen("exportquestions/data_$username$t.txt", 'w');
  $data = array("agree","textdata","optradio","form");

      file_put_contents("exportquestions/data_$username$t.txt", serialize($data));

      $datas = unserialize(file_get_contents("data_$username$t.txt"));


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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>

  <title>UoD Create Questionnaire</title>
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
      <!-- nav bar -->

      <div class="clearfix"></div>
  </div>

  <div class="container">
    <div class="row">
      <div class="col-md-12 text-center">
        <form id="questionnaire" action="AddtoDatabase.php" method="post">
            <h1 class="app-title">Create Questionnaire</h1><hr>
            <div id="dynamicCheck">
              <div class="btn-group">
                  <button id = 'newFormElement' type="button" class="btn btn-primary" >Text Input</button>
                  <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" id="dropdownMenuButton" >
                    Multiple Choice<span class="caret"></span>
                  </button>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <button id = 'newMc2Element' class="dropdown-item, btn btn-primary" type="button">2</button>
                    <button id = 'newMc3Element' class="dropdown-item, btn btn-primary" type="button">3</button>
                    <button id = 'newMc4Element' class="dropdown-item, btn btn-primary" type="button">4</button>
                  </div>
                  <button id = 'newLikertElement' type="button" class="btn btn-primary">Likert</button>
            </div>
            <hr>

            <h3>Questionnaire Name:
            <input type="text" name = "questionnaireTitle" id = "questionnaireTitle" required> </input></h3>

            <!-- this is where all the things that were printed are sent -->
            <div id="newElementId"></div>


            <input type="submit" name="submit" value="submit" class="btn btn-primary"></input>
            <br>
          </div>
          </form>
      </div>
    </div>
  </div>

<script type="text/JavaScript">


var counter = 0;

// Removes Cards
var closebtns = document.getElementsByClassName("close");
var i;

for (i = 0; i < closebtns.length; i++) {
  closebtns[i].addEventListener("click", function() {
    this.parentElement.style.display = 'none';
  });
}

// Add cards

 $(function(){
   $('#newFormElement').click(function(){
     counter += 1;
     $('#newElementId').append(
       '<strong>Question No. ' + counter + '</strong><br />'
       + '<span class="close"><div id ="tempIDdiv" data-IDElement ="temp" class="card"></span>'
          +'<label class="title-question">'
              +'<input type="Question" class="form-control" placeholder="Enter Question here" id="' + counter + ' QTitle Text" name="' + counter + ' QTitle Text">'
            +'</label>'
            +'<textarea class=answer-text rows= "5" cols = "80" placeholder = Users will type here></textarea>'
          +'</div>' );
      });


  $('#newLikertElement').click(function(){
    counter += 1;
    $('#newElementId').append(
      '<strong>Question No. ' + counter + '</strong><br />'
      + '<div id ="tempIDdiv" data-IDElement ="temp" class="card">'
         +'<label class="title-question">'
             +'<input type="Question" class="form-control" placeholder="Enter Question here" id="' + counter + ' QTitle Likert" name="' + counter + ' QTitle Likert">'
           +'</label>'
           +'<ul id="maybe" class="likert" style="text-center">'
               +'<li>Disagree </li><a>                            </a>'
               +'<li><input type="radio" name="guilty"/></li><a>      </a>'
               +'<li><input type="radio" name="guilty"/></li><a>      </a>'
               +'<li><input type="radio" name="guilty"/></li><a>      </a>'
               +'<li><input type="radio" name="guilty"/></li><a>      </a>'
               +'<li><input type="radio" name="guilty"/></li><a>      </a>'
               +'<li> Agree </li>'
           +'</ul>'
         +'</div>' );
     });


  $('#newMc2Element').click(function(){
     counter += 1;

     $('#newElementId').append(
       '<strong>Question No. ' + counter + '</strong><br />'
       + '<div id ="tempIDdiv" data-IDElement ="temp" class="card">'
            +'<input type="Question" class="form-control" placeholder="Enter Likert Question here" id="' + counter + ' QTitle MC" name="' + counter + ' QTitle MC">'
            +'<div class="padTheTextbox">'
              +'<input type = "radio" id="'+counter+'" name="'+counter+'"/>'
              +'<input type="text" id="'+counter+' MCAnswer 1" name="'+counter+' MCAnswer 1" placeholder="Answer 1"/>'
            +'</div>'
            +'<br>'
            +'<input type = "radio" id="'+counter+'" name="'+counter+'"/>'
            +'<input type="text" id="'+counter+' MCAnswer 2" name="'+counter+' MCAnswer 2" placeholder="Answer 2"/>'
            +'<br>'
          +'</div>' );
       });


   $('#newMc3Element').click(function(){
     counter += 1;

     $('#newElementId').append(
       '<strong>Question No. ' + counter + '</strong><br />'
       + '<div id ="tempIDdiv" data-IDElement ="temp" div class="card">'
            +'<input type="Question" class="form-control" placeholder="Enter Question here" id="' + counter + ' QTitle MC" name="' + counter + ' QTitle MC">'
            +'<div class="padTheTextbox">'
              +'<input type = "radio" id="'+counter+'" name="'+counter+'"/>'
              +'<input type="text" id="'+counter+' MCAnswer 1" name="'+counter+' MCAnswer 1" placeholder="Answer 1"/>'
              +'<br>'
            +'</div>'
            +'<input type = "radio" id="'+counter+'" name="'+counter+'"/>'
            +'<input type="text" id="'+counter+' MCAnswer 2" name="'+counter+' MCAnswer 2" placeholder="Answer 2"/>'
            +'<br>'
            +'<div class="padTheTextbox">'
              +'<input type = "radio" id="'+counter+'" name="'+counter+'"/>'
              +'<input type="text" id="'+counter+' MCAnswer 3" name="'+counter+' MCAnswer 3" placeholder="Answer 3"/>'
              +'<br>'
            +'</div>'
          +'</div>' );
     });


     $('#newMc4Element').click(function(){
       counter += 1;

       $('#newElementId').append(
         '<strong>Question No. ' + counter + '</strong><br />'
         + '<div id ="tempIDdiv" data-IDElement ="temp" div class="card">'
              +'<input type="Question" class="form-control" placeholder="Enter Question here" id="' + counter + ' QTitle MC" name="' + counter + ' QTitle MC">'
              +'<div class="padTheTextbox">'
                +'<input type = "radio" id="'+counter+'" name="'+counter+'"/>'
                +'<input type="text" id="'+counter+' MCAnswer 1" name="'+counter+' MCAnswer 1" placeholder="Answer 1"/>'
                +'<br>'
              +'</div>'
              +'<input type = "radio" id="'+counter+'" name="'+counter+'"/>'
              +'<input type="text" id="'+counter+' MCAnswer 2" name="'+counter+' MCAnswer 2" placeholder="Answer 2"/>'
              +'<br>'
              +'<div class="padTheTextbox">'
                +'<input type = "radio" id="'+counter+'" name="'+counter+'"/>'
                +'<input type="text" id="'+counter+' MCAnswer 3" name="'+counter+' MCAnswer 3" placeholder="Answer 3"/>'
                +'<br>'
              +'</div>'
              +'<input type = "radio" id="'+counter+'" name="'+counter+'"/>'
              +'<input type="text" id="'+counter+' MCAnswer 4" name="'+counter+' MCAnswer 4" placeholder="Answer 4"/>'
              +'<br>'
            +'</div>' );
       });
    });


            </script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>
