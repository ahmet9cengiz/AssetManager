<?php

  $TMName = array();
  $TMPhNum = array();
  $TMWeb = array();
  $stmt = $con->prepare("select * from ManufacturerList");
  $stmt->execute();
  while($row = $stmt->fetch(PDO::FETCH_ASSOC))
  {
      $TMName[] = $row['ManufacturerName'];
      $TMPhNum[] = $row['ManufacturerPhoneNumber'];
      $TMWeb[] = $row['ManufacturerWebsite'];
  }
  $stmt = null;

 ?>
