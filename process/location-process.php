<?php
  session_start();
  require_once "../inc/dbconnect.php";
  $msg = '';

  $stmt = null;
  if(isset($_POST['add-location']))
  {
    $loc = $_POST['location'];
    $sql = "call FindLocation('".$loc."');";
    $stmt = $con->query($sql);
    $row = $stmt->fetch(PDO::FETCH_OBJ);
    $count = $row->C;
    if($count == 1)
    {
      $msg = "Location already exists!";
      $_SESSION['msg'] = $msg;
      header("location:../settings-locations.php");
    }
    else
    {
      $stmt = $con->prepare("call Add_Location(?);");
      $stmt->execute(array($loc));
      $msg = "Location successfully added.";
      $_SESSION['msg'] = $msg;
      header("location:../settings-locations.php");
    }
  }
  $stmt = null;
  if(isset($_POST['update-location']))
  {
    $o_loc = $_POST['old-location'];
    $n_loc = $_POST['new-location'];
    $sql = "call FindLocation('".$o_loc."');";
    $stmt = $con->query($sql);
    $row = $stmt->fetch(PDO::FETCH_OBJ);
    $count = $row->C;
    if($count == 1)
    {
      $stmt = $con->prepare("call Update_Location(?, ?);");
      $stmt->execute(array($o_loc, $n_loc));
      $msg = "Location successfully updated.";
      $_SESSION['msg'] = $msg;
      header("location:../settings-locations.php");
    }
    else
    {
      $msg = "Location does not exist; cannot update.";
      $_SESSION['msg'] = $msg;
      header("location:../settings-locations.php");
    }
  }
  $stmt = null;
  if(isset($_POST['delete-location']))
  {
    $d_loc = $_POST['del-location'];
    $sql = "call FindLocation('".$d_loc."');";
    $stmt = $con->query($sql);
    $row = $stmt->fetch(PDO::FETCH_OBJ);
    $count = $row->C;
    if($count == 1)
    {
      $stmt = $con->prepare("call Delete_Location(?);");
      $stmt->execute(array($d_loc));
      $msg = "Location successfully deleted";
      $_SESSION['msg'] = $msg;
      header("location:../settings-locations.php");
    }
    else
    {
      $msg = "Location does not exist; cannot delete.";
      $_SESSION['msg'] = $msg;
      header("location:../settings-locations.php");
    }
  }
?>
