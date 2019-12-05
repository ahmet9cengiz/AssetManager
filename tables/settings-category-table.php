  <?php
  	$CName = array();
  	$stmt = $con->prepare("select * from CategoryList");
  	$stmt->execute();
  	while($row = $stmt->fetch(PDO::FETCH_ASSOC))
  	{
  	  $CName[] = $row['CategoryName'];
  	}
  	$stmt = null;
?>
