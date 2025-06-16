<?php include "header.php"; ?>

<div id="snow"></div> <!-- Kar efekti / Snowflakes -->

<div id="carouselExampleIndicators" class="carousel slide d-none d-sm-block" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block w-100" src="content/images/slide1.gif" alt="First slide">
	  <div class="carousel-caption d-none d-md-block">
	    
  	  </div>
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="content/images/slide2.jpeg" alt="Second slide">
      <div class="carousel-caption d-none d-md-block text-warning text-right">
  	  </div>
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="content/images/banner.jpg" alt="Third slide">
      <div class="carousel-caption d-none d-md-block text-dark text-left">
	    <h3>Keyifli Alışverişler</h3>
  	  </div>
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>

<div class="container pt-4">
	<h1 class="text-center baslik">Sımmıl Shop'a Hoş Geldiniz</h1>
	<p class="text-center pt-4">Sımmıl Shop olarak ilk önceliğimiz olan "müşteri memnuniyeti" ve ardından gelen kalite anlayışımızla, satışlarımızı hız kesmeden sürdürmeye devam ederken, sektörün ihtiyaçları doğrultusunda, kaliteli ürün tedarik etmek ve ürünlerimizden daha uzun yıllar faydalanmanız için çalışıyoruz. 
	Türkiye'de değer kazanan bir marka olarak, uluslararası bir marka olma yolunda hızla ilerliyoruz.
	Kuruluşumuzun 10. yılını kutladığımız bu günlerde, heyecanı ve mutluluğu yaşıyoruz.</p>
	<div class="row pt-4 bg-light">
		<div class="col-md-4">
			<div class="row">
				<div class="col-md-4">
					<span class="fa-stack fa-3x">
					  <i class="fa fa-circle-thin fa-stack-2x"></i>
					  <i class="fa fa-refresh fa-stack-1x"></i>
					</span>
				</div>
				<div class="col-md-8">
					<h5>Sorunsuz İade</h5>
					<p>Bütün ürünlerde 7 gün içinde ücretsiz iade</p>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="row">
				<div class="col-md-4">
					<span class="fa-stack fa-3x">
					  <i class="fa fa-circle-thin fa-stack-2x"></i>
					  <i class="fa fa-credit-card fa-stack-1x"></i>
					</span>
				</div>
				<div class="col-md-8">
					<h5>Güvenli Ödeme</h5>
					<p>Ödemelerinizi tüm banka ve kredi kartlarıyla yapabilirsiniz</p>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="row">
				<div class="col-md-4">
					<span class="fa-stack fa-3x">
					  <i class="fa fa-circle-thin fa-stack-2x"></i>
					  <i class="fa fa-truck fa-stack-1x"></i>
					</span>
				</div>
				<div class="col-md-8">
					<h5>Ücretsiz Kargo</h5>
					<p>350&#8378; üzeri alışverişlerinizde yurt içi ücretsiz kargo</p>
				</div>
			</div>
		</div>
	</div>
	<!-- Yeni ürünler -->
	<h1 class="text-center baslik pt-4 pb-3">Yeni Ürünler</h1>
	<div class="row">
		<?php 
        // veritabanı yapılandırma dosyasını dahil et
        include 'config/vtabani.php';
        // kayıt listeleme sorgusu
        $sorgu='select id, urunadi, aciklama, fiyat, resim from urunler order by giris_tarihi desc limit 0,6';
        $stmt = $con->prepare($sorgu); // sorguyu hazırla
        $stmt->execute(); // sorguyu çalıştır
        $veri = $stmt->fetchAll(PDO::FETCH_ASSOC); // tablo verilerini oku
        foreach ($veri as $kayit) { ?> 
        	<div class="col-md-4 mb-4">
				<div class="card">
				  <a href="urundetay.php?id=<?php echo $kayit['id']?>">
				  	 <img class="card-img-top" src="content/images/<?php echo $kayit['resim']?>" alt="<?php echo $kayit['urunadi']?>">
				  </a>
				  <div class="card-body">
				    <h4 class="card-title"><?php echo $kayit['urunadi']?></h4>
				    <p class="card-text"><?php echo $kayit['aciklama']?></p>
					
				  </div>
				  <div class="card-footer text-muted">
					 <a href="#" class="text-secondary float-left sepete-ekle" id="<?php echo $kayit['id']?>"><i class="fa fa-cart-plus fa-2x"></i></a> 
					<span class="badge badge-success p-2 float-right"><?php echo $kayit['fiyat']?>&#8378;</span>
		  		  </div>
				</div>
			</div>
        <?php } ?>
	</div>
</div>

<?php include "footer.php"; ?>