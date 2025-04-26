<?php  
session_start();

if (isset($_SESSION['level'])) {
	if ($_SESSION['level']!="") {
		header("location:../dashboard");
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login - Dark Theme</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Bootstrap & Font Awesome -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

	<style>
		body {
			background-color: #121212;
			color: #ffffff;
			display: flex;
			justify-content: center;
			align-items: center;
			height: 100vh;
			font-family: 'Segoe UI', sans-serif;
			margin: 0;
		}
		.login-container {
			background-color: #1f1f1f;
			padding: 40px;
			border-radius: 15px;
			box-shadow: 0 0 15px rgba(0, 0, 0, 0.8);
			width: 100%;
			max-width: 420px;
		}
		.login-logo {
			width: 90px;
			display: block;
			margin: 0 auto 15px;
		}
		.login-title {
			text-align: center;
			font-size: 1.7rem;
			color: #ffffff;
			margin-bottom: 25px;
		}
		.form-control {
			background-color: #2a2a2a;
			color: #ffffff;
			border: 1px solid #444;
			border-radius: 10px;
		}
		.form-control::placeholder {
			color: #aaaaaa;
		}
		.input-group-text {
			background-color: #2a2a2a;
			color: #03DAC6;
			border: 1px solid #444;
			border-right: none;
			border-radius: 10px 0 0 10px;
		}
		.btn-login {
			background-color: #03DAC6;
			color: #121212;
			border: none;
			width: 100%;
			font-weight: bold;
			border-radius: 10px;
			padding: 10px;
			transition: 0.3s ease-in-out;
		}
		.btn-login:hover {
			background-color: #00b9a4;
			color: #ffffff;
		}
		.alert {
			font-size: 14px;
			margin-top: -10px;
			margin-bottom: 15px;
		}
	</style>
</head>
<body>

	<div class="login-container">
		<img src="../dashboard/assets/image/logo_restauran.png" class="login-logo" alt="Logo">
		<div class="login-title">Silakan Login</div>

		<?php
			if(isset($_GET['pesan'])) {
				if($_GET['pesan']=="gagal") {
					echo "<div class='alert alert-danger'>Username dan Password tidak sesuai</div>";
				} elseif ($_GET['pesan']=="tabrak") {
					echo "<div class='alert alert-warning'>Anda harus <strong>Login</strong> terlebih dahulu!</div>";
				} elseif ($_GET['pesan']=="logout") {
					echo "<div class='alert alert-success'>Anda berhasil logout.</div>";
				}
			}
		?>

		<form action="cek_login.php" method="post">
			<div class="mb-3 input-group">
				<span class="input-group-text"><i class="fa fa-user"></i></span>
				<input type="text" name="username" class="form-control" placeholder="Username" required>
			</div>

			<div class="mb-4 input-group">
				<span class="input-group-text"><i class="fa fa-lock"></i></span>
				<input type="password" name="password" class="form-control" placeholder="Password" required>
			</div>

			<button type="submit" name="login" class="btn btn-login">Login</button>
		</form>
	</div>

</body>
</html>
