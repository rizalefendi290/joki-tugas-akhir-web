<?php
session_start();
include 'db.php';

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    // Jika belum login, redirect ke halaman login
    $_SESSION['error'] = "Silakan login terlebih dahulu untuk melanjutkan.";
    header("Location: login.php");
    exit();
}
// Menghapus item dari keranjang
if (isset($_POST['remove'])) {
    $product_id = $_POST['product_id'];
    unset($_SESSION['cart'][$product_id]);
}

// Melanjutkan ke checkout
if (isset($_POST['checkout'])) {
    // Anda bisa menambahkan proses checkout di sini
    header("Location: checkout.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan Anda</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Quicksand', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-900 text-white">
    <div class="container mx-auto py-10 px-4">
        <h1 class="text-2xl font-bold text-center text-white mb-6">Pesanan Anda</h1>
        <?php if (!empty($_SESSION['cart'])): ?>
        <div class="overflow-x-auto mx-10">
            <table class="min-w-full bg-gray-800 rounded-lg">
                <thead>
                    <tr>
                        <th class="py-2 px-4 bg-gray-700 text-left text-white">Produk</th>
                        <th class="py-2 px-4 bg-gray-700 text-left text-white">Jumlah</th>
                        <th class="py-2 px-4 bg-gray-700 text-left text-white">Harga</th>
                        <th class="py-2 px-4 bg-gray-700 text-left text-white">Total</th>
                        <th class="py-2 px-4 bg-gray-700 text-left text-white">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $total_price = 0;
                    foreach ($_SESSION['cart'] as $product_id => $quantity):
                        $result = mysqli_query($conn, "SELECT * FROM tb_product WHERE product_id = $product_id");
                        $product = mysqli_fetch_object($result);
                        $total = $product->product_price * $quantity;
                        $total_price += $total;
                    ?>
                    <tr>
                        <td class="py-2 px-4 border-b border-gray-700"><?php echo $product->product_name; ?></td>
                        <td class="py-2 px-4 border-b border-gray-700"><?php echo $quantity; ?></td>
                        <td class="py-2 px-4 border-b border-gray-700">Rp. <?php echo number_format($product->product_price); ?></td>
                        <td class="py-2 px-4 border-b border-gray-700">Rp. <?php echo number_format($total); ?></td>
                        <td class="py-2 px-4 border-b border-gray-700">
                            <form method="POST" action="">
                                <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                                <button type="submit" name="remove" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-500 focus:outline-none">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="text-right text-xl text-red-600 mt-4 mx-10">
            Total Harga: Rp. <?php echo number_format($total_price); ?>
        </div>
        <div class="flex justify-between items-center mt-6 mx-10">
            <form method="POST" action="">
                <button type="submit" name="checkout" class="px-6 py-3 bg-green-600 text-white rounded hover:bg-green-500 focus:outline-none">Lanjutkan ke Checkout</button>
            </form>
            <a href="produk.php">
                <button class="px-6 py-3 bg-red-600 text-white rounded hover:bg-red-500 focus:outline-none">Tambah Produk Lain</button>
            </a>
        </div>
        <?php else: ?>
        <p class="text-center text-xl text-red-600 mt-6">Keranjang Anda kosong.</p>
        <?php endif; ?>
    </div>
</body>
</html>
