<?php
    //edit user and students are in the edit-user.php
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
    //students CRUD process
    If(isset($_POST['addstudent'])){

        $fname = $_POST['fname'];
        $mname = $_POST['mname'];
        $lname = $_POST['lname'];
        $grade = $_POST['grade'];
        $section = $_POST['section'];
        $LRN = $_POST['LRN'];
        $address = $_POST['address'];
        $parent = $_POST['parent'];
        $parentNum = $_POST['parentNum'];

        $sql = $conn->query("INSERT INTO students
        (LRN_number, Lname, Mname, Fname, GradeLevel, Section, GuardianName, GuardianNum, Address)
        VALUES
        ('$LRN', '$lname', '$mname', '$fname', '$grade', '$section', '$parent', '$parentNum', '$address')") or
         die($conn->error);

         $payment = $conn->query("INSERT INTO payment (LRN, amount) VALUES ('$LRN', 0)") or die($conn->error);

         $activity = "Added record of student: " . $fname . " " . $mname . ". " . $lname;
         $act = $conn->query("INSERT INTO activities (user_type, name, activity, activity_date)
         VALUES
         ('$usertype', '$admin_name', '$activity', CURRENT_DATE())") or die($conn->error);

        if($usertype=="Accountant"){
            $_SESSION['message'] = "New student record has been saved!";
            $_SESSION['msg_type'] = "success";

            header("location: ../acc/students.php");
        }else{
            $_SESSION['message'] = "New student record has been saved!";
            $_SESSION['msg_type'] = "success";

            header("location: ../adv/students.php");
        }    
    }

    if(isset($_POST['delete'])){
        $id=$_POST['LRN'];

        $conn->query("DELETE FROM students WHERE LRN_number = '$id' ") or die($conn->error());
        $conn->query("DELETE FROM payment WHERE LRN = '$id' ") or die($conn->error());

        $activity = "Deleted student record with LRN number of: " . $id;
        $act = $conn->query("INSERT INTO activities (user_type, name, activity, activity_date)
        VALUES
        ('$usertype', '$admin_name', '$activity', CURRENT_DATE())") or die($conn->error);

        if($usertype=="Accountant"){
            $_SESSION['message'] = "Student with LRN Number: <strong>" . $id . "</strong> has been deleted!";
            $_SESSION['msg_type'] = "danger";

            header("location: ../acc/students.php");
        }else{
            $_SESSION['message'] = "Student with LRN Number: <strong>" . $id . "</strong> has been deleted!";
            $_SESSION['msg_type'] = "danger";
    
            header("location: ../acc/students.php");
        } 
    }

    //Users' CRUD process

    if(isset($_POST['addUser'])){

        $username = $_POST['username'];
        $pass = $_POST['password'];
        $ufname = $_POST['ufname'];
        $umname = $_POST['umname'];
        $ulname = $_POST['ulname'];
        $utype = $_POST['usertype'];
        $ugrade = $_POST['ugrade'];
        $usection = $_POST['usection'];
        $uphone = $_POST['uphone'];
        $uemail = $_POST['uemail'];
        $uaddress = $_POST['uaddress'];
        $ucity = $_POST['ucity'];
        $ucountry = $_POST['ucountry'];
        $upostal = $_POST['upostal'];
        $about = $_POST['about'];
        $file = $_POST['file'];

        $sql = $conn->query("INSERT INTO users
        (username, password, fname, mname, lname, phone, user_type, grade, section, email, address, city, country, postal_code, about, photo_file)
        VALUES
        ('$username', '$pass', '$ufname', '$umname', '$ulname', '$uphone', '$utype', '$ugrade', '$usection', '$uemail', '$uaddress', '$ucity', '$ucountry', '$upostal', '$about', '../assets/img/+$file' )") or
         die($conn->error);

        if($usertype=="Accountant"){
            $_SESSION['message'] = "Payment Saved!";
            $_SESSION['msg_type'] = "success";

            header("location: ../acc/index.php");
        }else{
            $_SESSION['message'] = "Payment Saved!";
            $_SESSION['msg_type'] = "success";

            header("location: ../adv/index.php");
        } 
    }
?>