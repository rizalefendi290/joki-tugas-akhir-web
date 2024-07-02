<?php
session_start();
include 'db.php';

// Query untuk mengambil data pesanan dari database
$sql = "SELECT o.*, od.*, p.product_name, od.status AS detail_status 
        FROM tb_order o
        JOIN tb_order_detail od ON o.order_id = od.order_id
        JOIN tb_product p ON od.product_id = p.product_id
        ORDER BY o.order_date DESC";
$result = $conn->query($sql);

// Inisialisasi array untuk menyimpan data pesanan
$orders = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        // Menambahkan detail pesanan ke dalam array
        $order_id = $row['order_id'];
        $order_name = $row['order_name'];
        $order_address = $row['order_address'];
        $order_phone = $row['order_phone'];

        $order_details = array(
            'product_id' => $row['product_id'],
            'product_name' => $row['product_name'],
            'quantity' => $row['quantity'],
            'price' => $row['price'],
            'total' => $row['total'],
            'status' => $row['detail_status']
        );

        // Memastikan order_id sudah ada dalam array
        if (!isset($orders[$order_id])) {
            $orders[$order_id] = array(
                'order_id' => $order_id,
                'order_name' => $order_name,
                'order_address' => $order_address,
                'order_phone' => $order_phone,
                'order_date' => $row['order_date'],
                'order_details' => array()
            );
        }

        // Menambahkan detail pesanan ke dalam array pesanan utama
        $orders[$order_id]['order_details'][] = $order_details;
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pesanan - NyemilNgab</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css"  rel="stylesheet" />
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">

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

<!-- Main Content -->
<div class="container mx-auto mt-4">
    <!-- Page Title -->
    <h2 class="text-2xl font-semibold text-gray-800 mb-4 text-center">Data Pesanan</h2>

    <!-- Orders List -->
    <?php foreach ($orders as $order): ?>
        <div class="mb-6 bg-white rounded-lg shadow p-6 mx-20">
            <div class="flex justify-between items-center mb-4">
                <div class="col">
                    <h3 class="text-lg font-semibold text-gray-800">Order ID: <?php echo $order['order_id']; ?></h3>
                    <p class="text-sm text-gray-600">Nama: <?php echo $order['order_name']; ?></p>
                    <p class="text-sm text-gray-600">Alamat: <?php echo $order['order_address']; ?></p>
                    <p class="text-sm text-gray-600">Telepon: <?php echo $order['order_phone']; ?></p>
                    <p class="text-sm text-gray-600">Tanggal: <?php echo $order['order_date']; ?></p>
                </div>
                <div>
                    <span class="bg-green-200 text-green-800 px-2 py-1 rounded-full text-xs">
                        <?php
                            // Inisialisasi status
                            $status = 'Sudah Diproses'; // Default status

                            // Loop untuk mengecek status detail pesanan
                            foreach ($order['order_details'] as $detail) {
                                if ($detail['status'] == 'Belum Diproses') {
                                    $status = 'Belum Diproses';
                                    break;
                                }
                            }

                            echo $status;
                        ?>
                    </span>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="table-auto w-full border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="py-2 px-3 border-b border-gray-300">Produk</th>
                            <th class="py-2 px-3 border-b border-gray-300">Quantity</th>
                            <th class="py-2 px-3 border-b border-gray-300">Harga</th>
                            <th class="py-2 px-3 border-b border-gray-300">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($order['order_details'] as $detail): ?>
                            <tr>
                                <td class="py-2 px-3 border-b border-gray-300"><?php echo $detail['product_name']; ?></td>
                                <td class="py-2 px-3 border-b border-gray-300"><?php echo $detail['quantity']; ?></td>
                                <td class="py-2 px-3 border-b border-gray-300">Rp <?php echo number_format($detail['price'], 2); ?></td>
                                <td class="py-2 px-3 border-b border-gray-300">Rp <?php echo number_format($detail['total'], 2); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php endforeach; ?>
    <!-- End of Orders List -->
</div>


</body>
</html>
