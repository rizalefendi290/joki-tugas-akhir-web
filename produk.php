<?php 
error_reporting(0);
include 'db.php';

// Mengambil informasi kontak admin
$kontak = mysqli_query($conn, "SELECT admin_telp, admin_email, admin_address FROM tb_admin WHERE admin_id = 1");
$a = mysqli_fetch_object($kontak);

// Inisialisasi variabel pencarian
$search = isset($_GET['search']) ? $_GET['search'] : '';
$kategori = isset($_GET['kat']) ? $_GET['kat'] : '';

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>NyemilNgab</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background-color: #1a202c;
            color: white;
            font-family: 'Quicksand', sans-serif;
        }
        .container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
        }
        .col-4 img {
            width: 250px;
            height: 200px;
            border-radius: 0.375rem;
        }
        .col-4 .nama {
            font-size: 1.25rem;
            margin: 1rem 0 0.5rem;
        }
        .col-4 .harga {
            color: #a0aec0;
            font-size: 1rem;
        }
    </style>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css"  rel="stylesheet" />

</head>
<body class="bg-gray-900 text-white">
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
				</ul>
			</div>
		</div>
	</nav>
    <!-- new product -->
    <div class="py-10">
        <div class="container mx-auto">
            <h3 class="text-2xl mb-6 text-center">Produk</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mx-20">
                <?php 
                // Query untuk mendapatkan produk berdasarkan pencarian dan kategori
                $whereClause = "";
                if (!empty($search) || !empty($kategori)) {
                    $whereClause = "AND product_name LIKE ? AND category_id LIKE ?";
                }

                $stmt = $conn->prepare("SELECT * FROM tb_product WHERE product_status = 1 $whereClause ORDER BY product_id DESC");
                
                // Bind parameter untuk prepared statement
                if (!empty($search) || !empty($kategori)) {
                    $searchParam = "%$search%";
                    $stmt->bind_param("ss", $searchParam, $kategori);
                }

                $stmt->execute();
                $result = $stmt->get_result();

                if($result->num_rows > 0){
                    while($p = $result->fetch_assoc()){
                ?>  
                    <a href="detail-produk.php?id=<?php echo $p['product_id'] ?>" class="text-white no-underline">
                        <div class="bg-gray-800 p-4 rounded overflow-hidden transform transition-transform hover:scale-105">
                            <img src="produk/<?php echo $p['product_image'] ?>" class="w-full h-48 object-cover rounded">
                            <p class="nama mt-4"><?php echo htmlspecialchars(substr($p['product_name'], 0, 30)); ?></p>
                            <p class="harga">Rp. <?php echo number_format($p['product_price']); ?></p>
                        </div>
                    </a>
                <?php }}else{ ?>
                    <p class="text-center col-span-3">Produk tidak ada</p>
                <?php } ?>
            </div>
        </div>
    </div>

    <!-- footer -->
    <footer class="bg-gray-800 text-center py-10">
        <div class="container mx-auto">
            <h4 class="text-xl mb-2">Alamat</h4>
            <p class="mb-4"><?php echo htmlspecialchars($a->admin_address); ?></p>

            <h4 class="text-xl mb-2">Email</h4>
            <p class="mb-4"><?php echo htmlspecialchars($a->admin_email); ?></p>

            <h4 class="text-xl mb-2">No. Hp</h4>
            <p class="mb-4"><?php echo htmlspecialchars($a->admin_telp); ?></p>
            <small>&copy; 2024 - FKA Vape Store</small>
        </div>
    </footer>
    
	<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
</body>
</html>
