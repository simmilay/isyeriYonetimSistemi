<?php
	// Oturum işlemlerini başlat
	session_start();

	// Sepet oluşturulmamışsa oluştur
	$_SESSION['sepet']=isset($_SESSION['sepet']) ? $_SESSION['sepet'] : array();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>SımmılShop</title>

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="content/css/style.css">
	<link rel="stylesheet" type="text/css" href="content/css/snowflake.css">

	<script type="text/javascript" src="content/js/jquery-3.3.1.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="content/js/snowflake.js"></script>
</head>
<body>
  <div class="container-fluid bg-success">
	<div class="container">
		<div class="row p-2">
			<div class="col-md-8">
				<span class="text-white">Kampanya: 350&#8378; üzeri alışverişlerinizde ücretsiz kargo</span>
			</div>
			<div class="col-md-4 text-right text-white">
				<a class="link1" href="sepetim.php"><!-- Sepet içeriği sayfası linki -->
					<span class="fa-stack fa-1x">
					  <i class="fa fa-circle-thin fa-stack-2x"></i>
					  <i class="fa fa-shopping-cart fa-stack-1x"></i>
					</span> Sepetiniz
					<span class="badge badge-light" id="urun-sayisi">
						<?php 
						// Sepetteki ürün sayısı
						$urun_sayisi=count($_SESSION['sepet']);
						echo $urun_sayisi; 
						?>
					</span>
				</a>
			</div>
		</div>
	</div>
  </div>

  <div class="container">
	<nav class="navbar navbar-expand-lg navbar-light bg-white">
	  <a class="navbar-brand" href="index.php">
	    <img src="content/images/logo.png 		" alt="Logo" style="width:150px;position: relative;">
		SımmılShop
	  </a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	  </button>
	  <div class="collapse navbar-collapse" id="navbarSupportedContent">
	  	<form class="form-inline my-2 my-lg-0" action="urunler.php" method="get" name="form_ara">
	      <input class="form-control mr-sm-2" type="search" placeholder="Ürün ara..." aria-label="Ara" name="aranan">
	      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Ara</button>
	    </form>
	    <ul class="navbar-nav ml-auto">
	      <li class="nav-item active">
	        <a class="nav-link" href="index.php">Anasayfa <span class="sr-only">(current)</span></a>
	      </li>
	      <li class="nav-item">
	        <a class="nav-link" href="urunler.php">Ürünler</a>
	      </li>
	      <li class="nav-item dropdown">
	        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	          Kategoriler
	        </a>
	        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
	        	<?php 
		    	    // veritabanı yapılandırma dosyasını dahil et
		    		include 'config/vtabani.php';
		    		// kayıt listeleme sorgusu
		    		$sorgu='select id, kategoriadi from kategoriler order by kategoriadi';
		      		$stmt = $con->prepare($sorgu); // sorguyu hazırla
					$stmt->execute(); // sorguyu çalıştır
					$veri = $stmt->fetchAll(PDO::FETCH_ASSOC); // tablo verilerini oku
					foreach ($veri as $kayit) { // her kategori için bir menü seçeneği oluştur
						echo "<a class='dropdown-item' href='urunler.php?id={$kayit["id"]}'>{$kayit["kategoriadi"]}</a>";
				    } 
				?>
	        </div>
	      </li>
	      <li class="nav-item">
	        <a class="nav-link" href="hakkimizda.php">Hakkımızda</a>
	      </li>
	    </ul>
	  </div>
	</nav>
  </div>