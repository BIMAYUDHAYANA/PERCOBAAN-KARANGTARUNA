<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

$conn = mysqli_connect("localhost", "root", "", "karangtaruna");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT password, role FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($row = $result->fetch_assoc()) {
        if (password_verify($password, $row['password'])) {
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $row['role'] ?? 'customer';
            header("Location: " . ($_SESSION['role'] == 'admin' ? "admin.php" : "dashboard.php"));
            exit;
        } else { $error = "Password salah!"; }
    } else { $error = "User tidak ditemukan!"; }
}
?>
<!DOCTYPE html><html><head><link rel="stylesheet" href="style.css"></head>
<body>

<div class="box">
    <div class="content">
        <form method="POST">
            <h2 style="margin-bottom: 25px;">Login Sistem</h2>
            <?php if(isset($error)) echo "<p style='color:#ff2770; text-align:center; margin-bottom:10px;'>$error</p>"; ?>
            
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            
            <button type="submit">Sign In</button>
            
            <div class="nav-links">
                <a href="register.php">Belum punya akun? Daftar sekarang</a>
            </div>
        </form>
    </div>
</div>

</body></html>