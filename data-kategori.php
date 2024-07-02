<?php 
	include 'db.php';
	session_start();

	// Cek apakah user adalah admin
	$isAdmin = isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>NyemilNgab</title>
	<link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css"  rel="stylesheet" />
	<script>
		// Script JavaScript untuk menampilkan alert jika bukan admin
		window.onload = function() {
			// Cek apakah pengguna adalah admin
			var isAdmin = "<?php echo $isAdmin ?>";
			if (!isAdmin) {
				alert("Anda tidak diizinkan mengakses halaman ini.");
				window.location.href = "index.php"; // Ganti dengan halaman yang sesuai
			}
		};
	</script>
</head>
<body class="bg-gray-900 text-white font-quicksand">

	<!-- header -->
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
	<h3 class="text-center text-2xl text-white mb-4">Data Kategori</h3>
	<div class="container mx-auto flex justify-center">
		<div class="box bg-gray-800 rounded-lg p-4 ">
			<p><a href="tambah-kategori.php" class="btn bg-red-600 hover:bg-red-700">Tambah Data</a></p>
			<table class="table border-collapse border-gray-600 mt-4 flex justify-center">
				<thead>
					<tr>
						<th class="py-2 px-4 bg-gray-700 text-white">No</th>
						<th class="py-2 px-4 bg-gray-700 text-white">Kategori</th>
						<th class="py-2 px-4 bg-gray-700 text-white">Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$no = 1;
						$kategori = mysqli_query($conn, "SELECT * FROM tb_category ORDER BY category_id DESC");
						if(mysqli_num_rows($kategori) > 0){
							while($row = mysqli_fetch_array($kategori)){
					?>
					<tr class="<?php echo $no % 2 === 0 ? 'bg-gray-700' : 'bg-gray-800' ?>">
						<td class="py-2 px-4"><?php echo $no++ ?></td>
						<td class="py-2 px-4"><?php echo $row['category_name'] ?></td>
						<td class="py-2 px-4">
							<a href="edit-kategori.php?id=<?php echo $row['category_id'] ?>" class="text-blue-400 hover:underline">Edit</a> || 
							<a href="proses-hapus.php?idk=<?php echo $row['category_id'] ?>" onclick="return confirm('Yakin ingin hapus ?')" class="text-red-400 hover:underline">Hapus</a>
						</td>
					</tr>
					<?php }}else{ ?>
					<tr>
						<td colspan="3" class="py-2 px-4">Tidak ada data</td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>


	<!-- footer -->
	<footer class="bg-gray-800 py-4 mt-8">
		<div class="container mx-auto text-center">
			<small>&copy; 2024 - FKA Vape Store</small>
		</div>
	</footer>

</body>
</html>
