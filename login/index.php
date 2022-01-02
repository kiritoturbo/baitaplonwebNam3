<?php 

include 'config.php';

session_start();

error_reporting(0);

if (isset($_SESSION['username'])) {
    header("Location: welcome.php");
}

if (isset($_POST['submit'])) {
	$name = $_POST['name'];
	$password = md5($_POST['password']);

	$sql = "select * FROM login WHERE TenUser='$name' AND Password='$password'";
	$result = mysqli_query($conn, $sql);
	if ($result->num_rows > 0) {
		$row = mysqli_fetch_assoc($result);
		$_SESSION['username'] = $row['username'];
		header("Location: /baitaplonweb/BangDieuKhien/index.php");
	} else {
		echo "<script>alert('Xin lỗi. Mật khẩu hoặc password không đúng.')</script>";
	}
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" type="text/css" href="style.css">

	<title>Đăng Nhập</title>
</head>
<body>
	<div class="container">
		<form action="" method="POST" class="login-email">
			<p class="login-text" style="font-size: 2rem; font-weight: 800;">Đăng Nhập</p>
			<div class="input-group">
				<input type="text" placeholder="name" name="name" required>
			</div>
			<div class="input-group">
				<input type="password" placeholder="Password" name="password"required>
			</div>
			<div class="input-group">
				<button name="submit" class="btn">Đăng Nhập</button>
			</div>
			<p class="login-register-text" style="margin-left: 25px;">Không có tài khoản? <a href="register.php">Tạo Tài Khoản</a>.</p>
		</form>
	</div>
</body>
</html>