<?php
  session_start();
  require_once "../dbconnect.php";
  $msg = '';

  $stmt = null;
  if(isset($_POST['add-network']))
  {
    $net = $_POST['network'];
    $stmt = $con->prepare("call FindNetwork(?);");
    $stmt->execute(array($net));
    $row = $stmt->fetch(PDO::FETCH_OBJ);
    $count = $row->C;
    if($count == 1)
    {
      $msg = "Network already exists!";
      $_SESSION['msg'] = $msg;
      header("location:../settings-networks.php");
    }
    else
    {
      $stmt = $con->prepare("call Add_Network(?);");
      $stmt->execute(array($net));
      $msg = "Network successfully added.";
      $_SESSION['msg'] = $msg;
      header("location:../settings-networks.php");
    }
  }
  $stmt = null;

  if(isset($_POST['update-network']))
  {
    $o_net = $_POST['old-network'];
    $n_net = $_POST['new-network'];
    $stmt = $con->prepare("call FindNetwork(?);");
    $stmt->execute(array($o_net));
    $row = $stmt->fetch(PDO::FETCH_OBJ);
    $count = $row->C;
    if($count == 1)
    {
      $stmt = $con->prepare("call Update_Network(?, ?);");
      $stmt->execute(array($o_net, $n_net));
      $msg = "Network successfully updated.";
      $_SESSION['msg'] = $msg;
      header("location:../settings-networks.php");
    }
    else
    {
      $msg = "Network does not exist; cannot update.";
      $_SESSION['msg'] = $msg;
      header("location:../settings-networks.php");
    }
  }

  $stmt = null;
  if(isset($_POST['delete-network']))
  {
    $d_net = $_POST['del-network'];
    $stmt = $con->prepare("call FindNetwork(?);");
    $stmt->execute(array($d_net));
    $row = $stmt->fetch(PDO::FETCH_OBJ);
    $count = $row->C;
    if($count == 1)
    {
      $stmt = $con->prepare("call Delete_Network(?);");
      $stmt->execute(array($d_net));
      $msg = "Network successfully deleted";
      $_SESSION['msg'] = $msg;
      header("location:../settings-networks.php");
    }
    else
    {
      $msg = "Network does not exist; cannot delete.";
      $_SESSION['msg'] = $msg;
      header("location:../settings-networks.php");
    }
  }
?>
