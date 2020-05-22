<?php
session_start();
$koneksi = new mysqli("localhost", "root", "MyNewPass", "ebrenk"); 
?>

<!DOCTYPE html>
<html>
<head>
	<title>Online Shop E-Brenk</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
	<script type="text/javascript" src="index.js"></script>
	
</head><!--/head-->
<head>
	<title>Login Pelanggan</title>
	<link rel="stylesheet" href="admin/assets/css/bootstrap.css">
</head>
<body>
	<header id="header"><!--header-->
		<div class="header_top"><!--header_top-->
			<div class="container">
				<div class="row">
					<div class="col-sm-8">
						<div class="contactinfo">
							<div class="col-sm-4">
									<a href="index.php"><img src="images/home/serigala.png" width="200" height="40" alt=""></a>
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
			<div class="col-md-4">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Login Pelanggan </h3>
					</div>
					<div class="panel-body">
						<form method="post">
						<div class="form-group">
							<label>Email</label>
							<input type="email" class="fprm-control" name="email">
							
						</div>
						<div class="form-group">
							<label> Password</label>
							<input type="password" class="form-control" name="password">
						</div>
						<button class+"btn btn-primary" name="login">Login </button>
						</form>
					</div>
				</div>
			</div>
		</div>

</div>

<?php
// jk ada tombol login(tombol login ditekan)
if (isset($_POST["login"]))
{

	$email= $_POST["email"];
	$password= $_POST["password"];

	// lakukan kuery ngecek akun di tabel pelanggan di db
	$ambil = $koneksi->query("SELECT * FROM pelanggan
		WHERE email_pelanggan='$email' AND password_pelanggan='$password'");

	// ngitung kaun yang terambil
	 $akunyangcocok = $ambil->num_rows;

	 // jika 1 akun yang cocok, maka login
	 if($akunyangcocok==1)
	 {
	 	// anda sudah login
	 	$akun = $ambil->fetch_assoc();
	 	//simpan di session pelanggan
	 	$_SESSION["pelanggan"] = $akun;
	 	echo "<script>alert('anda sukses login');</script>";
	
	 
	 	if (isset($_SESSION["keranjang"]) OR !empty($_SESSION["keranjang"]))
	 	{
	 		echo "<script>location='checkout.php';</script>";
	 	} 
	 	else
	 	{
	 	
	 		echo "<script>location='riwayat.php';</script>";
	 	} 
	 	
	 }
	 else
	 {
	 	// anda gagal
	 	echo "<script>alert('anda gagal login, periksa akun Anda');</script>";
	 	echo "<script>location='login.php';</script>";
	 }
}
?>
</body>
</html>

