<?php 
  session_start();

  if ($_SESSION["loginkey"] == "") {
    // oturum açılmamışsa login.php sayfasına git
    header("Location: /proje/admin/login.php");
  } 

    include '../../config/vtabani.php';

    $ids = implode(',', $_POST['id']);
    $con->query("DELETE FROM urunler WHERE id IN ($ids)");
?>