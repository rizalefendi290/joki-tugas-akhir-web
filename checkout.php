<?php
session_start();
include 'db.php';

// Mengambil informasi kontak admin
$kontak = mysqli_query($conn, "SELECT admin_telp, admin_email, admin_address FROM tb_admin WHERE admin_id = 1");
$a = mysqli_fetch_object($kontak);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    
    // Insert order into database
    $order_query = "INSERT INTO tb_order (order_name, order_address, order_phone, order_email) VALUES ('$name', '$address', '$phone', '$email')";
    mysqli_query($conn, $order_query);
    $order_id = mysqli_insert_id($conn);
    
    // Insert order details into database
    foreach ($_SESSION['cart'] as $product_id => $quantity) {
        $product_query = mysqli_query($conn, "SELECT * FROM tb_product WHERE product_id = '$product_id'");
        $product = mysqli_fetch_object($product_query);
        $product_price = $product->product_price;
        $total = $product_price * $quantity;
        
        $order_detail_query = "INSERT INTO tb_order_detail (order_id, product_id, quantity, price, total) VALUES ('$order_id', '$product_id', '$quantity', '$product_price', '$total')";
        mysqli_query($conn, $order_detail_query);
    }
    
    // Clear cart
    unset($_SESSION['cart']);
    
    // Redirect to a thank you page or order summary
    header("Location: thank_you.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css"  rel="stylesheet" />
</head>
<body class="bg-gray-900 text-white font-quicksand">

<nav class="bg-white border-gray-200 dark:bg-gray-900">
		<div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl p-4">
			<a href="https://flowbite.com" class="flex items-center space-x-3 rtl:space-x-reverse">
				<img src="img/logo copy.png" class="h-8" alt="Flowbite Logo" />
				<span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">NyemilNgab</span>
			</a>
			<div>
				<div>
					<form action="produk.php" class="flex justify-center">
						<input type="text" name="search" placeholder="Cari Produk" class="p-2 bg-gray-700 text-white rounded-l-md focus:outline-none">
						<button type="submit" name="cari" class="p-2 bg-red-600 text-white rounded-r-md hover:bg-red-500">Cari Produk</button>
					</form>
				</div>
			</div>
			<div class="flex items-center space-x-6 rtl:space-x-reverse">
				<a href="tel:5541251234" class="text-sm  text-gray-500 dark:text-white hover:underline">0859-1838-84204</a>
				<a href="login.php" class="text-sm  text-blue-600 dark:text-blue-500 hover:underline">Login</a>
			</div>
		</div>
	</nav>
	<nav class="bg-gray-50 dark:bg-gray-700 flex justify-center">
		<div class="max-w-screen-xl px-4 py-3 mx-auto">
			<div class="flex items-center">
				<ul class="flex flex-row font-medium mt-0 space-x-8 rtl:space-x-reverse text-sm">
					<li>
						<a href="index.php" class="text-gray-900 dark:text-white hover:underline" aria-current="page">Home</a>
					</li>
					<li>
						<a href="produk.php" class="text-gray-900 dark:text-white hover:underline">Produk</a>
					</li>
					<li>
						<a href="profil.php" class="text-gray-900 dark:text-white hover:underline">Profil</a>
					</li>
					<li>
						<a href="tentang-kami.php" class="text-gray-900 dark:text-white hover:underline">Contact Us</a>
					</li>
				</ul>
			</div>
		</div>
	</nav>

<div class="container mx-auto py-8 px-4">
    <h2 class="text-3xl mb-6 text-center">Checkout</h2>
    <form action="" method="POST" class="max-w-md mx-auto">
        <div class="mb-4">
            <label for="name" class="block mb-1">Nama Lengkap</label>
            <input type="text" id="name" name="name" class="w-full px-3 py-2 rounded bg-gray-800 border border-gray-700 focus:outline-none focus:border-green-500" required>
        </div>
        <div class="mb-4">
            <label for="address" class="block mb-1">Alamat</label>
            <textarea id="address" name="address" rows="4" class="w-full px-3 py-2 rounded bg-gray-800 border border-gray-700 focus:outline-none focus:border-green-500" required></textarea>
        </div>
        <div class="mb-4">
            <label for="phone" class="block mb-1">No. Telepon</label>
            <input type="text" id="phone" name="phone" class="w-full px-3 py-2 rounded bg-gray-800 border border-gray-700 focus:outline-none focus:border-green-500" required>
        </div>
        <div class="mb-6">
            <label for="email" class="block mb-1">Email</label>
            <input type="email" id="email" name="email" class="w-full px-3 py-2 rounded bg-gray-800 border border-gray-700 focus:outline-none focus:border-green-500" required>
        </div>
        <button type="submit" class="w-full bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded focus:outline-none focus:ring-2 focus:ring-green-600 focus:ring-opacity-50 transition duration-300">Proses Checkout</button>
    </form>
</div>

<footer class="bg-gray-800 py-4 mt-8">
    <div class="container mx-auto text-center">
        <p>&copy; 2024 - FKA Vape Store</p>
    </div>
</footer>

</body>
</html>
