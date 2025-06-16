<?php
// oturum işlemlerini başlat
session_start();

// sepeti boşalt
session_destroy();

include "header.php";
?>
<?php
// Oturum işlemlerini başlat
session_start();
// Sepeti boşalt
session_destroy();
include "header.php";
?>
<br>
<br>


<div class="container">
	<h2>Ödeme Bilgileri</h2>

	<br>
	<br>



	<form action="pos.php" method="POST">
		<label for="card_number">Kart Numarası: </label>
		<input type="text" id="card_number" name="card_number" required>


		<label for="expiry_date"> Kart Sahibi:</label>
		<input type="text" id="kart_name" name="kart_name" placeholder="" required>

		<br>
		<br>

		<label for="expiry_date">Son Kullanma Tarihi:</label>
		<input type="text" id="expiry_date" name="expiry_date" placeholder="MM/YY" required>


		<label for="cvv">CVV:</label>
		<input type="text" id="cvv" name="cvv" required>

		<br>
		<br>


		<div class="text-right">
			<button type="submit" class="btn btn-success btn-lg btn-block">
				<i class="fa fa-credit-card"></i> Satın al
			</button>
		</div>

		<br>

	</form>

</div>
<br>
<br>
<br>

<?php
include "footer.php";
?>

<div class="container mt-5 mb-5">
	<div class="col-md-12">
		<h2>Siparişiniz alındı!</h2>
		<hr>
		<!-- tell the user order has been placed -->
		<div class="alert alert-success">
			<strong>Bizi tercih ettiğiniz için teşekkür ederiz!</strong> Teslimatınız en kısa süre içinde belirttiğiniz
			adrese yapılacaktır.
		</div>
	</div>
</div>

<?php
include "footer.php";
?>

<!-- 
https://www.codeofaninja.com/2014/09/php-shopping-cart-tutorial-using-cookies.html

Add your $_POST/$_GET data into the cart array.

$cart = [];
If your moving to a new page then serialize cart array and add to the setcookie() function. 
Doing it this way you can have multiple items in your cart under one cookie.

setcookie('cart', 'serialize($cart)', time() + 60*100000, '/'); 
You can then access the cart array by using unserialize() on the cookie.

$newarray = unserialize($_COOKIE['cart']);
You can then expire the cookie after the purchase is complete.

setcookie('cart', 'serialize($cart)', time() - 60*100000, '/'); -->