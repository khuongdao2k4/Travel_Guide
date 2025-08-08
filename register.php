<?php
session_start();
include 'connectDB.php'; // Kết nối CSDL

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lấy dữ liệu từ form
    $full_name = trim($_POST['full_name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $phone_number = trim($_POST['phone_number']);

    // Kiểm tra mật khẩu trùng khớp
    if ($password !== $confirm_password) {
        echo "<script>alert('Mật khẩu không khớp.'); window.history.back();</script>";
        exit();
    }

    // Mã hóa mật khẩu
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Kiểm tra email đã tồn tại chưa
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo "<script>alert('Email đã được đăng ký.'); window.history.back();</script>";
        exit();
    }

    // Thêm người dùng mới vào database
    $stmt = $conn->prepare("INSERT INTO users (full_name, email, password, phone_number, role, status) VALUES (?, ?, ?, ?, 'user', 1)");
    $stmt->bind_param("ssss", $full_name, $email, $hashed_password, $phone_number);

    if ($stmt->execute()) {
        echo "<script>alert('Đăng ký thành công!'); window.location.href = 'index.php';</script>";
        exit();
    } else {
        echo "<script>alert('Đăng ký thất bại!'); window.history.back();</script>";
        exit();
    }
} else {
    header("HTTP/1.1 405 Method Not Allowed");
    echo "<h1>405 Method Not Allowed</h1><p>Chỉ chấp nhận phương thức POST.</p>";
    exit();
}
?>
