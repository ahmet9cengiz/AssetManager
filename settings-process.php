<?php
    require_once "dbconnect.php";

    $stmt1 = $con->prepare("SELECT CategoryName FROM proj_category where Category.CategoryID > 0");
    $stmt1->execute();
    
    while($row = $stmt->fetch(PDO::FETCH_ASSOC))
    {
        header("location:lab4_test_success.php");
    }
?>