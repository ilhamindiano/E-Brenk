<?php 
session_start();
 ?>

<?php 
$koneksi = new mysqli("localhost", "root", "MyNewPass", "ebrenk"); ?>

 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title>Nota Pembelian</title>
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
			<h2>Detail Pembelian</h2>
<?php  
$ambil = $koneksi->query("SELECT * FROM pembelian JOIN pelanggan
	ON pembelian.id_pelanggan=pelanggan.id_pelanggan
	WHERE pembelian.id_pembelian='$_GET[id]'");
$detail = $ambil->fetch_assoc();
?>

<strong><?php echo $detail['nama_pelanggan']; ?></strong> <br>
<p>
	<?php echo $detail['email_pelanggan']; ?> 
</p>

<p>
	Tanggal : <?php echo $detail['tanggal_pembelian']; ?> <br>
	Total : <?php echo $detail['total_pembelian']; ?>
</p>

<table class="table table-bordered">
	<thead>
		<tr>
			<th>No</th>
			<th>Nama Produk</th>
			<th>Harga</th>
			<th>Jumlah</th>
			<th>Subtotal</th>
		</tr>
	</thead>
	<tbody>
		<?php $nomor=1; ?>
		<?php $ambil=$koneksi->query("SELECT * FROM pembelian_produk JOIN produk ON pembelian_produk.id_produk=produk.id_produk WHERE pembelian_produk.id_pembelian='$_GET[id]'"); ?>
		<?php while($pecah=$ambil->fetch_assoc()) { ?>
		<tr>
			<td><?php echo $nomor; ?></td>
			<td><?php echo $pecah['nama_produk']; ?></td>
			<td><?php echo $pecah['harga_produk'];?></td>
			<td><?php echo $pecah['jumlah']; ?></td>
			<td>
				<?php echo $pecah['harga_produk']*$pecah['jumlah']; ?>
			</td>
		</tr>
		<?php $nomor++ ; ?>
		<?php } ?>
	</tbody>
</table>
		
		<?php 

		$idpelangganyangbeli = $detail["id_pelanggan"];
		$idpelangganyanglogin = $_SESSION["pelanggan"]["id_pelanggan"];

		if ($idpelangganyangbeli!==$idpelangganyanglogin)
		{
			echo "<script>alert('Hayolohhh');</script>";
			echo "<script>location='riwayat.php';</script>";	
			exit();

		} 

		?>

		<div class="row">
			<div class="col-mid-7">
				<div class="alert alert-info">
					<p>SILAHKAN MELAKUKAN PEMBAYARAN Rp. <?php echo number_format($detail['total_pembelian']); ?> ke <br>
						<strong>Bank Mandiri 000-00000-00000</strong>
					</p>
				</div>
			</div>
		</div>
		</div>
	</section>
 </body>
 </html>