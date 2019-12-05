<?php
  session_start();
  require_once "../inc/dbconnect.php";
  $msg = '';

  $stmt = null;
  if(isset($_POST['add-category']))
  {
    $cat = $_POST['category'];
		$stmt = $con->prepare("call FindCategory(?);");
    $stmt->execute(array($cat));
    $row = $stmt->fetch(PDO::FETCH_OBJ);
    $count = $row->C;
    if($count == 1)
    {
      $msg = "Category already exists!";
      $_SESSION['msg'] = $msg;
      header("location:../settings-categories.php");
    }
    else
    {
      $stmt = $con->prepare("call Add_Category(?);");
      $stmt->execute(array($cat));
      $msg = "Category successfully added.";
      $_SESSION['msg'] = $msg;
      header("location:../settings-categories.php");
    }
  }
  $stmt = null;

  if(isset($_POST['update-category']))
  {
    $o_cat = $_POST['old-category'];
    $n_cat = $_POST['new-category'];
		$stmt = $con->prepare("call FindCategory(?);");
    $stmt->execute(array($o_cat));
    $row = $stmt->fetch(PDO::FETCH_OBJ);
    $count = $row->C;
    if($count == 1)
    {
      $stmt = $con->prepare("call Update_Category(?, ?);");
      $stmt->execute(array($o_cat, $n_cat));
      $msg = "Category successfully updated.";
      $_SESSION['msg'] = $msg;
      header("location:../settings-categories.php");
    }
    else
    {
      $msg = "Category does not exist; cannot update.";
      $_SESSION['msg'] = $msg;
      header("location:../settings-categories.php");
    }
  }

  $stmt = null;
  if(isset($_POST['delete-category']))
  {
    $d_cat = $_POST['del-category'];
		$stmt = $con->prepare("call FindCategory(?);");
    $stmt->execute(array($d_cat));
    $row = $stmt->fetch(PDO::FETCH_OBJ);
    $count = $row->C;
    if($count == 1)
    {
      $stmt = $con->prepare("call Delete_Category(?);");
      $stmt->execute(array($d_cat));
      $msg = "Category successfully deleted";
      $_SESSION['msg'] = $msg;
      header("location:../settings-categories.php");
    }
    else
    {
      $msg = "Category does not exist; cannot delete.";
      $_SESSION['msg'] = $msg;
      header("location:../settings-categories.php");
    }
  }
?>
