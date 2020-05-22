<?php 
session_start();
$koneksi = new mysqli("localhost", "root", "MyNewPass", "ebrenk"); ?>


<html>

<head>


	<title>Online Shop E-Brenk</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
	<script type="text/javascript" src="index.js"></script>
	
</head><!--/head-->

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
		<div class="header-bottom"><!--header-bottom-->
			<div class="container">
				<div class="row">
					<div class="col-sm-9">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						<div class="mainmenu pull-left">
							<ul class="nav navbar-nav collapse navbar-collapse">
								<li><a href="index.php" class="active">Home</a></li>
								<li class="dropdown"><a href="#">Shop<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="Rental.html">Rental</a></li>
										<li><a href="index.php">Belanja Langsung</a></li> 
										 
                                    </ul>
                                </li> 
								<li class="dropdown"><a href="#">Tentang Kami<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="blog.html">E-Brenk</a></li>
										
                                    </ul>
                                </li> 
								<li><a href="kontak_kami.html">Kontak Kami</a></li>
							</ul>
						</div>
					</div>
				
				</div>
			</div>
		</div><!--/header-bottom-->
	</header><!--/header-->
	
	<section id="slider"><!--slider-->
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div id="slider-carousel" class="carousel slide" data-ride="carousel">
						<ol class="carousel-indicators">
							<li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
							<li data-target="#slider-carousel" data-slide-to="1"></li>
							<li data-target="#slider-carousel" data-slide-to="2"></li>
						</ol>
						
						<div class="carousel-inner">
							<div class="item active">
								<div class="col-sm-6">
									<img src="images/home/wkwk123.jpg" class="girl img-responsive" alt="" />
									<img src="images/home/pricing.png"  class="pricing" alt="" />
								</div>
								<div class="col-sm-6">
									<h1><span>New</span>Product</h1>
									<h2>Berbagai Produk Terbaru</h2>
									<p>Dapatkan atau coba produk markup terbaru disini </p>
									
								</div>
								
							</div>		
						</div>
						
					<br> <br> <br>
	<h2 class="title text-center">Produk Terbaru</h2>
	
	<section class="konten">
		<div class="container">
			<div class="row">
				<?php $ambil=$koneksi->query("SELECT * FROM produk") ?>;
				<?php while($perproduk = $ambil->fetch_assoc()) { ?>
				<div class="col-md-4">
					<div class="thumbnail">
						<img src="foto_produk/<?php echo $perproduk['foto_produk']; ?>" alt="">
						<div class="caption">
							<h3><?php echo $perproduk['nama_produk']; ?></h3>
							<h5>Rp. <?php echo number_format($perproduk['harga_produk']); ?></h5>
							<a href="beli.php?id=<?php echo $perproduk['id_produk']; ?>" class="btn btn-default add-to-cart">Beli</a>
							<a href="detail.php?id=<?php echo $perproduk["id_produk"]; ?>" class="btn btn-primary">Detail</a>
						</div>
					</div>
				</div>
			    <?php } ?>
			</div>
		</div>
		
	</section>
	
	<footer id="footer"><!--Footer-->
			<div class="footer-widget">
			<div class="container">
				<div class="row">
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>E-Brenk</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">Tentang Kami</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Beli</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">Belanja Di E-Brenk</a></li>
								<li><a href="#">Cara Belanja</a></li>
								<li><a href="#">Pembayaran</a></li>
								<li><a href="#">Hot List</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-3 col-sm-offset-1">
						<div class="single-widget">
							<h2>Tentang E-Brenk</h2>
							<form action="#" class="searchform">
								<input type="text" placeholder="Your email address" />
								<button type="submit" class="btn btn-default"><i class="fa fa-arrow-circle-o-right"></i></button>
								<p>Untuk mendapatkan Update baru dari Toko Online E-Brenk<br />Tinggalkan Email Disini</p>
							</form>
						</div>
					</div>
					
				</div>
			</div>
		</div>
		
		<div class="footer-bottom">
			<div class="container">
				<div class="row">
					<p class="pull-left">Copyright &copy;  2016 E-Brenk. All rights reserved.</p>
					<p class="pull-right">Powered by <span><a>E-Brenk</a></span></p>
				</div>
			</div>
		</div>
		
	</footer><!--/Footer-->
</body>
</html>