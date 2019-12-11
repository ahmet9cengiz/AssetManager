<?php
    session_start();
    require_once "../inc/dbconnect.php";
	$message = '';
    $stmt = null;

    if(isset($_GET['file'])){
        $filename = $_GET['file'];
        if($filename != "no pdf"){
            $fileDestination = '../loanForms/' . $fileUniqName;

            if(!empty($filename) && file_exists($filePath)){

                //Define headers
                header("Cache-Control: public");
                header("Content-Description: FIle Transfer");
                header("Content-Disposition: attachment; filename=LoanAgreement.pdf");
                header("Content-Type: application/zip");
                header("Content-Transfer-Emcoding: binary");

                readfile($filePath);

                exit;
            }
        }
        else{
            $message = "The loan doesn't contain a loan form";
            $_SESSION['message'] = $message;
        }
        header("location:../forms.php");
    }

    if(isset($_POST['out-submit'])){
        
        $itemID = $_POST['out-service-tag'];
        $userID = $_POST['out-email'];
        $loanDate = $_POST['out-loan-date'];
        $fileName = null;
        $fileUniqName = "";

        $stmt = $con->prepare("call Check_Item_User(?);"); 
        $stmt->execute(array($itemID));
        $row = $stmt->fetch(PDO::FETCH_OBJ);
        $firstname = $row->FirstName;
        $lastname = $row->LastName;
        
        if($firstname != "None" && $lastname != "None"){
            $message = "Item is not available!";
            $_SESSION['message'] = $message;
            header("location:../forms.php");
        }
        else{
            if(is_uploaded_file($_FILES['out-upload-pdf']['tmp_name'])){//if form is submitted
                $file = $_FILES['out-upload-pdf'];
                $fileName = $file['name'];
                $fileTmpName = $file['tmp_name'];
                $fileSize = $file['size'];
                $fileError = $file['error'];
                $fileType = $file['type'];

                $fileExt = explode('.', $fileName);
                $fileActualExt = strtolower(end($fileExt));

                $allowedExt = array('pdf');

                if(in_array($fileActualExt, $allowedExt)){
                    if($fileError === 0){
                        if($fileSize < 50000){ //50mb
                            $fileUniqName = uniqid('', true);
                            $fileUniqName = $fileUniqName . "." . $fileActualExt;
                            $fileDestination = '../loanForms/' . $fileUniqName;
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
            }
            else{
                $fileUniqName = "no pdf";
                $message = "Loan successful";
            }

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

            
            $_SESSION['message'] = $message;

            header("location:../forms.php");
        }
    }

    if(isset($_POST['in-submit'])){
        
        $itemID = $_POST['in-service-tag'];
        $returnDate = $_POST['in-return-date'];

        $stmt = $con->prepare("call Get_Pdf(?)"); 
        $stmt->execute(array($itemID));
        $row = $stmt->fetch(PDO::FETCH_OBJ);
        $filename = $row->PDF;
        $userID = $row->UserID;

        $pathToPdfs = "../loanForms/";
        $filename = $pathToPdfs.$filename;

        if(is_uploaded_file($_FILES['in-upload-pdf']['tmp_name'])){//if form is submitted

            $file = $_FILES['in-upload-pdf'];
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
                        $fileDestination = '../loanForms/' . $fileUniqName;
                        move_uploaded_file($fileTmpName, $fileDestination);
                        $message = "File is successfully uploaded!";

                        if($filename != "no pdf"){ //if there was a file
                            if(!unlink($filename)){
                                $message = "There was an error updating the form";
                                $_SESSION['message'] = $message;
                                header("location:../forms.php");
                            } 
                        }   
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
        }
        else{
            $fileUniqName = "no pdf";
            $message = "Return successful";
        }

            $stmt = null;
            $stmt = $con->prepare("call Update_Checkout(?, ?, ?, ?);"); 
            $stmt->execute(array($itemID, $userID, $returnDate, $fileUniqName));

            if ($stmt->rowCount()){
                $stmt = null;
                $stmt = $con->prepare("call Item_NoUser(?);"); 
                $stmt->execute(array($itemID));

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
            $_SESSION['message'] = $message;

            header("location:../forms.php");
    }

?>
