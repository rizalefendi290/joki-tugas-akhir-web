<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FKA Vape Store</title>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css"  rel="stylesheet" />
    <style>
        body {
            background-color: #1a202c;
            color: white;
            font-family: 'Quicksand', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-900 text-white">
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

    <!-- Profile Team -->
    <div class="container mx-auto mt-10">
        <h1 class="text-4xl mb-10 text-center">Profile Saya</h1>
        <div class="flex flex-wrap -mx-4 flex justify-center">
            <div class="w-full md:w-1/3 px-4 mb-8">
                <div class="bg-gray-800 rounded-lg text-center p-4">
                    <img src="img/nofi.webp" alt="" class="w-full rounded-t-lg">
                    <div class="p-4">
                        <h5 class="text-xl font-bold">Nama : Nofia Fitriani</h5>
                        <p class="text-gray-400">NPM : 211832070100</p>
                        <p class="text-gray-400">Prodi : Teknik Informatika</p>
                        <p class="text-gray-400">Deskripsi : Akan aku hadapi semuanya, tapi bentar mau tidur dulu.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Contact Us -->
    <div class="container mx-auto py-10">
        <h1 class="text-4xl mb-10 text-center">Contact Us</h1>
        <div class="flex flex-wrap -mx-4 flex justify-center">
            <div class="w-full md:w-1/2 px-4">
                <form>
                    <div class="mb-4">
                        <label for="email" class="block text-gray-400 mb-2">Email address</label>
                        <input type="email" id="email" placeholder="name@example.com" class="w-full p-2 bg-gray-700 text-white rounded">
                    </div>
                    <div class="mb-4">
                        <label for="message" class="block text-gray-400 mb-2">Message</label>
                        <textarea id="message" rows="3" class="w-full p-2 bg-gray-700 text-white rounded"></textarea>
                    </div>
                    <button type="submit" class="bg-red-600 hover:bg-red-500 text-white p-2 rounded">Kirim</button>
                </form>
            </div>
        </div>
    </div>

    <!-- footer -->
    <footer class="bg-gray-800 py-10 text-center">
        <div class="container mx-auto">
            <h4 class="text-xl font-bold mb-2">Alamat</h4>
            <p class="text-gray-400">Jl. BAGO No. 123, Tulungagung</p>
            <h4 class="text-xl font-bold mb-2">Email</h4>
            <p class="text-gray-400">example@example.com</p>
            <h4 class="text-xl font-bold mb-2">No. Hp</h4>
            <p class="text-gray-400">+628123456789</p>
            <small class="text-gray-500">&copy; 2024 - FKA Vape Store</small>
        </div>
    </footer>
</body>

</html>
