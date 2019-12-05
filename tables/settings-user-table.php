<?php
	  $SUTFN = array();
    $SUTLN = array();
    $SUTE = array();
    $SUTPH = array();
    $SUTR = array();
	  $stmt = $con->prepare("select * from UserList;");
    $stmt->execute();
    while($row = $stmt->fetch(PDO::FETCH_ASSOC))
    {
        $SUTFN[] = $row['FirstName'];
        $SUTLN[] = $row['LastName'];
        $SUTE[] = $row['email'];
        $SUTPH[] = $row['phone'];
        $SUTR[] = $row['room'];
    }
    $stmt = null;
?>
