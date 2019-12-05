<?php

  // NETWORK
  $NetName = array();
  $stmt = $con->prepare("select * from NetworkList");
  $stmt->execute();
  while($row = $stmt->fetch(PDO::FETCH_ASSOC))
  {
      $NetName[] = $row['NetworkName'];
  }
  $stmt = null;
  
?>