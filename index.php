<?php
session_start();
ob_start();
$rootPath = '/Lap_trinh_web';
require_once './database/DB.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ananas</title>
    <link rel="icon" type="image/x-icon" href="https://brademar.com/wp-content/uploads/2022/09/Ananas-Logo-PNG-1.png">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.1.2/css/all.css">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="./public/css/base.css">
    <!-- <link rel="stylesheet" href="./public/css/home.css"> -->
    <style>
        p {
            text-align: justify;
        }
        .card-info:hover {
            border-color: aqua !important;
        }
    </style>
</head>

<body>
    <?php
        require './includes/header.php';
        require './includes/navbar.php';
        $newArrivalQueryString = "SELECT * FROM product WHERE status = 'New Arrival'";
        $newArrivalProducts = mysqli_query($conn,$newArrivalQueryString);
    ?>

    <div id="template-mo-zay-hero-carousel" class="carousel carousel-dark slide mb-5" data-bs-ride="carousel">
        <ol class="carousel-indicators">
            <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="0" class="active"></li>
            <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="1"></li>
            <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="2"></li>
        </ol>
        <div class="carousel-inner ">
            <div class="carousel-item active" data-bs-interval="3000"> 
                    <img class="d-block mx-auto img-fluid" src="https://ananas.vn/wp-content/uploads/Hi-im-Mule_1920x1050-Desktop.jpg" alt="First slide" />
            </div>
            <div class="carousel-item" data-bs-interval="3000">
                <img class="d-block mx-auto img-fluid" src="https://ananas.vn/wp-content/uploads/Web1920-1.jpeg" alt="First slide" />
            </div>
            <div class="carousel-item" data-bs-interval="3000">          
                <img class="d-block mx-auto img-fluid" src="https://ananas.vn/wp-content/uploads/kv_basas_mobileBanner_4_2019.jpg" alt="First slide" />

            </div>
        </div>
    </div>

    <div class="container-fluid pt-5 pb-5">
        <!-- team member -->
        <div class="container mb-5">
            <div class="row text-center mb-2">
                <div class="h2" style="color:#ED171F">TEAM MEMBERS</div>
            </div>
            <div class="row">
                <div class="col-xl-3 col-md-6 col-sm-12 shadow-sm">
                    <div class="text-center card border border-2  card-info">
                        <a href="https://www.facebook.com/nguyenducbinh2003/"><img alt="AVT" width="200" height="200" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAOsAAADXCAMAAADMbFYxAAAAh1BMVEX///8AAAD5+fn8/Pzw8PDs7OzBwcHS0tLMzMzf39/Hx8e1tbX09PT6+vro6Ojl5eVZWVkoKCiUlJSenp56enrY2NilpaVvb2+Hh4dHR0cdHR1WVlasrKxhYWE+Pj50dHQWFhYsLCxnZ2eNjY1BQUFNTU0pKSk2NjYfHx+IiIgODg5/f3+6urpooj6hAAAKvUlEQVR4nOWd2WLyKhCAk7pVa923Vm21arXq+z/fiUIia0JgCON/vlsVmUCG2YAoqoru6+qyHp7j+Hzaz3fNRmV/XDEvncVXLLC9tEJ3ywPNtSgn5bQK3TVY6iONoIRx6P7B0ZjkSppwvobuIwz1QklvHP4FNZU/exmefmjfTCVNuITurBO9QwlRk3lcC91he8alJE34fQndZUsaH2VFjeNNPXSvrbiWlzThsxu63xbMrUSN4+HTvbO9oaWocfwRuu8laVpLmjAP3ftSlNa/PLt2/T20CKYY2YQFHCfXZ1h/lgCi3hk0Q4tSQPcIJWrCeRZanDx6gJLe2HRCS6RlCixqjFctt+BFTUypdmixVHR8iJqAUEf5EjWO0UXfXr2Jii745lPUOH4LLR6LBw3MMQ0t4APfosYxGscW2oRQgMXX6/oXFYt+erH3zMuAIlouZd/8sAwtZ4IuAQdOeD/gUpWo8TG0qKvKRA1uGPs1lwTCDmyjSlHDWk/vn9XKGtJxr/JlvRM0uHitdmQD+zsQ4WBj1mFljWZVChtYVtecRileQwtrm4C0YBRa1ugMJkuRyxTejXVKQrIson5BPUloUaMIKItzfxvzF+1+aFFL1TFp+aGWQm5VSfjA+Iu7pGfGPc1ZsxGEYpxVMZ9+1C9ji0ACMjhqp7FYNaA1UEJbTpHbJD6q8jW6ms3wi04UbS0F3Sw0TulA/f2vasVSYuUCrGd67/td/ZNthTLpKOfKng6XWadgqVTnODdVCFOAaeBp+T1rts2SM8pg7KdnOUyoF4s5vFxLxe77ykZ8CVCCIkW8HZWve1ANbPAg8Y1tnqRrK79TVWuCYc2JcozYec+yzV/FUwPttCXatM7RPqqrMCj+ALtsjW6BdQn9teXmUNTEqI26pVvuX24QxV5DpWviGh76kVpEsftBJauzYy25OxhMCaUX5j7fJGtsAtBTd2SDGCCWK1lj4UMwN6SQE0i0RGwUR2W8uPloANLq1kejzohRGBiFKeweQLJxVHA3gWJggjWGZFeWoDKB1kE+PrmDadQZXlaoF4u3PFEYEpHogEElwBdso2h2PvN2uq0XJ/LHNoqmrpaPmEC1yo4rgvQGhashBquTZN7XX6g23eHKusDeLEYPI9qnwxVMg0UPHusrCic9hZUVbCHM7CZce802PmRNE/YowocMjB4By5LS9r6QGIeE3uT39JD1G6jVGsZRFTw6qMwhWbRRxIQzpAg9ULvEyJ51xvPJOHjJGmUjygpkI3KBnc/wmxsiVawJqFt/fKsYrES6Q4cp1QPyc8TESfiRJSbTphFF9SvtHZBLIhY6nmCadaDPTrCXt0O8B9qEUJPejeB7Q9uQ05aDCHhc9dJ8UfA3lux+9RGmvicTSPCQJO6Dhyam/vRG53uXvvr3dzd4joNYEp7XepLuCF6OWIms5E+CnxBTiawk8hQ81UzeV8/5B7LU+v0PA7j11RNk7oSPTrxXsBx8V/GemHCfX34rymIcUzgt4fAZlm/iWHGitFbCZ37/B4c1HKUGscekN/Wk/P1BCYaeHzspxgi/me4GcUI8aKc+eX4kJI4jy0Frcwb1KGo0AZ2AQTJxm+kUxrCt4caO+tJftyAxWOSaTJfh4YjDFk7hIolQKQ5+3wqWCgI+rQ6lkbnKkPD2YQZ7NNcBqE2uMgTNsCbUHwFOqBQ4M67YjoTsz+brLaTdSp7e+uvwgyrTnDKDXAn3nlZtIEipHswwkPDwD0hbPiAlIjBZxD4iy1AJeWFB6nxJSgxHebQSYkGBJAE+0K01AlMw25VUh+0BWvIGmcQAwc0JLitYxQrIdKKFcGgKLlXQRKLzwBKjCaqixhMwjjstN0FmGkrEEC/a5zMMa1Yq4vSmXfA5N2q2zsZdC2RuVAHtqX3gie5+R722phAdurGOO9FS2vCHNRlAx8V2Fi+eZgbfoDsJ7cxi+mMMhysbMbCfhXRX0xm1xcRCZ/GmvHOXBumwWxEMdN9k6TLnNPiKZEukGQurty7dbollm6Ah9CSRUoHxdBdt8JqtkqTH4ZQY2XSDP66qdxPSbWdfpho1i/OHrxMuTZbkMcpC9x+nZ6J3bxRknTcwgbgDKvx3DRpme8ehwKpo8TddPN8k5vJsi5y3dvrItBLtjTfYr0EsYd9pPO8mcw5vk/7oaQxECtmMtWdO7FrLQfzWjknJ7xupPxe82L0ke6qWuA32y3Gn0b07tt1ec8xvSrlrMGJOnMN2vSzUiE8m7lQ8Gvs8PB6lmwHm9ERBMs4oM65ayGQkS2XxwfiDzK+h3w3WbwvosFIzopZ/Mv6c8eCodkKci5QgKumR66itdKeKf455BU0fC9QZFf6hgRQu1dFbyScLHsaSU04HFkudWiH0pZMculpr9k0XoeFgMmsp4xb0OWEoFy6mkVoHllFP+vMDinva8snOSrSNLmTnrO1wHDqmo/ZYX+xP+Huc3rbAO7YN9vxLh+Jpxm2wO+TWO01Oz7qskNyRK587ZAHUl6Z4oYG6MrQxWm4f5v75cFFm4MUt8CeLs5o90Z+pzqhX+XAK++lD8T3FccbDSTO4p9defSvkvKFwzP6UX5RkUJ4VnnDcdcQrHqqi0RktNb26I/1AcwW7FFbVXdtw42PXrFg311/H68IL2yTXXHMbg5S8KWp4OFlV8/7WO2P5YGAl0njpvijMds3wC+wX157HA4AanfHgVNyLDMFX0d52LASEdQpA5rwcv8IXkNRapqPJIB5GZiZr2VtbzpM3uBlda40K7tzSITSku6eMn8PimbdGDMYAe9zqCq/TGCGNutN8jbcncnV7HoeRi7yN2d72j+8IZTuaC2OPJl8y5PJqp6+u1k84Q3iR1Asnn9JwvrRxUrrwsyAcZvq/QquqW8AEJ6GMotcwLBdyhbrIVvS2ZSUnxFqmikYsMJd2uoX5R8V/igpATLZC3WK+NdRTOn1pgbThrLblPhfDb/KhTdaYONDdr+J2zJEeL3dqv3TREdhFnAmHQqdIcb2JC5LLzksjhhp17oEV54JAJpBueCB6p7wfLmgmrclsSa7xCC6q6MSIf8Av/eDXP+cIq4sIOCCcfieusHzdCNBVsgx6N0g6whIALugp3SfCaSdgXXFDu6PEwczXwy0rspXIWogLxc9d0ex0B7mgV4aND8mfDnI/BUC51RJaCaYwi7rqaT4WBvUlks6oPB9fN6UzlR4qM+VxzFX5yIcRinO0PCgGSjaL1FGz1LzxNa8UuVEviulOVh6uHrh02YHyrSSkOjh/w5o9WE3IIV128m4bd0MsvjCPVJaHWoLqFEe67HiwY1KENxbgkvQciCrUfUrKZfIyGzD/nwJuiXK85b+P/bwnAfb/GaBOq8S9gmer/fgWljK9B9kKblN5r/j7TrTzhXnxt7oTWBfA7xS+h5XyIrBjz/qCi3v50/eUWu7MOfmyxVMYq9vzU014y/dhXt3j7vk8ZIUMaanZ5rvGflVjzOaMfDiOuHg4W/CxD2xkq443DwMRqenkdR1HQhpRBMnJISc1Ez0FBFCR+jq6QoZ/iUNVlgQGiKxmxVPPDgmOeAv0oIJEP6By2bghlpNbYc+zQJIdoXtRDcMqYhJYqP1PLMQb7QriL1i4VUf6jWrhYeQ9XIqHAWj5FG6GfpNWuOja1WE/JS3I6kPkzDzmmLEx/w/4yJpEbE5wVwAAAABJRU5ErkJggg==" class="rounded-circle mb-3 mt-3" /></a>
                        <p class="text-dark" style="text-align: center; font-weight: bold;">Nguyễn Hoàng Duy Tân</p>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 col-sm-12 shadow-sm">
                    <div class="text-center card border border-2  card-info">
                        <a href="https://www.facebook.com/profile.php?id=100008620419001"><img alt="AVT" width="200" height="200" src="./assets/tue_avt.jpg" class="rounded-circle mb-3 mt-3" /></a>
                        <p class="text-dark" style="text-align: center; font-weight: bold;">Trần Nguyễn Minh Tuệ</p>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 col-sm-12 shadow-sm">
                    <div class="text-center card border border-2  card-info">
                        <a href="https://www.facebook.com/minhloc1605"><img alt="AVT" width="200" height="200" src="./assets/loc_avt.jpg" class=" rounded-circle mb-3 mt-3" /></a>
                        <p class="text-dark" style="text-align: center; font-weight: bold;">Nguyễn Minh Lộc</p>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 col-sm-12 shadow-sm">
                    <div class="text-center card border border-2 card-info">
                        <a href="https://www.facebook.com/huytran613"><img alt="AVT" width="200" height="200" src="./assets/huy_avt.jpg" class="rounded-circle mb-3 mt-3" /></a>
                        <p class="text-dark" style="text-align: center; font-weight: bold;">Trần Đan Huy</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- best seller -->
    </div>

    <div>
        <h3 class="text-danger text-uppercase text-center">sản phẩm mới của chúng tôi</h3>
        <div class="row container-fluid">
            <?php
                while ($newArrivalProductRow = $newArrivalProducts->fetch_assoc()) {
            ?>
                <div class="col-lg-3 col-sm-6 mb-3">
                                    <a href="<?php echo $rootPath ?>/product_detail.php?productId=<?php echo $newArrivalProductRow['product_id']?>" class="text-black text-decoration-none">
                                        <div class="card h-100 position-relative">
            
                                            <img src="<?php echo $rootPath ?>/public/img/<?php echo $newArrivalProductRow['images']; ?>" class="img-fluid" alt="..." onmouseover="this.src='<?php echo $rootPath ?>/public/img/<?php echo $newArrivalProductRow['subimg_1'];?>'" onmouseout="this.src='<?php echo $rootPath ?>/public/img/<?php echo $newArrivalProductRow['images'];?>'">
                                            <div class="btn btn-outline-danger position-absolute end-0 bottom-25"><i class=" fa-light fa-heart"></i> </div>
                                            <div class="card-body d-flex flex-column justify-content-between align-items-center">
                                                <div class="d-flex flex-column justify-content-start">
                                                    <h6 class="card-title" style="font-size: 0.75rem"><?php echo $newArrivalProductRow["name"]; ?></h6>
                                                </div>
                                                <div class="card-text">                      
                                                    <p>
                                                        <?php
                                                        // Nếu có giá Khuyến mãi
                                                        if ($newArrivalProductRow["price_sale"] != 0) {
                                                        ?>
                                                            <?php
                                                            echo '<del class="text-secondary">' . number_format($newArrivalProductRow["price"]) . '</del><sup>đ</sup>';
                                                            ?>

                                                            <?php
                                                            echo '<strong><span class="text-danger ms-3">' . number_format($newArrivalProductRow["price_sale"]) . '<sup>đ</sup></span></strong>';
                                                            ?>
                                                        <?php
                                                            // nếu không có khuyến mãi, hiện giá gốc
                                                        } else {
                                                            echo '<strong>' . number_format($newArrivalProductRow["price"]) . '<sup>đ</sup></strong>';
                                                        }
                                                        ?>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="card-footer d-flex flex-column">
                                                <!-- <a href="<?php echo $rootPath ?>/process_cart.php?action=add&id=<?php echo $row['product_id'] ?>&quantity=1" class="btn btn-warning mt-1 <?php if ($row["quantity"] == 0) echo 'disabled' ?>"><i class="fa-light fa-cart-plus"></i></a> -->
                                                <!-- <button onclick="addCartItem(<?= $row['product_id'] ?>)" class="btn btn-warning mt-1 <?php if ($row["quantity"] == 0) echo 'disabled' ?>"><i class="fa-light fa-cart-plus"></i></button> -->
                                            </div>
                                        </div>
                                    </a>
                                </div>
            <?php
                }
            ?>
        </div>
    </div>

   

    

    <?php
        require './includes/footer.php';
    ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <script src="./public/javascripts/loadCartHeader.js"></script>

    <script>
        $(document).ready(function() {
            loadCartAjax();

            $(window).scroll(function() {
                if ($(this).scrollTop() > 114) {
                    $("#navbar-top").addClass('fix-nav')
                } else {
                    $("#navbar-top").removeClass('fix-nav')
                }
            })
        });
    </script>
    <script src="./public/javascripts/liveSearch.js"></script>

</body>

</html>