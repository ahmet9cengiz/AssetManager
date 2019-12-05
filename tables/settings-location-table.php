<?php

  // LOCATION
  $LocName = array();
  $stmt = $con->prepare("select * from LocationList");
  $stmt->execute();
  while($row = $stmt->fetch(PDO::FETCH_ASSOC))
  {
      $LocName[] = $row['LocationName'];
  }
  $stmt = null;

?>