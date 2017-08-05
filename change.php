<?php

session_start();
require_once 'dbconnect.php';

if (!isset($_SESSION['userSession'])) {
  header("Location: index2.php");
  exit;
}

if(isset($_POST['submit'])){
  $status = $_POST['status'];
  $complaint_id = $_POST['complaint_id'];
  $query = $DBcon->query("UPDATE complaint SET progress = '$status' WHERE complaint_id = '$complaint_id'");
  header('Location: home.php');
}

?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Bootstrap 101 Template</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <div class="maindiv">
      <div class="insidediv3">&nbsp;</div>
      <div class="insidediv1"><b>Current Status of Complaint #<?= $_GET['id']; ?></b></div>
      <hr class="custhr">
      <form class="userform" action="change.php" method="POST">
        <div class="form-group">
          <!-- <label for="exampleTextarea"><u>Your Message</u></label> -->
          <textarea class="form-control" name="status" id="exampleTextarea" rows="3" placeholder="Current Status"></textarea>
        </div>
        <input type="hidden" name="complaint_id" value="<?= $_GET['id']; ?>" />
        <input type="submit" class="btn btn-success" name="submit" value="Change Status"></input>
      </form>
      <div class="insidediv3">&nbsp;</div>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>