<?php
include 'db.php';

if (isset($_GET['idk'])) {
    $category_id = $_GET['idk'];

    // Prepared statement untuk menghapus kategori
    $stmt_delete_category = $conn->prepare("DELETE FROM tb_category WHERE category_id = ?");
    $stmt_delete_category->bind_param("i", $category_id);

    if ($stmt_delete_category->execute()) {
        echo '<script>window.location="data-kategori.php"</script>';
    } else {
        echo '<script>alert("Gagal menghapus kategori")</script>';
        echo '<script>window.location="data-kategori.php"</script>';
    }

    $stmt_delete_category->close();
}

if (isset($_GET['idp'])) {
    $product_id = $_GET['idp'];

    // Prepared statement untuk mengambil nama file gambar produk
    $stmt_select_image = $conn->prepare("SELECT product_image FROM tb_product WHERE product_id = ?");
    $stmt_select_image->bind_param("i", $product_id);
    $stmt_select_image->execute();
    $stmt_select_image->bind_result($product_image);
    $stmt_select_image->fetch();
    $stmt_select_image->close();

    // Hapus file gambar dari direktori
    if ($product_image) {
        $file_path = './produk/' . $product_image;
        if (file_exists($file_path)) {
            unlink($file_path);
        }
    }

    // Prepared statement untuk menghapus produk
    $stmt_delete_product = $conn->prepare("DELETE FROM tb_product WHERE product_id = ?");
    $stmt_delete_product->bind_param("i", $product_id);

    if ($stmt_delete_product->execute()) {
        echo '<script>window.location="data-produk.php"</script>';
    } else {
        echo '<script>alert("Gagal menghapus produk")</script>';
        echo '<script>window.location="data-produk.php"</script>';
    }

    $stmt_delete_product->close();
}
?>
