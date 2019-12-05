<?php
  // MODEL
  $MoNum = array();
  $MoName = array();
  $MoManu = array();
  $MoCat = array();
  $stmt = $con->prepare("select * from ModelList");
  $stmt->execute();
  while($row = $stmt->fetch(PDO::FETCH_ASSOC))
  {
    $MoNum[] = $row['ModelNumber'];
    $MoName[] = $row['ModelName'];
    $MoManu[] = $row['ManufacturerName'];
    $MoCat[] = $row['CategoryName'];
  }
  $stmt = null;
?>