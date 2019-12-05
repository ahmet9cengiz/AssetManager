<?php
  // USER
  $FN = array();
  $LN = array();
  $Email= array();
  $PhNum = array();
  $Room = array();
  $stmt = $con->prepare("select * from userlist");
  $stmt->execute();
  while($row = $stmt->fetch(PDO::FETCH_ASSOC))
  {
      $FN[] = $row['FirstName'];
      $LN[] = $row['LastName'];
      $Email[] = $row['email'];
      $PhNum[] = $row['phone'];
      $Room[] = $row['room'];
  }
  $stmt = null;

  // CATEGORY
  $CName = array();
  $stmt = $con->prepare("select * from categorylist");
  $stmt->execute();
  while($row = $stmt->fetch(PDO::FETCH_ASSOC))
  {
      $CName[] = $row['CategoryName'];
  }
  $stmt = null;

  // MANUFACTURER
  $MName = array();
  $MPhNum = array();
  $MWeb = array();
  $stmt = $con->prepare("select * from manufacturerlist");
  $stmt->execute();
  while($row = $stmt->fetch(PDO::FETCH_ASSOC))
  {
      $MName[] = $row['ManufacturerName'];
      $MPhNum[] = $row['ManufacturerPhoneNumber'];
      $MWeb[] = $row['ManufacturerWebsite'];
  }
  $stmt = null;

  // MODEL
  $MoNum = array();
  $MoName = array();
  $MoManu = array();
  $MoCat = array();
  $stmt = $con->prepare("select * from modellist");
  $stmt->execute();
  while($row = $stmt->fetch(PDO::FETCH_ASSOC))
  {
    $MoNum[] = $row['ModelNumber'];
    $MoName[] = $row['ModelName'];
    $MoManu[] = $row['ManufacturerName'];
    $MoCat[] = $row['CategoryName'];
  }
  $stmt = null;

  // LOCATION
  $LocName = array();
  $stmt = $con->prepare("select * from locationlist");
  $stmt->execute();
  while($row = $stmt->fetch(PDO::FETCH_ASSOC))
  {
      $LocName[] = $row['LocationName'];
  }
  $stmt = null;

  // NETWORK
  $NetName = array();
  $stmt = $con->prepare("select * from networklist");
  $stmt->execute();
  while($row = $stmt->fetch(PDO::FETCH_ASSOC))
  {
      $NetName[] = $row['NetworkName'];
  }
  $stmt = null;
?>
