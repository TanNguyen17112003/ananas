<?php
session_start();
ob_start();
$rootPath = '/Lap_trinh_web';
require_once '../database/DB.php';

if (isset($_POST['key'])) {
    $key = mysqli_real_escape_string($conn, $_POST['key']);
    $sqlSearch = "SELECT * FROM product WHERE product.name LIKE '%$key%' OR product.description LIKE '%$key%' lIMIT 4";
    $result = $conn->query($sqlSearch);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
?>
            <a href="<?= $rootPath ?>/product_detail.php?productId=<?= $row['product_id'] ?>" class="d-block p-2 text-decoration-none live-search__result-link">
                <div class="d-flex">
                    <div>
                        <img src="<?= $rootPath ?>/public/img/products/<?= $row['images'] ?>" class="rounded" width="50px">
                    </div>
                    <div class="ps-3">
                        <div class="text-primary"><?= $row['name'] ?></div>
                        <?php
                        if ($row['price_sale'] != 0) {
                        ?>
                            <span class="text-danger"><b><?= number_format($row['price_sale']) ?> <sup>đ</sup></b></span>
                            <span class="text-secondary"><del><?= number_format($row['price']) ?></del><sup>đ</sup></span>
                        <?php
                        } else {
                        ?>
                            <p class="text-secondary"><b><?= number_format($row['price']) ?> <sup>đ</sup></b></p>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </a>
<?php
        }
    } else {
        echo '<div class="text-danger p-2"><b>Không tìm thấy sản phẩm nào</b></div>';
    }
}
?>