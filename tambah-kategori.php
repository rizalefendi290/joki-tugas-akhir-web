<?php 
include 'db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FKA Vape Store</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css"  rel="stylesheet" />
</head>
<body class="bg-gray-900 text-white font-quicksand">
    <!-- header -->
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
						<a href="data-kategori.php" class="text-gray-900 dark:text-white hover:underline">Data Kategori</a>
					</li>
					<li>
						<a href="data-produk.php" class="text-gray-900 dark:text-white hover:underline">Data Produk</a>
					</li>
					<li>
						<a href="data-penjualan.php" class="text-gray-900 dark:text-white hover:underline">Data Penjualan</a>
					</li>
				</ul>
			</div>
		</div>
	</nav>

    <!-- content -->
    <div class="section py-8">
        <div class="container mx-auto">
            <h3 class="text-white text-center text-2xl mb-4">Tambah Data Kategori</h3>
            <div class="bg-gray-800 rounded-lg p-4 flex justify-center">
                <form action="" method="POST">
                    <input type="text" name="nama" placeholder="Nama Kategori" class="input-control text-black">
                    <button type="submit" name="submit" class="btn bg-red-600 hover:bg-red-700 p-2">Submit</button>
                </form>
                <?php 
                if(isset($_POST['submit'])){
                    $nama = ucwords($_POST['nama']);
                    $insert = mysqli_query($conn, "INSERT INTO tb_category (category_name) VALUES ('".$nama."') ");
                    if($insert){
                        echo '<script>alert("Tambah data berhasil")</script>';
                        echo '<script>window.location="data-kategori.php"</script>';
                    }else{
                        echo 'Gagal '.mysqli_error($conn);
                    }
                }
                ?>
            </div>
        </div>
    </div>

    <!-- footer -->
    <footer class="bg-gray-800 text-white text-center py-4 absolute bottom-0 w-full">
        <div class="container mx-auto">
            <small>&copy; 2024 - FKA Vape Store</small>
        </div>
    </footer>
</body>
</html>
