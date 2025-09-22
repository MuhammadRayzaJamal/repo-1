<?php
session_start();

// Koneksi ke database
$konek = new mysqli('localhost', 'root', '', 'spksaw', 3306);
if ($konek->connect_errno) {
    die(json_encode(["status" => "failed", "message" => "Terjadi kesalahan pada database: ".$konek->connect_error]));
}

// Ambil data POST
$user = isset($_POST['username']) ? trim($_POST['username']) : '';
$pass = isset($_POST['password']) ? trim($_POST['password']) : '';

// Validasi input
if (empty($user) && empty($pass)) {
    $result = ["status" => "failed", "message" => "Username dan password harus diisi"];
} elseif (empty($user)) {
    $result = ["status" => "failed", "message" => "Username harus diisi"];
} elseif (empty($pass)) {
    $result = ["status" => "failed", "message" => "Password harus diisi"];
} else {
    $stmt = $konek->prepare("SELECT * FROM USER WHERE username = ?");
    $stmt->bind_param("s", $user);
    $stmt->execute();
    $execute = $stmt->get_result();

    if ($execute->num_rows > 0) {
        $data = $execute->fetch_assoc();
        if ($pass === $data['PASSWORD']) {
            $_SESSION['user'] = $data['username'];
            $result = ["status" => "success", "message" => "Login berhasil"];
        } else {
            $result = ["status" => "failed", "message" => "Password salah"];
        }
    } else {
        $result = ["status" => "failed", "message" => "Username tidak terdaftar"];
    }
}

echo json_encode($result);
?>
