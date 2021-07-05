<?php
    session_start();
    include("../../includes/config.php");
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
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

         $_SESSION['message'] = "New student record has been saved!";
         $_SESSION['msg_type'] = "success";

         header("location: ../students.php");
    }

    if(isset($_POST['delete'])){
        $id=$_POST['LRN'];

        $conn->query("DELETE FROM students WHERE LRN_number = '$id' ") or die($conn->error);
        $conn->query("DELETE FROM payment WHERE LRN = '$id' ") or die($conn->error);

        $activity = "Deleted student record with LRN number of: " . $id;
        $act = $conn->query("INSERT INTO activities (user_type, name, activity, activity_date)
        VALUES
        ('$usertype', '$admin_name', '$activity', CURRENT_DATE())") or die($conn->error);

        $_SESSION['message'] = "Student with LRN Number: <strong>" . $id . "</strong> has been deleted!";
        $_SESSION['msg_type'] = "danger";

        header("location: ../students.php");
    }

    if(isset($_POST['deleteUser'])){
        $id=$_POST['userid'];

        $conn->query("DELETE FROM users WHERE userid = '$id' ") or die($conn->error);

        $activity = "You have deleted User Record with an id of: " . $id;
        $act = $conn->query("INSERT INTO activities (user_type, name, activity, activity_date)
        VALUES
        ('$usertype', '$admin_name', '$activity', CURRENT_DATE())") or die($conn->error);

        $_SESSION['message'] = "User with user id: <strong>" . $id . "</strong> has been deleted!";
        $_SESSION['msg_type'] = "danger";

        header("location: ../users.php");
    }

    if(isset($_POST['deleteMsg'])){
        $id=$_POST['id'];

        $conn->query("DELETE FROM messages WHERE id = '$id' ") or die($conn->error);

        $activity = "You have deleted a message, message id: " . $id;
        $act = $conn->query("INSERT INTO activities (user_type, name, activity, activity_date)
        VALUES
        ('$usertype', '$admin_name', '$activity', CURRENT_DATE())") or die($conn->error);

        $_SESSION['message'] = "A message with message id: <strong>" . $id . "</strong> has been deleted!";
        $_SESSION['msg_type'] = "danger";

        header("location: ../inquiries.php");
    }

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

        $_SESSION['message'] = "Student with LRN Number: <strong>" . $LRN . "</strong> has been updated!";
        $_SESSION['msg_type'] = "warning";

        header("location: ../students.php");
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

         $activity = "You created User: " . $ufname . " " . $ulname;
        $act = $conn->query("INSERT INTO activities (user_type, name, activity, activity_date)
        VALUES
        ('$usertype', '$admin_name', '$activity', CURRENT_DATE())") or die($conn->error);

         $_SESSION['message'] = "New User has been created successfully!";
         $_SESSION['msg_type'] = "success";

         header("location: ../users.php");
        
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

        $_SESSION['message'] = "Your profile has been updated!";
        $_SESSION['msg_type'] = "success";

        header("location: ../profile.php");
    }

    //Saving the new Miscellaneous Fee
    if(isset($_GET['change'])){
        $ID = $_GET['feeID'];
        $changeFee = $_GET['changeFee'];

        $conn->query("UPDATE miscfee SET fee='$changeFee', dateChanged=CURRENT_DATE() WHERE feeID=1;") or die($conn->error);

        $activity = "You changed the current amount of Miscellaneous Fee";
        $act = $conn->query("INSERT INTO activities (user_type, name, activity, activity_date)
        VALUES
        ('$usertype', '$admin_name', '$activity', CURRENT_DATE())") or die($conn->error);

        $_SESSION['message'] = "You successfully changed the amount of school's Miscellaneous Fee";
        $_SESSION['msg_type'] = "success";

        header("location:../index.php");
    }
?>