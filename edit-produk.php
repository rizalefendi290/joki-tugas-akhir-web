<?php 
session_start();
include 'db.php';

// Periksa status login sebelum memproses halaman


// Ambil data produk yang akan diedit
if(isset($_GET['id'])){
    $produk = mysqli_query($conn, "SELECT * FROM tb_product WHERE product_id = '".$_GET['id']."' ");
    if(mysqli_num_rows($produk) == 0){
        echo '<script>window.location="data-produk.php"</script>';
        exit; // Redirect jika produk tidak ditemukan
    }
    $p = mysqli_fetch_object($produk);
} else {
    echo '<script>window.location="data-produk.php"</script>';
    exit; // Redirect jika parameter ID tidak ada
}

// Proses form jika disubmit
if(isset($_POST['submit'])){
    // Ambil data dari form
    $kategori   = $_POST['kategori'];
    $nama       = $_POST['nama'];
    $harga      = $_POST['harga'];
    $deskripsi  = $_POST['deskripsi'];
    $status     = $_POST['status'];
    $foto       = $p->product_image; // Simpan nama gambar lama sebagai default

    // Cek apakah ada gambar baru diupload
    if(isset($_FILES['gambar']['name']) && !empty($_FILES['gambar']['name'])){
        $filename = $_FILES['gambar']['name'];
        $tmp_name = $_FILES['gambar']['tmp_name'];

        // Validasi format file
        $type1 = explode('.', $filename);
        $type2 = end($type1);
        $newname = 'produk' . time() . '.' . $type2;
        $tipe_diizinkan = array('jpg', 'jpeg', 'png', 'gif');

        if(!in_array(strtolower($type2), $tipe_diizinkan)){
            echo '<script>alert("Format file tidak diizinkan")</script>';
        } else {
            // Hapus gambar lama dan pindahkan yang baru
            unlink('./produk/'.$p->product_image); // Hapus gambar lama
            move_uploaded_file($tmp_name, './produk/'.$newname); // Pindahkan gambar baru
            $foto = $newname; // Simpan nama gambar baru
        }
    }

    // Query update data produk
    $update = mysqli_query($conn, "UPDATE tb_product SET 
                            category_id = '".$kategori."',
                            product_name = '".$nama."',
                            product_price = '".$harga."',
                            product_description = '".$deskripsi."',
                            product_image = '".$foto."',
                            product_status = '".$status."'
                            WHERE product_id = '".$p->product_id."'	");
    
    if($update){
        echo '<script>alert("Ubah data berhasil")</script>';
        echo '<script>window.location="data-produk.php"</script>';
        exit; // Redirect setelah update berhasil
    } else {
        echo 'gagal '.mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>NyemilNgab - Edit Data Produk</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css"  rel="stylesheet" />
    <script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background-color: #1a202c;
            color: white;
            font-family: 'Quicksand', sans-serif;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #2d3748;
            padding: 1rem 0;
            text-align: center;
        }
        header h1 {
            margin: 0;
            font-size: 2rem;
        }
        header ul {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            justify-content: center;
        }
        header ul li {
            margin: 0 1rem;
        }
        header ul li a {
            color: white;
            text-decoration: none;
            font-size: 1.25rem;
        }
        .section {
            padding: 2.5rem 0;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1rem;
        }
        .box {
            background-color: #2d3748;
            padding: 2rem;
            border-radius: 0.375rem;
        }
        .input-control {
            width: calc(100% - 20px); /* Menyesuaikan dengan gaya input lainnya */
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #4a5568;
            border-radius: 0.375rem;
            font-size: 14px;
            box-sizing: border-box;
            background-color: #2d3748;
            color: white;
        }
        .input-control:focus {
            outline: none;
            border-color: #63b3ed;
        }
        .btn {
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            background-color: #63b3ed;
            color: white;
            border: none;
            cursor: pointer;
            display: inline-block;
            text-align: center;
            text-decoration: none;
        }
        .btn:hover {
            background-color: #4299e1;
        }
        /* Gaya khusus untuk tombol hapus */
        .btn-delete {
            background-color: #e53e3e;
        }
        .btn-delete:hover {
            background-color: #c53030;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px; /* Penyesuaian agar terlihat lebih terpisah dari form */
        }
        .table th, .table td {
            padding: 1rem;
            border: 1px solid #4a5568;
            text-align: left;
            color: white; /* Menggunakan warna teks putih */
        }
        .table th {
            background-color: #4a5568;
        }
        .table td {
            background-color: #2d3748;
        }
        .table a {
            color: #63b3ed;
            text-decoration: none;
        }
        .table a:hover {
            text-decoration: underline;
        }
        /* Penyesuaian gambar */
        .table img {
            max-width: 100px;
            height: auto;
            display: block;
            margin: 0 auto;
        }
    </style>
</head>
<body>
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
				</ul>
			</div>
		</div>
	</nav>

    <!-- content -->
    <div class="section">
        <div class="container">
            <h3 class="text-center mb-5">Edit Data Produk</h3>
            <div class="box mx-20">
                <form action="" method="POST" enctype="multipart/form-data">
                    <select class="input-control" name="kategori" required>
                        <option value="">--Pilih--</option>
                        <?php 
                            $kategori_query = mysqli_query($conn, "SELECT * FROM tb_category ORDER BY category_id DESC");
                            while($row = mysqli_fetch_array($kategori_query)){
                                $selected = ($row['category_id'] == $p->category_id) ? 'selected' : '';
                                echo '<option value="'.$row['category_id'].'" '.$selected.'>'.$row['category_name'].'</option>';
                            }
                        ?>
                    </select>

                    <input type="text" name="nama" class="input-control" placeholder="Nama Produk" value="<?php echo $p->product_name ?>" required>
                    <input type="text" name="harga" class="input-control" placeholder="Harga" value="<?php echo $p->product_price ?>" required>
                    
                    <img src="produk/<?php echo $p->product_image ?>" width="100px">
                    <input type="hidden" name="foto" value="<?php echo $p->product_image ?>">
                    <input type="file" name="gambar" class="input-control">
                    <textarea class="input-control" name="deskripsi" placeholder="Deskripsi"><?php echo $p->product_description ?></textarea><br>
                    <select class="input-control" name="status">
                        <option value="">--Pilih--</option>
                        <option value="1" <?php echo ($p->product_status == 1) ? 'selected' : ''; ?>>Aktif</option>
                        <option value="0" <?php echo ($p->product_status == 0) ? 'selected' : ''; ?>>Tidak Aktif</option>
                    </select>
                    <input type="submit" name="submit" value="Submit" class="btn">
                </form>
            </div>
        </div>
    </div>

    <!-- footer -->
    <footer>
        <div class="container flex justify-center mb-20">
            <small>&copy; 2024 - NyemilNgab</small>
        </div>
    </footer>

    <script>
        CKEDITOR.replace('deskripsi');
    </script>
</body>
</html>
