<?php
session_start();
include 'connectDB.php'; // Kết nối đến CSDL travel_guide

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['email']) || !isset($_POST['password'])) {
        echo "<script>alert('Vui lòng nhập đầy đủ thông tin.'); window.history.back();</script>";
        exit();
    }

    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Kiểm tra tài khoản tồn tại và đang hoạt động (status = 1)
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ? AND status = 1 LIMIT 1");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // So sánh mật khẩu đã mã hóa
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['full_name'] = $user['full_name'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['role'] = $user['role'];

            echo "<script>alert('Đăng nhập thành công!'); window.location.href='index.php';</script>";
            exit();
        } else {
            echo "<script>alert('Sai mật khẩu!'); window.history.back();</script>";
            exit();
        }
    } else {
        echo "<script>alert('Email không tồn tại hoặc tài khoản bị khóa!'); window.history.back();</script>";
        exit();
    }
} else {
    header('Location: index.php');
    exit();
}
?>
