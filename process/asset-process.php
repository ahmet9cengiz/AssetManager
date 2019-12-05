<?php
	session_start();
  require_once "../inc/dbconnect.php";
	$msg = '';
	$stmt = null;

	if(isset($_POST['add-asset']) || isset($_POST['add-duplicate-asset']))
	{
		$service_tag = $_POST['service-tag'];
		$model_number = $_POST['model'];
		$purchase = date('Y-m-d', strtotime($_POST['purchase-date']));
		$warranty = $_POST['warranty'];
		$warranty_end = date('Y-m-d', strtotime($purchase. ' + '.$warranty.' year'));
		$verification_days = $_POST['verification-days'];
		$lverify = date('Y-m-d', strtotime($_POST['purchase-date']));
		$fverify = date('Y-m-d', strtotime($_POST['purchase-date'].' + '.$verification_days.' day'));
		$notes = $_POST['notes'];
		$firstname = '';
		$lastname = '';
		$location = $_POST['add-location'];
		$network = $_POST['add-network'];
		$category = $_POST['add-category'];
		$manufacturer = $_POST['add-manufacturer'];

		if(isset($_POST['surplus'])){
			$surplus = 1;
		}else{
			$surplus = 0;
		}
		
		

		if(isset($_POST['add-duplicate-asset'])){
			$_SESSION['duplicate'] = "duplicate";
			$_SESSION['category'] = $category;
			$_SESSION['manufacturer'] = $manufacturer;
			$_SESSION['model'] = $model_number;
			$_SESSION['purchase'] = $purchase;
			$_SESSION['warranty'] = $warranty;
			$_SESSION['verifyDays'] = $verification_days;
			$_SESSION['surplus'] = $surplus;
			$_SESSION['notes'] = $notes;
			$_SESSION['location'] = $location;
			$_SESSION['network'] = $network;
		}


		// echo 'Service Tag: '.$service_tag.
		// '<br>Model Number: '.$model_number.
		// '<br>Purchase Date: '.$purchase.
		// '<br>Warranty: '.$warranty.
		// '<br>Warranty End: '.$warranty_end.
		// '<br>Verification Days: '.$verification_days.
		// '<br>Last Verify: '.$lverify.
		// '<br>Future Verify: '.$fverify.
		// '<br>';

		$stmt = $con->prepare("call FindServiceTag(?);"); //does the service tag exist
		$stmt->execute(array($service_tag));
		$row = $stmt->fetch(PDO::FETCH_OBJ);
		$count = $row->C;
		if($count == 0){

			$stmt = NULL;
			$stmt = $con->prepare("call Add_Item(?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
	
			$variableArray = array($service_tag, $model_number, $purchase,
								 $warranty, $warranty_end, $surplus, $verification_days,
								 $lverify, $fverify, $notes, $firstname,
								 $lastname, $location, $network);
	
			$stmt->execute($variableArray);
			$stmt = null;
			$msg = 'Item successfully added';
		}
		else{
			$msg = 'Service Tag must be unique';
		}
		$_SESSION['msg'] = $msg;
			header("location:../asset-manager.php");
	}
	$stmt=null;

	

	if(isset($_POST['update-asset']))
	{
		$old_service_tag = $_POST['old-service-tag'];
		$old_model_number = $_POST['old-model'];
		$old_manufacturer = $_POST['old-manufacturer'];
		$old_category = $_POST['old-category'];
		$new_service_tag = $_POST['new-service-tag'];
		$new_model_number = $_POST['new-model'];
		$new_manufacturer = $_POST['new-manufacturer'];
		$new_category = $_POST['new-category'];
		$stmt = $con->prepare("call FindItem(?, ?, ?, ?);");
		$stmt->execute(array($old_service_tag, $old_model_number, $old_manufacturer, $old_category));
		$row = $stmt->fetch(PDO::FETCH_OBJ);
		$count = $row->C;
		if($count == 0)
		{
			$msg = "Item does not exist; cannot update!";
			$_SESSION['msg'] = $msg;
			header("location:../asset-manager.php");
		}
		$stmt = $con->prepare("call FindItem(?, ?, ?, ?);");
		$stmt->execute(array($new_service_tag, $new_model_number, $new_manufacturer, $new_category));
		$row = $stmt->fetch(PDO::FETCH_OBJ);
		$count = $row->C;
		if($count == 1)
		{
			$msg = "Update conflicts with existing item; cannot update.";
			$_SESSION['msg'] = $msg;
			header("location:../asset-manager.php");
		}
		else
		{
			$new_FN = $_POST['new-firstname'];
			$new_LN = $_POST['new-lastname'];
			$new_location = $_POST['new-location'];
			$new_network = $_POST['new-network'];
			$stmt = $con->prepare("call Update_Item(?,?,?,?,?,?,?,?,?,?,?,?,?);");
			$stmt->execute(array($old_service_tag, $old_model_number, $old_manufacturer, $old_category, $new_service_tag, $new_model_number, $new_manufacturer, $new_category, $new_notes, $new_FN, $new_LN, $new_location, $new_network));
			$msg = "Item successfully updated.";
			$_SESSION['msg'] = $msg;
			header("location:../asset-manager.php");
		}
		// echo 'Old Service Tag: '.$old_service_tag.
		// '<br>Old Model Number: '.$old_model_number.
		// '<br>Old Manufacturer: '.$old_manufacturer.
		// '<br>Old Category: : '.$old_category.
		// '<br>New Service Tag: : '.$new_service_tag.
		// '<br>New Model Number: : '.$new_model_number.
		// '<br>New Manufacturer: : '.$new_manufacturer.
		// '<br>New Category: : '.$new_category;
	}

	if(isset($_POST['delete-asset']))
	{
		$d_service_tag = $_POST['delete-service-tag'];
		$d_model_number = $_POST['del-model'];
		$d_manufacturer = $_POST['del-manufacturer'];
		$d_category = $_POST['del-category'];
		// echo 'Service Tag: '.$d_service_tag.
		// '<br>Model Number: '.$d_model_number.
		// '<br>Manufacturer: '.$d_manufacturer.
		// '<br>Category: : '.$d_category;
		$stmt = $con->prepare("call FindItem(?, ?, ?, ?)");
		$stmt->execute(array($d_service_tag, $d_model_number, $d_manufacturer, $d_category));
		$row = $stmt->fetch(PDO::FETCH_OBJ);
		$count = $row->C;
		if($count==0)
		{
			$msg = "Item does not exist; cannot delete.";
			$_SESSION['msg'] = $msg;
			header("location:../asset-manager.php");
		}
		else
		{
			$stmt = $con->prepare("call Delete_Item(?, ?, ?, ?);");
			$stmt->execute(array($d_service_tag, $d_model_number, $d_manufacturer, $d_category));
			$msg = "Item successfully deleted.";
			$_SESSION['msg'] = $msg;
			header("location:../asset-manager.php");
		}
	}
?>
