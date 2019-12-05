<?php

  $ST = array();
  $MoNum = array();
  $MoName = array();
  $User = array();
  $purchaseDate = array();
  $wrnty = array();
  $wrnty_end = array();
  $surplus = array();
  $vdays = array();
  $lastV = array();
  $futureV = array();
  $loc = array();
  $net = array();
  $manu = array();
  $cat = array();
  $stmt = $con->prepare("select * from Item_View");
  $stmt->execute();
  while($row = $stmt->fetch(PDO::FETCH_ASSOC))
  {
    $ST[] = $row['ServiceTag'];
    $MoNum[] = $row['ModelNumber'];
    $MoName[] = $row['ModelName'];
    $User[] = $row['User'];
    $purchaseDate[] = $row['PurchaseDate'];
    $wrnty[] = $row['Warranty'];
    $wrnty_end[] = $row['WarrantyEnd'];
    $surplus[] = $row['Surplus'];
    $vdays[] = $row['VerificationDays'];
    $lastV[] = $row['LastVerify'];
    $futureV[] = $row['FutureVerify'];
    $loc[] = $row['LocationName'];
    $net[] = $row['NetworkName'];
    $manu[] = $row['ManufacturerName'];
    $cat[] = $row['CategoryName'];
  }
  $stmt = null;

?>
