<?php
  session_start();
  ob_start();
  $rootPath = '/Lap_trinh_web/admin';
  if (!isset($_SESSION["email_ad"])) {
      header('location: ../login.php');
  }

  require_once '../../database/DB.php';

  $sqlShowPost = "SELECT * FROM post";
  $posts = $conn->query($sqlShowPost);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post</title>
    <link rel="stylesheet"  href="https://site-assets.fontawesome.com/releases/v6.1.2/css/all.css">
    <!-- CSS only -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="../includes/css/base.css">
    <link rel="stylesheet" href="../includes/css/home.css"> -->
</head>
<body>
<?php
    require '../includes/header.php';
    require '../includes/navbar.php';
?>


<div class="container-fluid mt-5 mb-3">
  <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add">Add post</button>
  <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="add" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title">Thêm bài viết</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form action="./add.php" method="post">
              <div class="modal-body">
                  <div class="form-group">
                      <label>Tiêu đề bài viết</label>
                      <input class="form-control my-2" type="text" placeholder="Tiêu đề bài viết" name="title" />
                  </div>
                  <div class="form-group">
                      <label>Hình ảnh</label>
                      <input class="form-control my-2" type="text" placeholder="Hình ảnh" name="image" />
                  </div>
                  <div class="form-group">
                      <label>Nội dung</label>
                      <textarea class="form-control my-2" placeholder="Nội dung" name="content" style="height: 200px"></textarea>
                  </div>
              </div>
              <div class="modal-footer">
                  <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Đóng lại</button>
                  <button class="btn btn-primary" type="submit">Thêm</button>
              </div>
          </form>
      </div>
    </div>
  </div>
</div>
<div class="container-fluid">
    <table class="table table-striped">
      <thead>
        <tr class="table-primary text-center">
          <th scope="col">STT</th>
          <th scope="col">Tiêu đề</th>
          <th scope="col">Nội dung</th>
          <th scope="col">Hình ảnh</th>
          <th scope="col">Ngày cập nhật</th>
          <th scope="col"></th>
        </tr>
      </thead>
      <?php
        if ($posts->num_rows>0) {
          $count = 1;
          while ($row = $posts->fetch_assoc()) {
      ?>
      <tbody>
        <tr>
          <th class='align-middle' scope="row"><?php echo $count?></th>
          <td class='align-middle'><?php echo $row["title"]?></td>
          <td class='align-middle'><?php echo $row["content"]?></td>
          <td class='align-middle'><?php echo $row["image"]?></td>
          <td class='align-middle'><?php echo $row["updated_at"]?></td>
          <td class='align-middle'>    
            <div class="d-inline-flex">
            <!-- <a class="text-decoration-none btn btn-success text-light"><i class="fa-light fa-pen-to-square"></i></a>
            <a class="text-decoration-none btn btn-danger text-light"><i class="fa-light fa-trash-can"></i></a> -->
            <button type='button' class='btn-edit btn btn-primary m-1' data-bs-id='<?php echo $row['post_id'] ?>' data-bs-title='<?php echo $row['title'] ?>' data-bs-content='<?php echo $row['content'] ?>' data-bs-image='<?php echo $row['image'] ?>' data-bs-target='#Edit' data-bs-toggle='modal'><i class="fa-light fa-pen-to-square"></i></button>
            <button type='button' class='btn-delete btn btn-danger m-1' data-bs-id='<?php echo $row['post_id'] ?>' data-bs-target='#Delete' data-bs-toggle='modal'><i class="fa-light fa-trash-can"></i></button>
            </div>
          </td>
        </tr>
      </tbody>
      <?php
              $count++;
          };
        }
      ?>
    </table>
    <div class="modal fade" id="Edit" tabindex="-1" role="dialog" aria-labelledby="Edit" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Chỉnh sửa bài viết</h5>
                </div>
                <form action="update.php" method="post">
                    <div class="modal-body">
                        <input type="hidden" name="id" />
                        <div class="form-group">
                            <label>Tiêu đề bài viết</label>
                            <input class="form-control my-2" type="text" placeholder="Tiêu đề bài viết" name="title"/>
                        </div>
                        <div class="form-group">
                            <label>Hình ảnh</label>
                            <input class="form-control my-2" type="text" placeholder="Hình ảnh" name="image"/>
                        </div>
                        <div class="form-group">
                            <label>Nội dung</label>
                            <textarea class="form-control my-2" placeholder="Nội dung" name="content" style="height: 200px"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Đóng lại</button>
                        <button class="btn btn-primary" type="submit">Cập nhật</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="Delete" tabindex="-1" role="dialog" aria-labelledby="Delete" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title">Xoá bài viết</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <form action="delete.php" method="post">
                  <div class="modal-body">
                      <input type="hidden" name="id" />
                      <p>Bạn chắc chắn muốn xoá?</p>
                  </div>
                  <div class="modal-footer">
                      <button class="btn btn-primary btn-outline-light" type="button" data-bs-dismiss="modal">Đóng lại</button>
                      <button class="btn btn-danger btn-outline-light" type="submit">Xác nhận</button>
                  </div>
              </form>
          </div>
        </div>
    </div>

</div>

<?php
    require '../includes/footer.php';
?>
<script>
  $(".btn-edit").click(function (e) {
    const id = this.getAttribute('data-bs-id')
    $("#Edit input[name='id']").val(id);
    const title = this.getAttribute('data-bs-title')
    $("#Edit input[name='title']").val(title);
    const content = this.getAttribute('data-bs-content')
    $("#Edit textarea[name='content']").val(content);
    const image = this.getAttribute('data-bs-image')
    $("#Edit input[name='image']").val(image);
    $('#Edit').modal('show');
});

$(".btn-delete").click(function (e) {
    const id = this.getAttribute('data-bs-id')
    $("#Delete input[name='id']").val(id);
    $('#Delete').modal('show');
});
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>