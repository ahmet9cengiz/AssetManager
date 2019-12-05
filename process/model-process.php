<?php
  session_start();
  require_once "../inc/dbconnect.php";
  $msg = '';

  //ADD MODEL
  $stmt = null;
  if(isset($_POST['add-model']))
  {
      $monum = $_POST['add-model-number'];
      $moname = $_POST['add-model-name'];
      if($moname == null)
      {
        $moname = '';
      }
      $momanu = $_POST['add-manufacturer'];
      $mocat = $_POST['add-category'];
      if($momanu == NULL || $momanu == '')
      {
        $msg = "Error in adding model: either category or manufacturer was empty or null, and passed to the procedure call.";
        $_SESSION['msg'] = $msg;
        header("location:../settings-models.php");
      }
      else
      {
        $stmt = $con->prepare("call FindModel(?, ?, ?, ?);");
        $stmt->execute(array($monum, $moname, $momanu, $mocat));
        $row = $stmt->fetch(PDO::FETCH_OBJ);
        $count = $row->C;
        if($count==1)
        {
          $msg = "Model already in database!";
          $_SESSION['msg'] = $msg;
          header("location:../settings-models.php");
        }
        else
        {
          $stmt = $con->prepare("call Add_Model(?, ?, ?, ?);");
          $stmt->execute(array($monum, $moname, $momanu, $mocat));
          $msg = "Model successfully added.";
          $_SESSION['msg'] = $msg;
          header("location:../settings-models.php");
        }
      }
  }
  $stmt = null;

  //UPDATE MODEL
  if(isset($_POST['update-model']))
  {
    $old_category = $_POST['old-category'];
    $old_manufacturer = $_POST['old-manufacturer'];
    $old_model_number = $_POST['old-model-number'];
    $new_category = $_POST['new-category'];
    $new_manufacturer = $_POST['new-manufacturer'];
    $new_model_number = $_POST['new-model-number'];
    $old_model_name = $_POST['old-model-name'];
    $new_model_name = $_POST['new-model-name'];
    if($old_model_name==null || $old_model_name == '')
    {
      $old_model_name = '';
    }
    if($new_model_name==null || $new_model_name == '')
    {
      $new_model_name = '';
    }
    // echo 'Old Category: '.$old_category.'; Old Manufacturer: '.$old_manufacturer.'; Old Model Number: '.$old_model_number.'; Old Model Name: '.$old_model_name.'<br><br>'.'New Category: '.$new_category.'; New Manufacturer: '.$new_manufacturer.'; New Model Number: '.$new_model_number.'; New Model Name: '.$new_model_name;
    $stmt = $con->prepare("call FindModel(?, ?, ?, ?)");
    $stmt->execute(array($old_model_number, $old_model_name, $old_manufacturer, $old_category));
    $row = $stmt->fetch(PDO::FETCH_OBJ);
    $count = $row->C;
    if($count==0)
    {
      $msg = "Model does not exist; cannot update.";
      $_SESSION['msg'] = $msg;
      header("location:../settings-models.php");
    }
    $stmt = $con->prepare("call FindModel(?, ?, ?, ?)");
    $stmt->execute(array($new_model_number, $new_model_name, $new_manufacturer, $new_category));
    $row = $stmt->fetch(PDO::FETCH_OBJ);
    $count = $row->C;
    if($count==1)
    {
      $msg = "Update conflicts with existing model; cannot update.";
      $_SESSION['msg'] = $msg;
      header("location:../settings-models.php");
    }
    else
    {
      $stmt = $con->prepare("call Update_Model(?, ?, ?, ?, ?, ?, ?)");
      $stmt->execute(array($old_model_number, $old_manufacturer, $old_category, $new_model_number, $new_model_name, $new_manufacturer, $new_category));
      $msg = "Model successfully updated.";
      $_SESSION['msg'] = $msg;
      header("location:../settings-models.php");
    }
  }
  $stmt = null;

  //DELETE MODEL
  if(isset($_POST['delete-model']))
  {
    $d_model_number = $_POST['del-model-number'];
    $d_manufacturer = $_POST['del-manufacturer'];
    $d_category = $_POST['del-category'];
	$d_model_name = $_POST['del-model-name'];
	if($d_model_name == null)
	{
		$d_model_name = '';
	}
    if($d_manufacturer == NULL || $d_manufacturer == '')
    {
      $msg = "Error in deleting model: either category or manufacturer was empty or null, and passed to the procedure call.";
      $_SESSION['msg'] = $msg;
      header("location:../settings-models.php");
    }
    else
    {
      $stmt = $con->prepare("call FindModel(?, ?, ?, ?);");
      $stmt->execute(array($d_model_number, $d_model_name, $d_manufacturer, $d_category));
      $row = $stmt->fetch(PDO::FETCH_OBJ);
      $count = $row->C;
      if($count==0)
      {
        $msg = "Model does not exist; cannot delete.";
        $_SESSION['msg'] = $msg;
        header("location:../settings-models.php");
      }
      else
      {
        $stmt = $con->prepare("call Delete_Model(?, ?, ?);");
        $stmt->execute(array($d_model_number, $d_manufacturer, $d_category));
        $msg = "Model successfully deleted.";
        $_SESSION['msg'] = $msg;
        header("location:../settings-models.php");
      }
    }
  }
  $stmt=null;
?>
