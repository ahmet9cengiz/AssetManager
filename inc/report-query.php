<?php
  $RST = array();
  $RMaN = array();
  $RCN = array();
  $RMoN = array();
  $RNN = array();
  $RLocN = array();
  $RFN = array();
  $RLN = array();
  $stmt = $con->prepare("call ReportSearch()");
  $stmt->execute();
  while($row = $stmt->fetch(PDO::FETCH_ASSOC))
  {
      $RST[] = $row['ServiceTag'];
      $RMaN[] = $row['ManufacturerName'];
      $RCN[] = $row['CategoryName'];
      $RMoN[] = $row['ModelNumber'];
      $RNN[] = $row['NetworkName'];
      $RLocN[] = $row['LocationName'];
      $RFN[] = $row['FirstName'];
      $RLN[] = $row['LastName'];
  }
  $stmt = null;
?>
