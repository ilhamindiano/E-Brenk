<?php 
session_start(); 
$koneksi = new mysqli("localhost", "root", "MyNewPass", "ebrenk");

if (empty($_SESSION["keranjang"]) OR !isset($_SESSION["keranjang"]))
{

echo "<script>alert('Keranjangnya kosong, belanja sana');</script>";
echo "<script>location='index.php';</script>";	
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Keranjang Belanja</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
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
		<h1>Keranjang Belanja</h1>
		<br>
		<table class="table table-bordered"
		   <thead>
		   	<tr>
		   		<th>No</th>
		   		<th>Produk</th>
		   		<th>Harga</th>
		   		<th>Jumlah</th>
		   		<th>Total</th>
		   		<th>Aksi</th>
		   	</tr>
		   </thead>
		   <tbody>
			<?php $nomor = 1; ?>		   
		   	<?php foreach ($_SESSION['keranjang'] as $id_produk => $jumlah): ?>
		   		
		 <?php 
		 $ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
		 $pecah = $ambil->fetch_assoc();
		 $total = $pecah['harga_produk']*$jumlah;
		  ?>
		   	    <tr>
		   	    	<td><?php echo $nomor; ?></td>
					<td><?php echo $pecah['nama_produk']; ?></td>
					<td>Rp. <?php echo number_format($pecah['harga_produk']); ?></td>
					<td><?php echo $jumlah; ?></td>
					<td>Rp. <?php echo number_format($total); ?></td>
					<td>
						<a href="hapuskeranjang.php?id=<?php echo $id_produk ?>" class="btn btn-danger btn-xs">hapus</a>
					</td>
		   	    </tr>
		   	    <?php $nomor++; ?>
		   	    <?php endforeach ?>
		   </tbody>
		</table> 

		<a href="index.php" class="btn btn-default">Lanjutkan Belanja</a>  
		<a href="checkout.php" class="btn btn-primary">Checkout</a>
	</div>
</section>
</body>
</html>