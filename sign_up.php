<?php
    session_start();
    include 'includes/conn.php';

    if(isset($_POST['add']) && $_POST['g-recaptcha-response'] != "") {
    $secret = '6LdRBqsfAAAAAIwmnnQLsBC6n3mdQHVluhhmeHz2';
    $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $_POST['g-recaptcha-response']);
    $responseData = json_decode($verifyResponse);
    if ($responseData->success) {
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $filename = $_FILES['photo']['name'];
        $validImageExtension = ['jpg', 'jpeg', 'png'];
    $imageExtension = explode('.', $filename);
    $imageExtension = strtolower(end($imageExtension));
    if ( !in_array($imageExtension, $validImageExtension) ){
    
    $_SESSION['error'] =  'Invalid Images';
    }
        else{
        if(!empty($filename)){
            move_uploaded_file($_FILES['photo']['tmp_name'], '../images/'.$filename);   
        }
        
        $course = $_POST['course'];
        $status = $_POST['status'];
        $voters_id = $_POST['voters_id'];
        $checkUser = "SELECT * FROM voters WHERE voters_id ='$voters_id'";
        $result = mysqli_query($conn , $checkUser);
        $count = mysqli_num_rows($result);
        if($count>0){
                $_SESSION['error'] = 'ID already exist';
            }
        else{
            $sql = "INSERT INTO voters (voters_id, password, firstname, lastname,  course, status, photo) VALUES ('$voters_id', '$password', '$firstname', '$lastname','$course',       '$status' , '$filename')";
        if($conn->query($sql)){
            $_SESSION['success'] = 'Voter added successfully';
        }

        else{
            $_SESSION['error'] = "You are Failed to Register";
        }
        }
    }   
    }
    else{
            $_SESSION['error'] = "You are Failed to Register";
        }
}
else{
            $_SESSION['error'] = "Check the Captcha";
        }


    header('location: index.php');