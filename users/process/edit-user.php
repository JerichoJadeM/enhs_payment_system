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

            $admin_name = $fname . " " . $mname . ". " . $lname;
    
            if(isset($_GET['editstudent'])){
                $fname = $_GET['fname'];
                $mname = $_GET['mname'];
                $lname = $_GET['lname'];
                $grade = $_GET['grade'];
                $section = $_GET['section'];
                $LRN = $_GET['LRN'];
                $address = $_GET['address'];
                $parent = $_GET['parent'];
                $parentNum = $_GET['parentNum'];
        
                $conn->query("UPDATE students SET Fname='$fname', Mname='$mname', Lname='$lname', GradeLevel='$grade', Section='$section', 
                Address='$address', GuardianName='$parent', GuardianNum='$parentNum' WHERE LRN_number='$LRN' ") or die($conn->error);
        
                if($usertype=="Accountant"){
                    $_SESSION['message'] = "Student with LRN Number: <strong>" . $LRN . "</strong> has been updated!";
                    $_SESSION['msg_type'] = "warning";
        
                    header("location: ../acc/students.php");
                }else{
                    $_SESSION['message'] = "Student with LRN Number: <strong>" . $LRN . "</strong> has been updated!";
                    $_SESSION['msg_type'] = "warning";
        
                    header("location: ../adv/students.php");
                }
            }
    
    if(isset($_GET['edituser'])){
        $id = $_GET['userid'];
        //$username = $_GET['username'];
        $fname = $_GET['fname'];
        $mname = $_GET['mname'];
        $lname = $_GET['lname'];
        //$type = $_POST['usertype'];
        $phone = $_GET['phone'];
        $email = $_GET['email'];
        $address = $_GET['address'];
        $city = $_GET['city'];
        $country = $_GET['country'];
        $postal = $_GET['postal'];
        $about = $_GET['about'];
        //$file = $_GET['file'];

        $conn->query("UPDATE users SET fname='$fname', mname='$mname', lname='$lname', phone='$phone', email='$email', address='$address', city='$city', country='$country', postal_code='$postal', about='$about' WHERE userid='$id' ") or die($conn->error);

        if($usertype == "Accountant"){
            $_SESSION['message'] = "Your profile has been updated!";
            $_SESSION['msg_type'] = "success";

            header("location: ../acc/user.php");
        }
        else{
            $_SESSION['message'] = "Your profile has been updated!";
            $_SESSION['msg_type'] = "success";

            header("location: ../adv/user.php");
        }

        
    }
?>