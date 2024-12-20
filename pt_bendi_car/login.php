<?php
// Termasuk file koneksi
include 'db_connect.php';

// Mulai sesi
session_start();

// Ambil data dari form
$username = $_POST['username'];
$password = $_POST['password'];

// Query untuk mencari user berdasarkan username
$sql = "SELECT * FROM users WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    // Verifikasi password
    if (password_verify($password, $user['password'])) {
        // Simpan informasi user ke session
        $_SESSION['username'] = $user['username'];
        $_SESSION['fullname'] = $user['fullname'];
        // Redirect ke index.html
        header("Location: index.html");
        exit();
    } else {
        echo "Password salah. <a href='login.html'>Coba lagi</a>";
    }
} else {
    echo "Username tidak ditemukan. <a href='login.html'>Coba lagi</a>";
}

// Tutup koneksi
$stmt->close();
$conn->close();
?>
