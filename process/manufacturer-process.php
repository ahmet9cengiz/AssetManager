<?php
  session_start();
  require_once "../inc/dbconnect.php";
  $msg='';

  $stmt = null;
  if(isset($_POST['add-manufacturer']))
  {
    $mname = $_POST['manu-name'];
    $mphone = $_POST['manu-phone'];
    $mweb = $_POST['manu-web'];
    $sql = "call FindManufacturer('".$mname."')";
    $stmt = $con->query($sql);
    $row = $stmt->fetch(PDO::FETCH_OBJ);
    $count = $row->C;
    if($count == 1)
    {
      $msg = "Manufacturer already exists!";
      $_SESSION['msg'] = $msg;
      header("location:../settings-manufacturers.php");
    }
    else
    {
      $stmt = $con->prepare("call Add_Manufacturer(?, ?, ?);");
      $stmt->execute(array($mname, $mphone, $mweb));
      $msg = "Manufacturer added successfully.";
      $_SESSION['msg'] = $msg;
      header("location:../settings-manufacturers.php");
    }
  }

  $stmt=null;
  if(isset($_POST['update-manufacturer']))
  {
    $o_manuname = $_POST['old-manuname'];
    $n_manuname = $_POST['new-manuname'];
    $n_PH = $_POST['new-manuphone'];
    $n_web = $_POST['new-manuweb'];
    $sql = "call FindManufacturer('".$o_manuname."')";
    $stmt = $con->query($sql);
    $row = $stmt->fetch(PDO::FETCH_OBJ);
    $count = $row->C;
    if($count == 1)
    {
      $stmt = $con->prepare("call Update_Manufacturer(?, ?, ?, ?);");
      $stmt->execute(array($o_manuname, $n_manuname, $n_phone, $n_web));
      $msg = "Manufacturer successfully updated.";
      $_SESSION['msg'] = $msg;
      header("location:../settings-manufacturers.php");
    }
    else
    {
      $msg = "Manufacturer does not exist; cannot update.";
      $_SESSION['msg'] = $msg;
      header("location:../settings-manufacturers.php");
    }
  }

  $stmt = null;
  if(isset($_POST['delete-manufacturer']))
  {
      $d_manu = $_POST['del-manu'];
      $sql = "call FindManufacturer('".$d_manu."')";
      $stmt = $con->query($sql);
      $row = $stmt->fetch(PDO::FETCH_OBJ);
      $count = $row->C;
      if($count == 1)
      {
        $stmt = $con->prepare("call Delete_Manufacturer(?);");
        $stmt->execute(array($d_manu));
        $msg = "Manufacturer successfully deleted.";
        $_SESSION['msg'] = $msg;
        header("location:../settings-manufacturers.php");
      }
      else
      {
        $msg = "Manufacturer does not exist; cannot delete.";
        $_SESSION['msg']=$msg;
        header("location:../settings-manufacturers.php");
      }
   }
?>
