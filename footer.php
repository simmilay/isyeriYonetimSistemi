  <div class="container-fluid bg-dark">
    <div class="container pt-4">
      <div class="row">
        <div class="col-md-4 mb-4">
          <h4 class="text-white">Yardım</h4>
          <a href="#" class="link1">Ödeme</a><br>
          <a href="#" class="link1">İade ve Değişim</a><br>
          <a href="#" class="link1">Mağazalarımız</a><br>
          <a href="#" class="link1">Kariyer Fırsatları</a><br>
          <a href="#" class="link1">Sık Sorulan Sorular</a><br>
          <a href="#" class="link1">Kampanyalar</a>
        </div>
        <div class="col-md-4 mb-4">
          <h4 class="text-white">Fırsat Ürünleri</h4>
          <?php 
              // veritabanı yapılandırma dosyasını dahil et
              include 'config/vtabani.php';
              // kayıt listeleme sorgusu
              $sorgu='SELECT id, urunadi, aciklama, fiyat, resim FROM urunler ORDER BY fiyat LIMIT 0,3';
              $stmt = $con->prepare($sorgu); // sorguyu hazırla
              $stmt->execute(); // sorguyu çalıştır
              $veri = $stmt->fetchAll(PDO::FETCH_ASSOC); // tablo verilerini oku
              foreach ($veri as $kayit) { ?> 
                <div class="row mb-3">
                  <div class="col-3">
                    <img src="content/images/<?php echo $kayit['resim']?>" class="img-fluid img-thumbnail">
                  </div>
                  <div class="col-9">
                    <a href="urundetay.php?id=<?php echo $kayit['id']?>" class="link1">
                       <p class="firsat"><?php echo $kayit['urunadi']?></p>
                    </a>
                    <span class="badge badge-success p-1"><?php echo $kayit['fiyat']?> &#8378;</span>
                  </div>
                </div>
              <?php } 
          ?>
        </div>
        <div class="col-md-4 mb-4">
          <h4 class="text-white">İletişim</h4>
          <p class="text-light">Adres: <br>Barbaros Mahallesi, Doğ sok.  <br>Ataşehir/İstanbul <br>Telefon: (0537) 685 61 45  <br>Faks: (0212) 885 40 30 <br>Web: silaAyas.com <br>Eposta: slaays832@gmail.com</p>
        </div>
      </div>
    </div>
  </div>

  <!-- SweetAlert eklentisi için 
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> -->
  <script src="content/js/sweetalert.min.js"></script>
  
  <!-- Sepet işlemleri için gerekli JavaScript fonksiyonları -->
  <script>
    $(document).ready(function(){

      // sepete-ekle butonu ile tetiklenir
      $('.sepete-ekle').on('click', function(){

        var id = $(this).attr('id');
        var sayi = parseInt(document.getElementById('urun-sayisi').innerHTML);
        if (document.getElementById('urun_'+id) !== null) { 
          // buton urundetay.php sayfasında tıklanmış
          var adet=document.getElementById('urun_'+id).value; 
        } 
        else { 
          // buton urunler.php sayfasında tıklanmış
          var adet=1; 
        }

        // id ve adet parametreleri sepete_ekle.php sayfasına yönlendirilir
        $.ajax ({
            cache: false,
            type: 'POST',
            url: 'sepete_ekle.php',
            data: {id:id, adet:adet},
            success: function(sonuc){
              if(sonuc=="true"){
                swal("Ürün sepete eklendi!", {
                    icon: "success",
                    buttons: false,
                    timer: 2000,
                });
                // sepetteki ürün sayısını güncelle
                $("#urun-sayisi").text(sayi + 1);
              }
              else{
                swal("Ürün daha önce sepete eklenmiş!", {
                    icon: "warning",
                    buttons: false,
                    timer: 2000,
                });
              }
            },
            error: function(jqXHR, textStatus, errorThrown){
                alert(textStatus + errorThrown);
              } 
            });
        return false;
      });

      // urun-guncelle butonu ile tetiklenir
      $('.urun-guncelle').on('click', function(){

        var id = $(this).attr('id');
        var adet = document.getElementById('urun_'+id).value;

        // id ve adet parametreleri sepeti_guncelle.php sayfasına yönlendirilir
        $.ajax ({
            cache: false,
            type: 'POST',
            url: 'sepeti_guncelle.php',
            data: {id:id, adet:adet},
            success: function(){
                swal("Ürün adedi güncellendi!", {
                    icon: "success",
                    buttons: false,
                    timer: 2000,
                }).then(function() {
                  window.location.href="sepetim.php";
                });
              },
            error: function(jqXHR, textStatus, errorThrown){
                alert(textStatus + errorThrown);
              } 
            });
        return false;
      });

      // urun-sil butonu ile tetiklenir
      $('.urun-sil').on('click', function(){

        var id = $(this).attr('id');

        // id parametresi sepeti_guncelle.php sayfasına yönlendirilir
        $.ajax ({
            cache: false,
            type: 'POST',
            url: 'sepeti_guncelle.php',
            data: {id:id},
            success: function(){
                swal("Ürün sepetten çıkarıldı!", {
                    icon: "success",
                    buttons: false,
                    timer: 2000,
                }).then(function() {
                  window.location.href="sepetim.php";
                });
              },
            error: function(jqXHR, textStatus, errorThrown){
                alert(textStatus + errorThrown);
              } 
            });
        return false;
      });
    });
  </script>

</body>
</html>