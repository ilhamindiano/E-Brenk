<?php 
session_start();
if (!isset($_SESSION["pelanggan"]) OR empty($_SESSION["pelanggan"]))
{
	echo "<script>alert('login dulu ya');</script>";
	echo "<script>location='login.php';</script>";	
	exit();
}
$koneksi = new mysqli("localhost", "root", "MyNewPass", "ebrenk"); ?>


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
	<section class="riwayat">
		<div class="container">
			<h2>Riwayat Belanja <?php echo $_SESSION["pelanggan"]["nama_pelanggan"] ?></h2>

			<table class="table table-bordered">
				<thead>
					<tr>
						<th>No</th>
						<th>Tanggal</th>
						<th>Status</th>
						<th>Total</th>
						<th>Opsi</th>
					</tr>




				</thead>
				<tbody>
					
					<?php 
					$nomor = 1;
					$id_pelanggan=$_SESSION["pelanggan"]["id_pelanggan"];
					$ambil = $koneksi->query("SELECT * FROM pembelian WHERE id_pelanggan='$id_pelanggan' ");
					while ($pecah = $ambil->fetch_assoc()){
					 ?>
					
					
					<tr>
						<td><?php echo $nomor; ?></td>
						<td><?php echo $pecah["tanggal_pembelian"] ?></td>
						<td><?php echo $pecah["status_pembelian"] ?>
							<br>
							<?php if (!empty($pecah['resi_pengiriman'])): ?>
								Resi : <?php echo $pecah['resi_pengiriman']; ?>
							<?php endif ?>
						</td>
						<td>Rp. <?php echo number_format($pecah["total_pembelian"]) ?></td>
						<td>
							<a href="nota.php?id=<?php echo $pecah["id_pembelian"]; ?>" class="btn btn-info">Nota</a>
							<a href="pembayaran.php?id=<?php echo $pecah["id_pembelian"]; ?>" class="btn btn-success">Pembayaran</a>

						</td>
						


					</tr>
					<?php $nomor++; ?>
					<?php } ?>
				
				</tbody>
			</table>
		</div>
	</section>
</body>
</html>