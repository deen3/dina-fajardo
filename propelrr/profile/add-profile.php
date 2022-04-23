<?php

require "connection.php";

$errors = [];
$data = [];

// Validation
$required_fields = ['full_name', 'email_address', 'mobile_number', 'bday', 'gender'];
foreach($required_fields AS $field) {
    if (empty($_POST[$field])) {
        $errors[str_replace('_', '-', $field)] = str_replace('_', ' ', $field)." is required.";
    }    
}

$name_regex = "/^[A-Za-z., ]*$/";
$mobile_regex = "/^09[0-9]{9}$/";

if (!preg_match($name_regex, $_POST['full_name'])) {
    $errors['full-name'] = 'Full name can only be letters, period and comma.';
} 
if (!filter_var($_POST['email_address'], FILTER_VALIDATE_EMAIL)) {
    $errors['email-address'] = 'Invalid email format.';
} 
if (!preg_match($mobile_regex, $_POST['mobile_number'])) {
    $errors['mobile-number'] = 'Invalid mobile number format.';
} 

if (!empty($errors)) {
    $data['success'] = false;
    $data['errors'] = $errors;
    echo json_encode($data);
    exit;
}

// Execution
try {
    $conn = connection();

    $name = $_POST['full_name'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $bday = $_POST['bday'];
    $mobile_number = $_POST['mobile_number'];
    $email_address = $_POST['email_address'];

    $sql = "INSERT INTO `profile` (`name`, age, gender, bday, mobile_number, email_address) VALUES ('$name', '$age', '$gender', '$bday', '$mobile_number', '$email_address')";
    $conn->exec($sql);
    $data['success'] = true;
    
} catch(PDOException $e) {
    $data['success'] = false;
    $data['errors']['sql'] = $e->getMessage();
}

echo json_encode($data);
