<?php
	require_once "dbconnect.php";

	if(isset($_POST['categoryID']) && isset($_POST['manufacturerID']))
	{
		$categoryID = $_POST['categoryID'];
		$manufacturerID = $_POST['manufacturerID'];

		$stmt = $con->prepare("call Model_by_Manufacturer_and_Category(?, ?);");
		$stmt->execute(array($manufacturerID, $categoryID));
		$models = $stmt->fetchAll(PDO::FETCH_ASSOC);
		echo json_encode($models);
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
