<?php 
session_start();
include 'db.php';

// Check if session id is set, else set a default id for demonstration purposes
if(!isset($_SESSION['id'])) {
    $_SESSION['id'] = 1; // Default admin ID
}

// Fetch admin details from the database
$query = mysqli_query($conn, "SELECT * FROM users WHERE id = '".$_SESSION['id']."' ");
$d = mysqli_fetch_object($query);

// Handle form submission for updating profile
if(isset($_POST['submit'])){
    $nama = $_POST['nama'];
    $user = $_POST['user'];
    $hp = $_POST['hp'];
    $email = $_POST['email'];
    $alamat = $_POST['alamat'];

    $update = mysqli_query($conn, "UPDATE users SET 
                nama = '$nama',
                username = '$user',
                no_telp = '$hp',
                email = '$email',
                alamat = '$alamat'
                WHERE id = '".$d->id."' ");

    if($update){
        echo '<script>alert("Profil berhasil diperbarui")</script>';
        echo '<script>window.location="profil.php"</script>';
    } else {
        echo '<script>alert("Gagal memperbarui profil")</script>';
    }
}

// Handle form submission for updating password
if(isset($_POST['ubah_password'])){
    $pass1  = $_POST['pass1'];
    $pass2  = $_POST['pass2'];

    if($pass2 != $pass1){
        echo '<script>alert("Konfirmasi Password Baru tidak sesuai")</script>';
    } else {
        $u_pass = mysqli_query($conn, "UPDATE users SET 
                    password = '".MD5($pass1)."'
                    WHERE id = '".$d->id."' ");

        if($u_pass){
            echo '<script>alert("Password berhasil diubah")</script>';
            echo '<script>window.location="profil.php"</script>';
        } else {
            echo '<script>alert("Gagal mengubah password")</script>';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>NyemilNgab</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css"  rel="stylesheet" />
    <style>
        /* Optional: Custom styles */
        .input-control {
            padding: 0.5rem;
            border-radius: 0.375rem;
            border: 1px solid #4a5568;
            background-color: #2d3748;
            color: white;
            margin-bottom: 1rem;
            width: calc(100% - 2rem); /* Adjusted width for Tailwind consistency */
        }
        .btn {
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            background-color: #e53e3e;
            color: white;
            border: none;
            cursor: pointer;
        }
        .btn:hover {
            background-color: #c53030;
        }
    </style>
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
            <h3 class="text-white text-center text-2xl mb-8">Profil</h3>
            <div class="bg-gray-800 rounded-lg p-4 mx-20">
                <form action="" method="POST">
                    <input type="text" name="nama" placeholder="Nama Lengkap" class="input-control" value="<?php echo $d->nama ?>" required>
                    <input type="text" name="user" placeholder="Username" class="input-control" value="<?php echo $d->username ?>" required>
                    <input type="text" name="hp" placeholder="No Hp" class="input-control" value="<?php echo $d->no_telp ?>" required>
                    <input type="email" name="email" placeholder="Email" class="input-control" value="<?php echo $d->email ?>" required>
                    <input type="text" name="alamat" placeholder="Alamat" class="input-control" value="<?php echo $d->alamat ?>" required>
                    <input type="submit" name="submit" value="Ubah Profil" class="btn bg-red-600 hover:bg-red-700">
                </form>
            </div>

            <h3 class="text-white text-center text-2xl mt-8 mb-8">Ubah Password</h3>
            <div class="bg-gray-800 rounded-lg p-4 mx-20">
                <form action="" method="POST">
                    <input type="password" name="pass1" placeholder="Password Baru" class="input-control" required>
                    <input type="password" name="pass2" placeholder="Konfirmasi Password Baru" class="input-control" required>
                    <input type="submit" name="ubah_password" value="Ubah Password" class="btn bg-red-600 hover:bg-red-700">
                </form>
                <?php 
                    if(isset($_POST['ubah_password'])){

                        $pass1  = $_POST['pass1'];
                        $pass2  = $_POST['pass2'];

                        if($pass2 != $pass1){
                            echo '<script>alert("Konfirmasi Password Baru tidak sesuai")</script>';
                        }else{

                            $u_pass = mysqli_query($conn, "UPDATE users SET 
                                        password = '".MD5($pass1)."'
                                        WHERE id = '".$d->id."' ");
                            if($u_pass){
                                echo '<script>alert("Ubah data berhasil")</script>';
                                echo '<script>window.location="profil.php"</script>';
                            }else{
                                echo 'gagal '.mysqli_error($conn);
                            }
                        }

                    }
                ?>
            </div>
        </div>
    </div>

    <!-- footer -->
    <footer class="bg-gray-800 text-white text-center py-4">
        <div class="container mx-auto">
            <small>&copy; 2024 - FKA Vape Store</small>
        </div>
    </footer>
</body>
</html>
