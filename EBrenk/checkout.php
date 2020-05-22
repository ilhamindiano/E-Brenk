<?php 
session_start();
$koneksi = new mysqli("localhost", "root", "MyNewPass", "ebrenk"); 

if (!isset($_SESSION["pelanggan"]))
{
	echo "<script>alert(' Silahkan Login ya!');</script>";
	echo "<script>location='login.php';</script>";
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Checkout</title>
	<link rel="stylesheet" href="admin/assets/css/bootstrap.css">
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
		   		
		   	</tr>
		   </thead>
		   <tbody>
			<?php $nomor = 1; ?>
			<?php $totalbelanja = 0; ?>		   
		   	<?php foreach ($_SESSION["keranjang"] as $id_produk => $jumlah):?>
		   		
		 <?php 
		 $ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
		 $pecah = $ambil->fetch_assoc();
		 $total = $pecah["harga_produk"]*$jumlah;
		  ?>
		   	    <tr>
		   	    	<td><?php echo $nomor; ?></td>
					<td><?php echo $pecah["nama_produk"]; ?></td>
					<td>Rp. <?php echo number_format($pecah["harga_produk"]); ?></td>
					<td><?php echo $jumlah; ?></td>
					<td>Rp. <?php echo number_format($total); ?></td>
					
		   	    </tr>
		   	    <?php $nomor++; ?>
		   	    <?php $totalbelanja+=$total; ?>
		   	    <?php endforeach ?>
		   </tbody>
		   <tfoot>
		   		<tr>
		   				<th colspan="4">Total Belanja</th>
		   				<th>Rp. <?php echo number_format($totalbelanja)  ?></th>
		   		</tr>
		   </tfoot>
		</table> 
			<form method="post">
				
				</div>
				<div class="row">
					<div class="col-md-3"><div class="form-group">
					<input type="text" readonly value="<?php echo $_SESSION["pelanggan"]["email_pelanggan"] ?>" class="form-control">

				</div></div>
					<div class="col-md-3"><div class="form-group">
					<input type="text" readonly value="<?php echo $_SESSION["pelanggan"]["nama_pelanggan"] ?>" class="form-control"></div>
					<div class="col-md-6">
						<select class="form-control" name="id_ongkir">
							<option value="">Pilih Ongkos Kirim</option>
							<?php 
							$ambil = $koneksi->query("SELECT * FROM ongkir");
							while ($perongkir= $ambil->fetch_assoc()) 
							{
								?> 
								<option value="<?php echo $perongkir['id_ongkir'] ?>">
									<?php echo $perongkir['nama_kota'] ?>
									Rp. <?php echo number_format($perongkir['tarif']) ?>	
								</option>
							<?php  } ?>
							
						</select>
					</div>
				</div>
				<button class="btn btn-primary" name="checkout">Checkout</button>
			</form>
			<?php 
			if (isset($_POST["checkout"]))
			{
				$id_pelanggan = $_SESSION["pelanggan"]["id_pelanggan"];
				$id_ongkir = $_POST["id_ongkir"];
				$tanggal_pembelian = date("Y-m-d");

				$ambil= $koneksi->query("SELECT * FROM ongkir WHERE id_ongkir='id_ongkir'");
				$arrayongkir = $ambil->fetch_assoc();
				$tarif = $arrayongkir ['tarif'];

				$total_pembelian = $totalbelanja + $tarif;

				$koneksi->query("INSERT INTO pembelian(id_pelanggan,id_ongkir,tanggal_pembelian,total_pembelian) VALUES ('$id_pelanggan','$id_ongkir','$tanggal_pembelian','$total_pembelian')");

				$id_pembelian_barusan = $koneksi->insert_id;

				foreach ($_SESSION ["keranjang"] as $id_produk => $jumlah)
				{
					    
						$ambil=$koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
						$perproduk=$ambil->fetch_assoc();

						$nama = $perproduk['nama_produk'];
						$harga = $perproduk['harga_produk'];
						$total = $perproduk['harga_produk']*$jumlah;

					    $koneksi->query("INSERT INTO pembelian_produk (id_pembelian,id_produk,jumlah)
						VALUES ('$id_pembelian_barusan','$id_produk','$jumlah')");

						$koneksi->query("UPDATE produk SET stok_produk=stok_produk - $jumlah WHERE id_produk='$id_produk' ");
				}

				
				unset($_SESSION["keranjang"]);

				echo "<script>alert('Pembelian Sukses!');</script>";
				echo "<script>location='nota.php?id=$id_pembelian_barusan';</script>";	



			}


			 ?>
	</div>
</section>

</body>
</html>