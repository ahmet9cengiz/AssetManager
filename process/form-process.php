<?php
    session_start();
    require_once "../inc/dbconnect.php";
	$message = '';
    $stmt = null;
    
    if(isset($_POST['out-submit'])){
        
        $itemID = $_POST['out-service-tag'];
        $userID = $_POST['out-email'];
        $loanDate = $_POST['out-loan-date'];
        $fileName = null;

        $stmt = $con->prepare("call Check_Item_User(?);"); 
        $stmt->execute(array($itemID));
        $row = $stmt->fetch(PDO::FETCH_OBJ);
        $uid = $row->UserID;
        
        if($uid != 97){
            $message = "Item is not available!";
            $_SESSION['message'] = $message;
            header("location:../forms.php");
        }
        else{

            $file = $_FILES['out-upload-pdf'];
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
                        //$fileDestination = '/home/stbarnar/htdocs/asset_mgt/pdfs/' . $fileUniqName;
                        $fileDestination = '/home/ahcengiz/htdocs/base_files/loanForms/' . $fileUniqName;
                        move_uploaded_file($fileTmpName, $fileDestination);
                        $message = "File is successfully uploaded!";
                    }
                    else{
                        $message = "File size exceeds limit!";
                        $_SESSION['message'] = $message;
                        header("location:../forms.php");
                    }
                }
                else{
                    $message = "There was an error uploading the file";
                    $_SESSION['message'] = $message;
                    header("location:../forms.php");
                }
            }
            else{
                $message = "You cannot upload files other than pdf!";
                $_SESSION['message'] = $message;
                header("location:../forms.php");
            }

            if($message == "File is successfully uploaded!"){ //upload successfull


                $stmt = null;
                $stmt = $con->prepare("call Add_Checkout(?, ?, ?, ?);"); 
                $stmt->execute(array($itemID, $userID, $fileUniqName, $loanDate));

                if ($stmt->rowCount()){
                    $stmt = null;
                    $stmt = $con->prepare("call Reassign_Item_User(?, ?);"); 
                    $stmt->execute(array($itemID, $userID));

                    if($stmt->rowCount()){
                        //do nothing
                    }
                    else{
                        $message = "Item user couldn't be changed";
                        $_SESSION['message'] = $message;
                        header("location:../forms.php");
                    }
                } else{
                    $message = "There was an error checking-out the item";
                    $_SESSION['message'] = $message;
                    header("location:../forms.php");
                }

            }
            $_SESSION['message'] = $message;

            header("location:../forms.php");
        }
    }

?>
