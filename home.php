<?php
session_start();
include_once 'dbconnect.php';

if (!isset($_SESSION['userSession'])) {
  header("Location: index.php");
}

$query = $DBcon->query("SELECT * FROM tbl_users WHERE user_id=".$_SESSION['userSession']);
$userRow=$query->fetch_array();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Welcome - <?php echo $userRow['email']; ?></title>

<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen"> 
<link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen"> 

<link rel="stylesheet" href="style.css" type="text/css" />
</head>
<body>

<nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">Home</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#"><span class="glyphicon glyphicon-user"></span>&nbsp; <?php echo $userRow['username']; ?></a></li>
            <li><a href="logout.php?logout"><span class="glyphicon glyphicon-log-out"></span>&nbsp; Logout</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
<?php 
  $query2 = $DBcon->query("SELECT * FROM complaint"); 
?>
<br>
<br>
<br>
<table class="table table-bordered">
  <tr>
    <th>ID</th>
    <th>Complaint ID</th>
    <th>Location</th>
    <th>Media</th>
    <th>Status</th>
    <th>Action</th>
  </tr>
  <?php $i=1; while($row=$query2->fetch_assoc()): ?>
    <tr>
      <td><?= $i++; ?></td>
      <td><?= $row['complaint_id']; ?></td>
      <td><?= $row['exactloc'];?></td>
      <td><img src="data:image/jpeg;base64,<?= base64_encode($row['media']); ?>" /></td>
      <td><?= $row['progress']; ?></td>
      <td><a href="change.php?id=<?= $row['complaint_id']; ?>"><button class="btn btn-default">Change Status</button></a></td>
    </tr>
  <?php endwhile; ?>
</table>

</body>
</html>

<?php $DBcon->close(); ?>