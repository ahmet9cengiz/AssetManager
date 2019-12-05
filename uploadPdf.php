<?php
    session_start();
    require_once "inc/dbconnect.php";
    $stmt = null;
    if(isset($_POST['submit'])){

        $serviceTag = $_POST['up-service-tag'];
        $message ="";

        //echo 'Service Tag: '.$serviceTag. '<br>First Name: '.$firstName. '<br>Last Name: '.$lastName;

        $file = $_FILES['uploaded-pdf'];
        $fileName = $file['name'];
        $fileTmpName = $file['tmp_name'];
        $fileSize = $file['size'];
        $fileError = $file['error'];
        $fileType = $file['type'];
        $fileUniqName = "";

        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));

        $allowedExt = array('pdf');

        if(in_array($fileActualExt, $allowedExt)){
            if($fileError === 0){
                if($fileSize < 50000){ //50mb
                    $fileUniqName = uniqid('', true);
                    $fileUniqName = $fileUniqName . "." . $fileActualExt;
                    $fileDestination = '/home/stbarnar/htdocs/asset_mgt/pdfs/' . $fileUniqName;
                    move_uploaded_file($fileTmpName, $fileDestination);
                    $message = "File is successfully uploaded!";
                }
                else{
                    $message = "File size exceeds limit!";
                }
            }
            else{
                $message = "There was an error uploading your file!";
            }
        }
        else{
            $message = "You cannot upload files other than pdf!";
        }

        if($message == "File is successfully uploaded!"){ //upload successfull

            $stmt = NULL;
            $stmt = $con->prepare("call Update_Pdf(?,?)");

            $variableArray = array($serviceTag, $fileUniqName);
            $stmt->execute($variableArray);

            if ($stmt->rowCount()){
                //do nothing
            } else{
                $message = "File couldn't be uploaded!"; 
            }

            $stmt = null;
        }

        $_SESSION['message'] = $message;

        header("location:forms.php");
    }

?>
