<?php 
session_start();
if (!isset($_SESSION["pelanggan"]) OR empty($_SESSION["pelanggan"]))
{
	echo "<script>alert('login dulu ya');</script>";
	echo "<script>location='login.php';</script>";	
	exit();
}
$koneksi = new mysqli("localhost", "root", "MyNewPass", "ebrenk");
$idpem = $_GET["id"];
$ambil = $koneksi->query("SELECT * FROM pembelian WHERE id_pembelian='$idpem'");
$detpem = $ambil->fetch_assoc();

$id_pelanggan_beli = $detpem ["id_pelanggan"];
$id_pelanggan_login = $_SESSION["pelanggan"]["id_pelanggan"];
if ($id_pelanggan_login !== $id_pelanggan_beli)
{
	echo "<script>alert('mau ngapain');</script>";
	echo "<script>location='riwayat.php';</script>";	
	exit();
}

 ?>


<!DOCTYPE html>
<html>
<head>
	<title>Online Shop E-Brenk</title>
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
									<a href="index.php"><img src="images/home/serigala.png" width="200" height="40" alt=""></a>
								<div class="logo pull-left">
								</div>
							</div>
							<ul class="nav navbar-nav">
								<!-- jk sudah login(ada session pelanggan) -->
								<?php if (isset($_SESSION["pelanggan"])): ?>
									<li><a href="riwayat.php">Riwayat</a></li>
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

		<div class="container">
			<h2>Konfirmasi Pembayaran</h2>
			<p>Kirim Bukti Pembayaran Disini</p>
			<div class="alert alert-info">Total Tagihan Anda <strong>Rp. <?php echo number_format($detpem["total_pembelian"]) ?></strong></div>


			<form method="post" enctype="multipart/form-data">
				<div class="form-group">
					<label>Nama Penyetor</label>
					<input type="text" class="form-control" name="nama">
				</div>
					<div class="form-group">
					<label>Bank</label>
					<input type="text" class="form-control" name="bank">

				</div>
					<div class="form-group">
					<label>Jumlah</label>
					<input type="number" class="form-control" name="jumlah" min="1">
				</div>
					<div class="form-group">
					<label>Foto Bukti</label>
					<input type="file" class="form-control" name="bukti">
					<p class="text-danger">Foto Bukti Harus JPG max 2MB</p>
				</div>
				<button class="btn btn-primary" name="kirim">Kirim</button>
			</form>
		</div>

		<?php 
		if (isset($_POST["kirim"])) 
		{
			$namabukti = $_FILES ["bukti"]["name"];
			$lokasibukti = $_FILES ["bukti"]["tmp_name"];
			$namafiks=date("YmdHis").$namabukti;
			move_uploaded_file($lokasibukti, "bukti_pembayaran/$namafiks");
			
			$nama = $_POST["nama"];
			$bank= $_POST["bank"];
			$jumlah = $_POST["jumlah"];
			$tanggal = date("Y-m-d");

			$koneksi->query("INSERT INTO pembayaran(id_pembelian, nama, bank, jumlah, tanggal, bukti) VALUES ('$idpem','$nama','$bank','$jumlah','$tanggal','$namafiks') ");

			$koneksi->query("UPDATE pembelian SET status_pembelian='sudah terverifikasi' WHERE id_pembelian='$idpem' ");
			{

					echo "<script>alert('TerimaKasih Telah Membayar');</script>";
					echo "<script>location='riwayat.php';</script>";	
					exit();
}
			
		}

		 ?>
</body>
</html>