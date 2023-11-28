<?php
session_start();
ob_start();
$rootPath = '/Lap_trinh_web/admin';
require_once '../../database/DB.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet"  href="https://site-assets.fontawesome.com/releases/v6.1.2/css/all.css">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="./public/css/base.css">
    <link rel="stylesheet" href="./public/css/product.css">
</head>
<body>
<?php
    require '../includes/header.php';
    require '../includes/navbar.php';
?>

<?php
    $sqlShowProducts = "SELECT product_id, name, price, price_sale, quantity FROM product";
    $products = $conn->query($sqlShowProducts);
?>
<div class="container-fluid mt-5 mb-5">
    <div class="row mb-2 text-center">
        <div class="h3 text-primary">Danh sách sản phẩm</div>
	</div>
    <?php 
        if (isset($_COOKIE['thongBao'])) {
            echo '<div class="row mb-2 text-center"><div class="alert alert-success">'.$_COOKIE['thongBao'].'</div></div>';
        }
    ?>
	<div class="row mb-2">
		<div class="col-xl-3 col-md-4 col-sm-12">
			<a href="./add.php" class="ms-5 btn btn-primary">Thêm sản phẩm</a>
		</div>
	</div>
    <div class="row">
        <div class="col-12">
            <div class="container mb-5">  
   
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
									<th scope="col">#id</th>
									<th scope="col">Tên sản phẩm</th>
									<th scope="col">Giá</th>
									<th scope="col">Giá giảm</th>
									<th scope="col">Hàng tồn</th>
									<th scope="col">Thao tác</th>
								</tr>
							</thead>
							<tbody>
							<?php
								while ($row = $products->fetch_assoc()) {
							?>
								<tr>
									<th scope="row"><?=$row['product_id']?></th>
									<td><?=$row['name']?></td>
									<td><?=$row['price']?></td>
									<td><?=$row['price_sale']?></td>
									<td><?=$row['quantity']?></td>
									<td>
										<a href="./update.php?id=<?=$row['product_id']?>" class="btn btn-primary"><i class="fa-solid fa-pencil"></i></a>
										<a href="./delete.php?id=<?=$row['product_id']?>" class="btn btn-danger"><i class="fa-solid fa-trash-can"></i></a>
									</td>
								</tr>
								<?php
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


<?php
    require '../includes/footer.php';
?>

<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>