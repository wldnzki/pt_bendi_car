<?php
// Termasuk file koneksi
include 'db_connect.php';

// Ambil data dari form
$username = $_POST['username'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash password
$fullname = $_POST['fullname'];
$dob = $_POST['dob'];
$address = $_POST['address'];
$gender = $_POST['gender'];
$phone = $_POST['phone'];

// Query untuk menyimpan data
$sql = "INSERT INTO users (username, email, password, fullname, dob, address, gender, phone) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssssss", $username, $email, $password, $fullname, $dob, $address, $gender, $phone);

if ($stmt->execute()) {
    // Redirect ke halaman login
    header("Location: login.html");
    exit();
} else {
    echo "Error: " . $stmt->error;
}

// Tutup koneksi
$stmt->close();
$conn->close();
?>
