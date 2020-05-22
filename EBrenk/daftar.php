<?php 
$koneksi = new mysqli("localhost", "root", "MyNewPass", "ebrenk"); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Daftar</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
	<script type="text/javascript" src="index.js"></script>
</head>
<body>
<header id="header"><!--header-->
		<div class="header_top"><!--header_top-->
			<div class="container">
				<div class="row">
					<div class="col-sm-8">
						<div class="contactinfo">
							<div class="col-sm-4">
									<a href="index.php"><img src="images/home/serigala.png" width="200" height="40" alt="">" /></a>
								<div class="logo pull-left">
								</div>
							</div>
							<ul class="nav navbar-nav">
								<!-- jk sudah login(ada session pelanggan) -->
								<?php if (isset($_SESSION["pelanggan"])): ?>
									<li><a href="logout.php">Logout</a></li>
									<!-- selainitu(blm login) -->
									<?php else : ?>
									<li><a href="login.php">Login</a></li>
									<li><a href="daftar.php">Daftar</a></li>
									<?php endif ?>
								
								<li><a href="checkout.php"> Checkout</a></li>

								<li><a href="keranjang.php">Cart</a></li>

								
							</ul>
						</div>
					</div>
					
				</div>
			</div>
		</div><!--/header_top-->
</header>
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Daftar Baru</h3>
					</div>
					<div class="panel-body">
						<form method="post">
							<div class="form-group">
								<label class="control-label col-md-3">Nama</label>
								<div class="col-md-7">
									<input type="text" class="form-control" name="nama" required>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3">Email</label>
								<div class="col-md-7">
									<input type="email" class="form-control" name="email" required>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3">Password</label>
								<div class="col-md-7">
									<input type="password" class="form-control" name="password" required>
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-7 col-md-offset-3">
									<button class="btn btn-primary" name="daftar">Daftar</button>
								</div>
							</div>
						</form>
						<?php 
						if (isset($_POST["daftar"])) 
						{
						 	$nama = $_POST['nama'];
						 	$email = $_POST['email'];
						 	$password = $_POST['password'];

						 	$ambil = $koneksi->query("SELECT * FROM pelanggan WHERE email_pelanggan='$email'");
							$yangcocok = $ambil->num_rows;
							if ($yangcocok==1) 
							{
								echo "<script>alert('Email telah digunakan')</script>";
								echo "<script>location='daftar.php';</script>";
							}
							else
							{
								$koneksi->query("INSERT INTO pelanggan (email_pelanggan, password_pelanggan, nama_pelanggan) VALUES('$email', '$password', '$nama')");
								echo "<script>alert('Pendaftaran Berhasil Dilakukan!');</script>";
								echo "<script>location='login.php';</script>";
							}
						} 
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>