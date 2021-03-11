<?php
    session_start();
    include("../../includes/config.php");

    if(isset($_POST['upload'])){
                                                
            $userid = $_POST['userid'];
            $filename = addslashes($_FILES['img']['name']);
            $tmpname = addslashes(file_get_contents($_FILES['img']['tmp_name']));
            $filetype = addslashes($_FILES['img']['type']);
            $target = "../../images/profile_photo/";
            $targetpath = $target . $filename;
            
            
          
            $array = array('jpg', 'jpeg');
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
          
              if(!empty($filename)){
                move_uploaded_file($_FILES['img']['tmp_name'], $targetpath);
                if(in_array($ext, $array)){

                      $sql ="UPDATE users SET photo_file ='images/profile_photo/$filename' where userid = $userid;";
                      $result =mysqli_query($conn, $sql);
                      if($result){
                            $_SESSION['message'] = "Profile Picture has been changed!";
                            $_SESSION['msg_type'] = "success";

                            header("location: ../profile.php");
                      }
                        else{
                            $_SESSION['message'] = "Error Uploading Picture!";
                            $_SESSION['msg_type'] = "danger";

                            header("location: ../profile.php");
                        }
                }
                else{
                    $_SESSION['message'] = "Upload Only jpg or jpeg format";
                    $_SESSION['msg_type'] = "warning";

                    header("location: ../profile.php");
                } 
            }
            else{
                $_SESSION['message'] = "Please select an image";
                $_SESSION['msg_type'] = "info";

                header("location: ../profile.php");
              }

    }
?>