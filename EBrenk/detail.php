<?php
session_start(); 
 ?>
<?php 
$koneksi = new mysqli("localhost", "root", "MyNewPass", "ebrenk"); ?>
<?php 
$id_produk = $_GET["id"];
$ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
$detail = $ambil->fetch_assoc();

 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<title>Detail Produk</title>
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

<section class="konten">
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<img src="foto_produk/<?php echo $detail["foto_produk"]; ?>" alt="" class="img-responsive">
			</div>
			<div class="col-md-6">
				<h2><?php echo $detail["nama_produk"]; ?></h2>
				<h4>Rp. <?php echo number_format($detail["harga_produk"]); ?></h4>
				<h5>Tersedia : <?php echo $detail['stok_produk'] ;?> unit</h5>

				<form method="post">
					<div class="form-group">
						<div class="input-group">
							<input type="number" min="1" max="<?php echo $detail['stok_produk']; ?>" class="form-control" name="jumlah">
							<div class="input-group-btn">
								<button class="btn btn-primary" name="beli">Beli</button>
							</div>
						</div>
					</div>
				</form>

				<?php 
					if (isset($_POST["beli"]))
					 {
						$jumlah = $_POST["jumlah"];
						$_SESSION["keranjang"][$id_produk] = $jumlah;
						
						echo "<script>alert('Produk telah masuk ke cart!');</script>";
						echo "<script>location='keranjang.php';</script>";	
					}



				 ?>
				<p><?php echo $detail["deskripsi_produk"]; ?></p>
			</div>
		</div>
	</div>
</section>
 
 </body>
 </html>