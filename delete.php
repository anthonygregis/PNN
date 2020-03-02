<?php 

if(isset($_REQUEST['id']) && is_numeric($_REQUEST['id']))
{
  $id = trim($_REQUEST['id']);
  $sql = "DELETE FROM transactions where id = ?";

  $stmt = mysqli_prepare($link, $sql);
  mysqli_stmt_bind_param($stmt, "s", $id);
  $stmt->execute();
}

?>