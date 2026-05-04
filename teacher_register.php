<?php

/*Connect PHP to MySQL database */
$servername = "localhost";
$username = "root";
$password = "";
$database = "our_database_name";

/*Create database connection*/
$conn = new mysqli($servername, $username, $password, $database);

/*Check if connection failed*/
if ($conn->connect_error) {die("Connection failed: " . $conn->connect_error);}

/*Only run when Register button is clicked*/
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    /*Get values from submitted form*/
    $first_name = trim($_POST['first_name']);
    $last_name = trim($_POST['last_name']);
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $marital_status = $_POST['marital_status'];
    $nationality = $_POST['nationality'];
    $national_id = trim($_POST['national_id']);

    $phone = trim($_POST['phone']);
    $email = trim($_POST['email']);
    $address = trim($_POST['address']);

    $qualification = $_POST['qualification'];
    $field_of_study = trim($_POST['field_of_study']);
    $institution = trim($_POST['institution']);
    $grad_year = $_POST['grad_year'];

    $department = $_POST['department'];
    $subject_assigned = $_POST['subject_assigned'];
    $class_assigned = $_POST['class_assigned'];
    $experience = $_POST['experience'];

    $staff_id = trim($_POST['staff_id']);
    $date_employed = $_POST['date_employed'];
    $employment_type = $_POST['employment_type'];

    $username_input = trim($_POST['username']);
    $password_input = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    /*Check important fields*/
    if (empty($first_name) || empty($last_name)) {
    die("First name and Last name are required.");}

    /*Check if email is valid*/
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("Invalid email format.");}

    /*Check if passwords match*/
    if ($password_input !== $confirm_password) {
        die("Passwords do not match.");
    }

    /*Prevent duplicate email or username*/
$check_sql = "SELECT * FROM teachers WHERE email='$email'OR username='$username_input'";

    $result = $conn->query($check_sql);
    if ($result->num_rows > 0) {
     die("Teacher already exists or username taken.");}

    /* Save teacher information*/
    $sql = "INSERT INTO teachers (first_name, last_name, dob, gender, marital_status, nationality, national_id, phone, email,
        address, qualification, field_of_study, institution, grad_year, department, subject_assigned, class_assigned, experience, staff_id, date_employed, employment_type, username,
        password, profile_photo, certificate, national_id_copy) VALUES ($first_name', '$last_name', '$dob', '$gender', '$marital_status', '$nationality', '$national_id', '$phone', '$email', '$address', '$qualification', '$field_of_study', '$institution', '$grad_year', '$department', '$subject_assigned', '$class_assigned', '$experience', '$staff_id', '$date_employed', '$employment_type', '$username_input', '$hashed_password', '$profile_photo_path', '$certificate_path', '$national_id_copy_path'
    )";

 if ($conn->query($sql) === TRUE) {
        echo "Teacher registered successfully.";}

    else {echo "Error: " . $conn->error;}
$conn->close();
}
?>