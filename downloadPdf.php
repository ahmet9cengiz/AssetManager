<?php
    session_start();
    require_once "inc/dbconnect.php";

    $stmt = null;

    if(isset($_POST['submit'])){

        $serviceTag = $_POST['down-service-tag'];
        $message ="";

        //echo 'Service Tag: ' . $serviceTag

        $stmt = NULL;
        $sql = "SELECT * FROM proj_item WHERE ServiceTag=" . $serviceTag . "";
        $stmt = $con->prepare("SELECT * FROM proj_item WHERE ServiceTag=?");

        $stmt->execute([$serviceTag]);

        $row = $stmt->fetch();
        $fileUniqName = $row['PDF'];

        $stmt = null;

        $filePath = '/home/stbarnar/htdocs/asset_mgt/pdfs/' . $fileUniqName;

        if(!empty($fileUniqName) && file_exists($filePath)){

            //Define headers
            header("Cache-Control: public");
            header("Content-Description: FIle Transfer");
            header("Content-Disposition: attachment; filename=LoanAggreement.pdf");
            header("Content-Type: application/zip");
            header("Content-Transfer-Emcoding: binary");

            readfile($filePath);

            $message = "File is Downloaded!";

            exit;

        }
        else{
            $message = "This File Does not exist.";
        }
        $_SESSION['message'] = $message;
        header("location:forms.php");

    }
?>
