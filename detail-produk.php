<?php 
	error_reporting(0);
	session_start();
	include 'db.php';
	$kontak = mysqli_query($conn, "SELECT admin_telp, admin_email, admin_address FROM tb_admin WHERE admin_id = 1");
	$a = mysqli_fetch_object($kontak);

	$produk = mysqli_query($conn, "SELECT * FROM tb_product WHERE product_id = '".$_GET['id']."' ");
	$p = mysqli_fetch_object($produk);

	// Menambah produk ke keranjang
	if (isset($_POST['add_to_cart'])) {
	    $product_id = $_POST['product_id'];
	    $quantity = $_POST['quantity'];

	    if (!isset($_SESSION['cart'])) {
	        $_SESSION['cart'] = array();
	    }

	    if (isset($_SESSION['cart'][$product_id])) {
	        $_SESSION['cart'][$product_id] += $quantity;
	    } else {
	        $_SESSION['cart'][$product_id] = $quantity;
	    }

	    header("Location: pesanan.php");
	    exit();
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>NyemilNgab</title>
    <script src="https://cdn.tailwindcss.com"></script>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css"  rel="stylesheet" />
	<style>
		body {
			font-family: 'Quicksand', sans-serif;
		}
	</style>
</head>
<body class="bg-gray-900 text-white">
	<!-- Header -->
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
	<!-- Product Detail -->
	<div class="py-10">
		<div class="container mx-auto">
			<h3 class="text-3xl mb-6 text-center">Detail Produk</h3>
			<div class="grid grid-cols-1 md:grid-cols-2 gap-8 mx-20">
				<div>
					<img src="produk/<?php echo $p->product_image ?>" alt="<?php echo $p->product_name ?>" class="w-full rounded">
				</div>
				<div>
					<h3 class="text-2xl font-bold mb-4"><?php echo $p->product_name ?></h3>
					<h4 class="text-xl mb-4">Rp. <?php echo number_format($p->product_price) ?></h4>
					<p class="mb-4">Deskripsi:<br><?php echo $p->product_description ?></p>
					<form method="POST" action="">
						<input type="hidden" name="product_id" value="<?php echo $p->product_id ?>">
						<input type="number" name="quantity" value="1" min="1" class="p-2 rounded border border-gray-600 bg-gray-700 text-white focus:outline-none w-20">
						<button type="submit" name="add_to_cart" class="p-2 bg-green-600 text-white rounded hover:bg-green-500 focus:outline-none">Tambah ke Keranjang</button>
					</form>
				</div>
			</div>
		</div>
	</div>

	<!-- Footer -->
	<footer class="bg-gray-800 py-10">
		<div class="container mx-auto text-center">
			<h4 class="text-xl mb-2">Alamat</h4>
			<p class="mb-4"><?php echo $a->admin_address ?></p>
			<h4 class="text-xl mb-2">Email</h4>
			<p class="mb-4"><?php echo $a->admin_email ?></p>
			<h4 class="text-xl mb-2">No. Hp</h4>
			<p class="mb-4"><?php echo $a->admin_telp ?></p>
			<small>&copy; 2024 - FKA Vape Store.</small>
		</div>
	</footer>
</body>
</html>
