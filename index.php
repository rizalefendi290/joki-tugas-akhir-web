<?php 
	include 'db.php';
	$kontak = mysqli_query($conn, "SELECT admin_telp, admin_email, admin_address FROM tb_admin WHERE admin_id = 1");
	$a = mysqli_fetch_object($kontak);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nyemil Ngab</title>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css"  rel="stylesheet" />
</head>
<body class="bg-gray-900 text-white font-sans">
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
					<li>
						<a href="keluar.php" class="text-gray-900 dark:text-white hover:underline">Logout</a>
					</li>
				</ul>
			</div>
		</div>
	</nav>
    <!-- Header -->
    <!-- Search -->

    <!-- Banner Thumbnail -->
    <div class="my-10 mx-4 md:mx-16 text-center">
        <img src="img/thumbnail10.jpg" alt="Thumbnail" class="w-full">
    </div>
    <!-- Kategori -->
    <div class="bg-gray-900 py-10 mx-20">
        <div class="container mx-auto text-center">
            <h3 class="text-2xl mb-6">Kategori</h3>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <?php 
                    $kategori = mysqli_query($conn, "SELECT * FROM tb_category ORDER BY category_id DESC");
                    if(mysqli_num_rows($kategori) > 0){
                        while($k = mysqli_fetch_array($kategori)){
                ?>
                <a href="produk.php?kat=<?php echo $k['category_id'] ?>" class="bg-gray-800 p-4 rounded hover:bg-gray-700">
                    <img src="img/icon-kategori.png" alt="Icon Kategori" class="w-12 mx-auto mb-2">
                    <p><?php echo $k['category_name'] ?></p>
                </a>
                <?php }}else{ ?>
                <p class="text-center col-span-2 md:col-span-4">Kategori tidak ada</p>
                <?php } ?>
            </div>
        </div>
    </div>
    <!-- Section Welcome -->
    <div class="text-center">
        <div class="container mx-auto">
            <h1 class="text-3xl mb-6">WELCOME TO NyemilNgab</h1>
        </div>
    </div>
    <!-- Produk Terbaru -->
    <div class=" m-20">
        <div class="container mx-auto text-center">
            <h3 class="text-2xl mb-6">Produk Terbaru</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <?php 
                    $produk = mysqli_query($conn, "SELECT * FROM tb_product WHERE product_status = 1 ORDER BY product_id DESC LIMIT 3");
                    if(mysqli_num_rows($produk) > 0){
                        while($p = mysqli_fetch_array($produk)){
                ?>
                <div class="bg-gray-800 rounded overflow-hidden transform transition-transform hover:scale-105">
                    <a href="detail-produk.php?id=<?php echo $p['product_id'] ?>" class="text-white text-center block">
                        <img src="produk/<?php echo $p['product_image'] ?>" alt="<?php echo $p['product_name'] ?>" class="w-full h-72 object-cover">
                        <div class="p-4">
                            <h5 class="text-xl mb-2"><?php echo substr($p['product_name'], 0, 30) ?></h5>
                            <p>Rp. <?php echo number_format($p['product_price']) ?></p>
                        </div>
                    </a>
                </div>
                <?php }}else{ ?>
                <p class="text-center col-span-1 md:col-span-3">Produk tidak ada</p>
                <?php } ?>
            </div>
        </div>
    </div>
    <!-- Footer -->
    <footer class="bg-gray-800 text-center py-10">
        <div class="container mx-auto">
            <h4 class="text-xl mb-2">Alamat</h4>
            <p class="mb-4"><?php echo $a->admin_address ?></p>
            <h4 class="text-xl mb-2">Email</h4>
            <p class="mb-4"><?php echo $a->admin_email ?></p>
            <h4 class="text-xl mb-2">No. Hp</h4>
            <p class="mb-4"><?php echo $a->admin_telp ?></p>
            <small>&copy; 2024 - NyemilNgab.</small>
        </div>
    </footer>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
</body>
</html>
