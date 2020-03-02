<?php 
// Include config file
require_once "assets/action/config.php";

/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

if(isset($_REQUEST['id']) && is_numeric($_REQUEST['id']))
{
  $id = trim($_REQUEST['id']);
  $sql = "DELETE FROM transactions where id = ?";

  $stmt = mysqli_prepare($link, $sql);
  mysqli_stmt_bind_param($stmt, "s", $id);
  $stmt->execute();
}

?>