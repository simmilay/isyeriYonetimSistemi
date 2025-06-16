<?php include "../header.php"; ?>
<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>

<div class="container">

    <div class="page-header">
        <h1>Ürün Güncelleme</h1>
    </div>

    <?php
    $id=isset($_GET['id']) ? $_GET['id'] : die('HATA: Id bilgisi bulunamadı.');

    include '../../config/vtabani.php';

    try {
        $sorgu = "SELECT id, urunadi, aciklama, fiyat, kategori_id FROM urunler WHERE id = ? LIMIT 0,1";
        $stmt = $con->prepare( $sorgu );
        $stmt->bindParam(1, $id);
        $stmt->execute();
        $kayit = $stmt->fetch(PDO::FETCH_ASSOC);
        $urunadi = $kayit['urunadi'];
        $aciklama = $kayit['aciklama'];
        $fiyat = $kayit['fiyat'];
        $kategori_id = $kayit['kategori_id'];
    } catch(PDOException $exception){
        die('HATA: ' . $exception->getMessage());
    }
    ?>

    <?php
    if($_POST){
        try{
            $sorgu = "UPDATE urunler 
                        SET urunadi=:urunadi, aciklama=:aciklama, fiyat=:fiyat, kategori_id=:kategori_id 
                        WHERE id = :id";

            $stmt = $con->prepare($sorgu);

            $urunadi=htmlspecialchars(strip_tags($_POST['urunadi']));
            $aciklama=htmlspecialchars(strip_tags($_POST['aciklama']));
            $fiyat=htmlspecialchars(strip_tags($_POST['fiyat']));
            $kategori_id=htmlspecialchars(strip_tags($_POST['kategori_id']));

            $stmt->bindParam(':urunadi', $urunadi);
            $stmt->bindParam(':aciklama', $aciklama);
            $stmt->bindParam(':fiyat', $fiyat);
            $stmt->bindParam(':kategori_id', $kategori_id);
            $stmt->bindParam(':id', $id);

            if($stmt->execute()){
                echo "<div class='alert alert-success'>Kayıt güncellendi.</div>";
            } else {
                echo "<div class='alert alert-danger'>Kayıt güncellenemedi.</div>";
            }
        } catch(PDOException $exception){
            die('HATA: ' . $exception->getMessage());
        }
    }
    ?>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]."?id={$id}");?>" method="post">
        <table class='table table-hover table-responsive table-bordered'>
            <tr>
                <td>Ürün adı</td>
                <td><input type='text' name='urunadi' value="<?php echo htmlspecialchars($urunadi, ENT_QUOTES);  ?>" class='form-control' /></td>
            </tr>
            <tr>
                <td>Açıklama</td>
                <td><textarea name='aciklama' class='form-control' id='editor'><?php echo htmlspecialchars($aciklama, ENT_QUOTES);  ?></textarea></td>
            </tr>
            <tr>
                <td>Fiyat</td>
                <td><input type='text' name='fiyat' value="<?php echo htmlspecialchars($fiyat, ENT_QUOTES);  ?>" class='form-control' /></td>
            </tr>
            <tr>
                <td>Kategori</td>
                <td>
                    <?php 
                        $sorgu='select id, kategoriadi from kategoriler';
                        $stmt = $con->prepare($sorgu);
                        $stmt->execute();
                        $veri = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    ?>
                    <select name='kategori_id' class='form-control'>
                    <?php foreach ($veri as $kayit) { ?>
                        <option value="<?php echo $kayit["id"] ?>" <?php if($kayit["id"]==$kategori_id) echo " selected" ?>>
                            <?php echo $kayit["kategoriadi"] ?>
                        </option>
                    <?php } ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <button type="submit" class='btn btn-primary'>
                       <span class="glyphicon glyphicon-ok"></span> Kaydet
                    </button>
                    <a href='liste.php' class='btn btn-danger'><span class='glyphicon glyphicon glyphicon-list'></span> Ürün listesi</a>
                </td>
            </tr>
        </table>
    </form>

</div>

<?php include "../footer.php"; ?>
<script>
    CKEDITOR.replace('editor');
</script>