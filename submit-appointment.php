<?php
// Database connection settings
$servername = "b3_38472809_homeopathy_clinic";
$username = "b3_38472809"; // Change this if necessary
$password = "Shahidameen@1811"; // Change this if you have a password set
$dbname = "sql312.byethost3.com";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check for connection error
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data from the form
$name = $_POST['name'];
$age = $_POST['age'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$gender = $_POST['gender'];
$appointment_time = $_POST['appointment-time'];
$medical_history = $_POST['medical-history'];
$symptoms = $_POST['symptoms'];
$consultation_mode = $_POST['consultation-mode'];

// Validate form fields
if (empty($name) || empty($age) || empty($phone) || empty($email) || empty($gender) || empty($appointment_time) || empty($symptoms) || empty($consultation_mode)) {
    echo "Error: All required fields must be filled!";
    exit;
}

// Insert data into database
$sql = "INSERT INTO appointments (name, age, phone, email, gender, appointment_time, medical_history, symptoms, consultation_mode) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sisssssss", $name, $age, $phone, $email, $gender, $appointment_time, $medical_history, $symptoms, $consultation_mode);

if ($stmt->execute()) {
  echo "<script>
    alert('Appointment booked successfully!');
    window.location.href = 'index.html';
    </script>";

} else {
    echo "<script>
    alert('Error booking appointment. Please try again.');
    window.history.back();
    </script>";
    
}

// Close connection
$stmt->close();
$conn->close();
?>