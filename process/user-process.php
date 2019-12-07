<?php
  session_start();
  require_once "../inc/dbconnect.php";
  $msg = '';

  $stmt = null;
  if(isset($_POST['add-user']))
  {
    $fn = $_POST['add-fn'];
    $ln = $_POST['add-ln'];
    $email = $_POST['add-email'];
    $phone = $_POST['add-phone'];
    $room = $_POST['add-room'];
    $stmt = $con->prepare("call FindUser(?, ?, ?);");
    $stmt->execute(array($fn, $ln, $email));
    $row = $stmt->fetch(PDO::FETCH_OBJ);
    $count = $row->C;
    if($count == 1)
    {
      $msg = "User already exists!";
      $_SESSION['msg'] = $msg;
      header("location:../settings-users.php");
    }
    else
    {
      $stmt = $con->prepare("call Add_User(?, ?, ?, ?, ?);");
      $stmt->execute(array($fn, $ln, $email, $phone, $room));
      $msg = "User successfully added.";
      $_SESSION['msg'] = $msg;
      header("location:../settings-users.php");
    }
  }
  $stmt = null;

  if(isset($_POST['update-user']))
  {
    $o_fn = $_POST['old-fn'];
    $o_ln = $_POST['old-ln'];
    $o_email = $_POST['old-email'];
    $n_fn = $_POST['new-fn'];
    $n_ln = $_POST['new-ln'];
    $n_email = $_POST['new-email'];
    $n_phone = $_POST['new-phone'];
    $n_room = $_POST['new-room'];
    $stmt = $con->prepare("call FindUser(?, ?, ?);");
    $stmt->execute(array($o_fn, $o_ln, $o_email));
    $row = $stmt->fetch(PDO::FETCH_OBJ);
    $count = $row->C;
    if($count == 1)
    {
      $stmt = $con->prepare("call Update_User(?, ?, ?, ?, ?, ?, ?, ?);");
      $stmt->execute(array($o_fn, $o_ln, $o_email, $n_fn, $n_ln, $n_email, $n_phone, $n_room));
      $msg = "User successfully updated!";
      $_SESSION['msg'] = $msg;
      header("location:../settings-users.php");
    }
    else
    {
      $msg = "User does not exist, cannot update.";
      $_SESSION['msg'] = $msg;
      header("location:../settings-users.php");
    }
  }
  $stmt = null;

  if(isset($_POST['delete-user']))
  {
    $fn = $_POST['del-fn'];
    $ln = $_POST['del-ln'];
    $email = $_POST['del-email'];
    $stmt = $con->prepare("call FindUser(?, ?, ?);");
    $stmt->execute(array($fn, $ln, $email));
    $row = $stmt->fetch(PDO::FETCH_OBJ);
    $count = $row->C;
    if($count == 1)
    {
      $stmt = $con->prepare("call Delete_User(?, ?, ?);");
      $stmt->execute(array($fn, $ln, $email));
      $msg = "User successfully deleted.";
      $_SESSION['msg'] = $msg;
      header("location:../settings-users.php");
    }
    else
    {
      $msg = "User does not exist; cannot delete!";
      $_SESSION['msg'] = $msg;
      header("location:../settings-users.php");
    }
  }

  $stmt = null;
?>
