<?php

    $CurST = Array();
    $CurEmail = Array();
    $CurLoanDate = Array();
    $CurLoanForm = Array();

    $HistST = Array();
    $HistEmail = Array();
    $HistLoanDate = Array();
    $HistReturnDate = Array();
    $HistLoanForm = Array();

    $stmt = $con->prepare("select * from Checkout_Current");
    $stmt->execute();
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $CurST[] = $row['ServiceTag'];
        $CurEmail[] = $row['email'];
        $CurLoanForm[] = $row['PDF'];
        $CurLoanDate[] = $row['OutDate'];
    }

    $stmt = null;
    $stmt = $con->prepare("select * from Checkout_History");
    $stmt->execute();
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $HistST[] = $row['ServiceTag'];
        $HistEmail[] = $row['email'];
        $HistLoanForm[] = $row['PDF'];
        $HistLoanDate[] = $row['OutDate'];
        $HistReturnDate[] = $row['InDate'];
    }

    $stmt=null;
?>