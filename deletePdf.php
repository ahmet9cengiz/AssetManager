<?php
    session_start();
    require_once "inc/dbconnect.php";

    $stmt = null;

    if(isset($_POST['submit'])){

        $serviceTag = $_POST['del-service-tag'];
        $message ="";
        $fileName = null;

        //get the link from the database
        $stmt = NULL;
        $sql = "SELECT * FROM proj_item WHERE ServiceTag=" . $serviceTag . "";
        $stmt = $con->prepare("SELECT * FROM proj_item WHERE ServiceTag=?");

        $stmt->execute([$serviceTag]);

        $row = $stmt->fetch();
        $fileUniqName = $row['PDF'];

        $filePath = '/home/stbarnar/htdocs/asset_mgt/pdfs/' . $fileUniqName;

        $stmt = null;

        //delete the link from database
        $stmt = $con->prepare("call Update_Pdf(?,?)");

        $variableArray = array($serviceTag, $fileName);
        $stmt->execute($variableArray);

        $stmt = null;

        echo $filePath;

        
        if(!unlink($filePath)){
            $message = "Error: Couldn't delete file!"; 
        }
        else{
            $message = "File is successfully deleted!";
        }

        $_SESSION['message'] = $message;

        header("location:forms.php");
        
    }

