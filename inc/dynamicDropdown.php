<?php
	require_once "dbconnect.php";

	//dynamic model
	if(isset($_POST['categoryID']) && isset($_POST['manufacturerID']))
	{
		$categoryID = $_POST['categoryID'];
		$manufacturerID = $_POST['manufacturerID'];

		$stmt = $con->prepare("call Model_by_Manufacturer_and_Category(?, ?);");
		$stmt->execute(array($manufacturerID, $categoryID));
		$models = $stmt->fetchAll(PDO::FETCH_ASSOC);
		echo json_encode($models);
	}

	//dynamic email for generate
	if(isset($_POST['userID']))
	{
		$userID = $_POST['userID'];

		$stmt = $con->prepare("call Email_by_User(?);");
		$stmt->execute(array($userID));
		$emails = $stmt->fetchAll(PDO::FETCH_ASSOC);
		echo json_encode($emails);
	}

	//dynamic email for check-in
	if(isset($_POST['item_id']))
	{
		$itemID = $_POST['item_id'];
		$stmt = $con->prepare("call Email_by_ServiceTag(?);");
		$stmt->execute(array($itemID));
		$emails = $stmt->fetchAll(PDO::FETCH_ASSOC);
		echo json_encode($emails);
	}

	function loadCategories()
	{

		$hostname = 'localhost';
		$username = 'stbarnar';
		$password = 'nono123';
		$con;
		try {
		$con = new PDO("mysql:host=$hostname;dbname=stbarnar_db", $username, $password);
		}
		catch(PDOException $e)
		{
		echo $e->getMessage();
		}

		$stmt = $con->prepare("select * from proj_category");
		$stmt->execute();
		$categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

		return $categories;
	}

	function loadManufacturers()
	{
		$hostname = 'localhost';
		$username = 'stbarnar';
		$password = 'nono123';
		$con;
		try {
		$con = new PDO("mysql:host=$hostname;dbname=stbarnar_db", $username, $password);
		}
		catch(PDOException $e)
		{
		echo $e->getMessage();
		}

		$stmt = $con->prepare("select * from proj_manufacturer");
		$stmt->execute();
		$manufacturers = $stmt->fetchAll(PDO::FETCH_ASSOC);

		return $manufacturers;
	}

	function loadLocations()
	{
		$hostname = 'localhost';
		$username = 'stbarnar';
		$password = 'nono123';
		$con;
		try {
		$con = new PDO("mysql:host=$hostname;dbname=stbarnar_db", $username, $password);
		}
		catch(PDOException $e)
		{
		echo $e->getMessage();
		}

		$stmt = $con->prepare("select * from proj_location");
		$stmt->execute();
		$locations = $stmt->fetchAll(PDO::FETCH_ASSOC);

		return $locations;
	}

	function loadNetworks()
	{
		$hostname = 'localhost';
		$username = 'stbarnar';
		$password = 'nono123';
		$con;
		try {
		$con = new PDO("mysql:host=$hostname;dbname=stbarnar_db", $username, $password);
		}
		catch(PDOException $e)
		{
		echo $e->getMessage();
		}

		$stmt = $con->prepare("select * from proj_network");
		$stmt->execute();
		$networks = $stmt->fetchAll(PDO::FETCH_ASSOC);

		return $networks;
	}

	function loadFirstNames()
	{
		$hostname = 'localhost';
		$username = 'stbarnar';
		$password = 'nono123';
		$con;
		try {
		$con = new PDO("mysql:host=$hostname;dbname=stbarnar_db", $username, $password);
		}
		catch(PDOException $e)
		{
		echo $e->getMessage();
		}

		$stmt = $con->prepare("select * from proj_user");
		$stmt->execute();
		$firstnames = $stmt->fetchAll(PDO::FETCH_ASSOC);

		return $firstnames;
	}

	function loadLastNames()
	{
		$hostname = 'localhost';
		$username = 'stbarnar';
		$password = 'nono123';
		$con;
		try {
		$con = new PDO("mysql:host=$hostname;dbname=stbarnar_db", $username, $password);
		}
		catch(PDOException $e)
		{
		echo $e->getMessage();
		}

		$stmt = $con->prepare("select * from proj_user");
		$stmt->execute();
		$lastnames = $stmt->fetchAll(PDO::FETCH_ASSOC);

		return $lastnames;
	}

	function loadServiceTags()
	{
		$hostname = 'localhost';
		$username = 'stbarnar';
		$password = 'nono123';
		$con;
		try {
		$con = new PDO("mysql:host=$hostname;dbname=stbarnar_db", $username, $password);
		}
		catch(PDOException $e)
		{
		echo $e->getMessage();
		}

		$stmt = $con->prepare("select * from proj_item");
		$stmt->execute();
		$serviceTags = $stmt->fetchAll(PDO::FETCH_ASSOC);

		return $serviceTags;
	}

	function loadEmails()
	{
		$hostname = 'localhost';
		$username = 'stbarnar';
		$password = 'nono123';
		$con;
		try {
		$con = new PDO("mysql:host=$hostname;dbname=stbarnar_db", $username, $password);
		}
		catch(PDOException $e)
		{
		echo $e->getMessage();
		}

		$stmt = $con->prepare("select * from proj_user");
		$stmt->execute();
		$emails = $stmt->fetchAll(PDO::FETCH_ASSOC);

		return $emails;
	}

	function loadCheckedOutServiceTags(){
		$hostname = 'localhost';
		$username = 'stbarnar';
		$password = 'nono123';
		$con;
		try {
		$con = new PDO("mysql:host=$hostname;dbname=stbarnar_db", $username, $password);
		}
		catch(PDOException $e)
		{
		echo $e->getMessage();
		}

		$stmt = $con->prepare("SELECT * from proj_item WHERE ItemID in(Select ItemID from proj_checkout where InDate IS NULL)");
		$stmt->execute();
		$serviceTags = $stmt->fetchAll(PDO::FETCH_ASSOC);

		return $serviceTags;
	}