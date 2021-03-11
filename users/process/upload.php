<?php
    session_start();
    include("../../includes/config.php");
    $user = $_SESSION['alogin'];

    $fetch_user = "SELECT fname, mname, lname, user_type  FROM users WHERE username='$user';";
            $result = $conn->query($fetch_user);
            $row = $result->fetch_assoc();
            
            $fname = $row['fname'];
            $mname = $row['mname'];
            $lname = $row['lname'];
            $usertype = $row['user_type'];

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
                        if($usertype == "Accountant"){
                          $_SESSION['message'] = "Profile Picture has been changed!";
                          $_SESSION['msg_type'] = "success";

                            header("location: ../acc/user.php");

                        }else{
                          $_SESSION['message'] = "Profile Picture has been changed!";
                          $_SESSION['msg_type'] = "success";

                          header("location: ../adv/user.php");
                        }
                           
                      }
                        else{
                          if($usertype == "Accountant"){
                            $_SESSION['message'] = "Error Uploading Picture!";
                            $_SESSION['msg_type'] = "danger";

                            header("location: ../acc/user.php");
                          }else{
                            $_SESSION['message'] = "Error Uploading Picture!";
                            $_SESSION['msg_type'] = "danger";

                            header("location: ../adv/user.php");
                          }
                        }
                }
                else{
                  if($usertype == "Accountant"){
                    $_SESSION['message'] = "Upload Only jpg or jpeg format";
                    $_SESSION['msg_type'] = "warning";

                    header("location: ../acc/user.php");
                  }else{
                    $_SESSION['message'] = "Upload Only jpg or jpeg format";
                    $_SESSION['msg_type'] = "warning";

                    header("location: ../adv/user.php");
                  }
                } 
            }
            else{
              if($usertype == "Accountant"){
                $_SESSION['message'] = "Please select an image";
                $_SESSION['msg_type'] = "info";

                header("location: ../acc/user.php");
              }else{
                $_SESSION['message'] = "Please select an image";
                $_SESSION['msg_type'] = "info";

                header("location: ../adv/user.php");
              }
            }
    }
?>