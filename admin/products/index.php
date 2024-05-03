<?php
session_start();
ob_start();
$rootPath = '/ananas/admin';
require_once '../../database/DB.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý sản phẩm</title>
    <link rel="stylesheet"  href="https://site-assets.fontawesome.com/releases/v6.1.2/css/all.css">
    
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="../../public/css/base.css">
    <link rel="stylesheet" href="../../public/css/product.css">
    <link rel="stylesheet" href="../../public/css/sidemenu.css">
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="https://brademar.com/wp-content/uploads/2022/09/Ananas-Logo-PNG-1.png">
</head>
<body>


<?php
    $sqlShowProducts = "SELECT product.product_id, name, price, price_sale, size, quantity FROM product, product_instock WHERE product.product_id = product_instock.product_id GROUP BY product.product_id";
    $products = $conn->query($sqlShowProducts);
?>
<div class="wrapper">
<?php
    require '../includes/sidemenu.php';
?>
<div class="main container-fluid py-5" >
    <div class="row mb-2 text-center">
        <div class="h3 text-primary">Danh sách sản phẩm</div>
	</div>
    <?php 
        if (isset($_COOKIE['thongBao'])) {
            echo '<div class="row mb-2 text-center"><div class="alert alert-success">'.$_COOKIE['thongBao'].'</div></div>';
        }
    ?>
	<a href="./add.php" class="btn btn-success mb-3"> 
        <i class="fas fa-plus fa-lg me-3 fa-fw"></i>
		<span>Thêm sản phẩm</span>
	</a>
    <div class="row">
        <div class="col-12">
            <div class="mb-5">  
                <div class="row">
                    <?php
                    if ($products->num_rows>0) {
                        $totalProducts = $products->num_rows;
                        $currentPage = 1;
                        if (isset($_GET['page'])) {
                            settype($_GET['page'], 'int'); // tránh injection, trang tự về 0
                            $currentPage = $_GET['page'];
                        }
                        $limit = 6;
                        $totalPage = ceil($totalProducts/$limit);

                        // giới hạn phân trang trong 1-totalPage
                        if($currentPage > $totalPage) {
                            $currentPage = $totalPage;
                        } elseif ($currentPage < 1) { 
                            $currentPage = 1;
                        }

                        $start = ($currentPage - 1)*$limit;
                        $sqlShowProducts = $sqlShowProducts." LIMIT $start, $limit";
                        $products = $conn->query($sqlShowProducts); 
                    ?>
                    <div class="col-12 mb-3">
                    <table class="table">
    <thead class="table-primary">
        <tr>
            <th scope="col">id</th>
            <th scope="col">Tên sản phẩm</th>
            <th scope="col">Giá</th>
            <th scope="col">Giá giảm</th>
            <th scope="col">Kích thước</th>
            <th scope="col">Hàng tồn</th>
            <th scope="col">Thao tác</th>
        </tr>
    </thead>
    <tbody>
    <?php
        while ($row = $products->fetch_assoc()) {
            echo '<tr><th scope="row">' . $row['product_id'] . '</th>';
            echo '<td>' . $row['name'] . '</td>';
            echo '<td>' . $row['price'] . '</td>';
            echo '<td>' . $row['price_sale'] . '</td>';
            echo '<td><select class="w-100 p-2" id="size-' . $row['product_id'] . '" onchange="updateQuantity(' . $row['product_id'] . ', this.value)">';
            $sizes = [];
            $quantities = [];
            $sqlShowSizes = "SELECT size, quantity FROM product_instock WHERE product_id = " . $row['product_id'];
            $sizesResult = $conn->query($sqlShowSizes);
            while ($sizeRow = $sizesResult->fetch_assoc()) {
                echo '<option value="' . $sizeRow['size'] . '">' . $sizeRow['size'] . '</option>';
                $sizes[] = $sizeRow['size'];
                $quantities[] = $sizeRow['quantity'];
            }
            echo '</select></td>';
            echo '<td id="quantity-' . $row['product_id'] . '">' . $quantities[0] . '</td>';
            echo '<td>
                <a href="./update.php?id=' . $row['product_id'] . '" class="btn btn-primary"><i class="fa-solid fa-pencil"></i></a>
                <a href="#" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="' . $row['product_id'] . '"><i class="fa-solid fa-trash-can"></i></a>
                <div class="modal" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to delete this product?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                            <a href="#" id="confirmDelete" class="btn btn-primary">Yes</a>
                        </div>
                    </div>
                </div>
            </div>
            </td></tr>';
        }
    ?>
    </tbody>
</table>


                    </div>
                    <?php         
                    } else {
                        echo '<div class="alert alert-warning" role="alert"><i class="fa-light fa-circle-exclamation"></i> Không tìm thấy sản phẩm nào</div>';
                    }
            
                    $conn->close();
                    ?>
                </div>
                <?php 
                    if($products->num_rows > 0) {
                ?>
                <div class="row">
                    <!-- Phân trang -->
                    <nav class="mt-3">
                        <ul class="pagination pagination-lg d-flex justify-content-center">
                        <?php 
                            if ($currentPage > 1 && $totalPage >1) {
                        ?>
                            <li class="page-item">
                                <a href="<?php echo $rootPath?>/products/index.php?page=<?php echo ($currentPage - 1); ?>" class="page-link rounded-0 mr-3 shadow-sm border-top-0 border-left-0 text-dark" data-remote="true">&lsaquo; Prev</a>
                            </li>
                        <?php
                            }
                        ?>

                        <?php
                            for ($i=1; $i <= $totalPage; $i++) { 
                                if ($i == $currentPage) {
                        ?>
                            <li class="page-item active">
                                <span rel="prev" class="page-link rounded-0 mr-3 shadow-sm border-top-0 border-left-0 text-dark" data-remote="true"><?php echo $i ?></span>
                            </li>
                        <?php
                                }  else {
                        ?>
                            <li class="page-item">
                                <a data-remote="true" class="page-link rounded-0 mr-3 shadow-sm border-top-0 border-left-0 text-dark" href="<?php echo $rootPath ?>/products/index.php?page=<?php echo $i ?>"><?php echo $i ?></a>
                            </li>
                        <?php
                                } 
                            }
                        ?>
                        <?php
                            if ($currentPage < $totalPage && $totalPage > 1) {
                        ?>
                            <li class="page-item">
                                <a href="<?php echo $rootPath;?>/products/index.php?page=<?php echo ($currentPage + 1) ?>" class="page-link rounded-0 mr-3 shadow-sm border-top-0 border-left-0 text-dark" data-remote="true">Next &rsaquo;</a>
                            </li>
                        <?php
                            }
                        ?>
                        </ul>
                    </nav>
                </div>
                <?php
                    }
                ?>
            </div>
        </div>
    </div>
</div>
</div>


<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
<script src="../../public/javascripts/sidemenu.js"></script>
<script>
    var sizes = <?php echo json_encode($sizes); ?>;
    var quantities = <?php echo json_encode($quantities); ?>;

    function updateQuantity(productId, size) {
        var index = sizes.indexOf(size);
        document.getElementById('quantity-' + productId).innerText = quantities[index];
    }

    const deleteButtons = document.querySelectorAll('.btn-danger');

deleteButtons.forEach((btn) => {
    btn.addEventListener('click', (e) => {
        const productId = e.target.parentElement.getAttribute('data-id');
        document.getElementById('confirmDelete').setAttribute('href', `./delete.php?id=${productId}`);
    });
});
</script>
</body>
</html>