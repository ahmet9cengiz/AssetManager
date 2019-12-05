<?php
    //Active Desktop
    $stmt = $con->prepare("call Active_Desktop('select ServiceTag from proj_item');");
    $stmt->execute();
    $row = $stmt->fetch();
    $AD = $row['count(ServiceTag)'];
    if($AD == '')
    {
        $AD = '0';
    }
    $stmt = null;
    //Surplus Desktop
    $stmt2 = $con->prepare("call Surplus_Desktop('select ServiceTag from proj_item');");
    $stmt2->execute();
    $row2 = $stmt2->fetch();
    $SD = $row2['count(ServiceTag)'];
    if($SD == NULL)
    {
        $SD = '0';
    }
    $stmt2 = null;

    //Active Laptop
    $stmt3 = $con->prepare("call Active_Laptop('select ServiceTag from proj_item');");
    $stmt3->execute();
    $row3 = $stmt3->fetch();
    $AL = $row3['count(ServiceTag)'];
    if($AL == '')
    {
        $AL = '0';
    }
    $stmt3 = null;
    //Surplus Laptop
    $stmt4 = $con->prepare("call Surplus_Laptop('select ServiceTag from proj_item');");
    $stmt4->execute();
    $row4 = $stmt4->fetch();
    $SL = $row4['count(ServiceTag)'];
    if($SL == '')
    {
        $SL = '0';
    }
    $stmt4 = null;


    //Active Tablet
    $stmt5 = $con->prepare("call Active_Tablet('select ServiceTag from proj_item');");
    $stmt5->execute();
    $row5 = $stmt5->fetch(PDO::FETCH_ASSOC);
    $AT = $row5['count(ServiceTag)'];
    if($AT == '')
    {
        $AT = '0';
    }
    $stmt5 = null;
    // Surplus Tablet
    $stmt6 = $con->prepare("call Surplus_Tablet('select ServiceTag from proj_item')");
    $stmt6->execute();
    $row6 = $stmt6->fetch(PDO::FETCH_ASSOC);
    $ST = $row6['count(ServiceTag)'];
    if($ST == '')
    {
        $ST = '0';
    }
    $stmt6 = null;

    //Active Printer
    $stmt7 = $con->prepare("call Active_Printer('select ServiceTag from proj_item');");
    $stmt7->execute();
    $row7 = $stmt7->fetch(PDO::FETCH_ASSOC);
    $AP = $row7['count(ServiceTag)'];
    if($AP == '')
    {
        $AP = '0';
    }
    $stmt7 = null;
    // Surplus Printer
    $stmt8 = $con->prepare("call Surplus_Printer('select ServiceTag from proj_item');");
    $stmt8->execute();
    $row8 = $stmt8->fetch(PDO::FETCH_ASSOC);
    $SP = $row8['count(ServiceTag)'];
    if($SP == '')
    {
        $SP = '0';
    }
    $stmt8 = null;


    //Active Video Conferencing
    $stmt9 = $con->prepare("call Active_VC('select ServiceTag from proj_item');");
    $stmt9->execute();
    $row9 = $stmt9->fetch(PDO::FETCH_ASSOC);
    $AVC = $row9['count(ServiceTag)'];
    if($AVC == '')
    {
        $AVC = '0';
    }
    $stmt9 = null;
    // Surplus Video Conferencing
    $stmt10 = $con->prepare("call Surplus_VC('select ServiceTag from proj_item');");
    $stmt10->execute();
    $row10 = $stmt10->fetch(PDO::FETCH_ASSOC);
    $SVC = $row10['count(ServiceTag)'];
    if($SVC == '')
    {
        $SVC = '0';
    }
    $stmt10 = null;

    //Verify Alert
    $VST = array();
    $VMN = array();
    $VNN = array();
    $VLoc = array();
    $VFN = array();
    $VLN = array();
    $stmt11 = $con->prepare("call Verify_Alert()");
    $stmt11->execute();
    while($row11 = $stmt11->fetch(PDO::FETCH_ASSOC))
    {
        $VST[] = $row11['ServiceTag'];
        $VMN[] = $row11['ModelNumber'];
        $VNN[] = $row11['NetworkName'];
        $VLoc[] = $row11['LocationName'];
        $VFN[] = $row11['FirstName'];
        $VLN[] = $row11['LastName'];
    }
    $stmt11 = null;
?>
