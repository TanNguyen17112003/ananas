<?php
  session_start();
  ob_start();
  $rootPath = '/AssignmentWeb/admin';
  if (!isset($_SESSION["email_ad"])) {
      header('location: ../login.php');
  }

  require_once '../../db/DB.php';

  $sqlShowUser = "SELECT * FROM user";
  $users = $conn->query($sqlShowUser);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User</title>
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

<div class="container-fluid my-5">
    <table class="table table-striped">
      <thead>
        <tr class="table-primary text-center">
          <th scope="col">STT</th>
          <th scope="col">Username</th>
          <th scope="col">Email</th>
          <th scope="col">SĐT</th>
          <th scope="col">Địa chỉ</th>
          <th scope="col">Ngày cập nhật</th>
          <th scope="col"></th>
        </tr>
      </thead>
      <?php
        if ($users->num_rows>0) {
          $count = 1;
          while ($row = $users->fetch_assoc()) {
      ?>
      <tbody>
        <tr>
          <th class='align-middle text-center' scope="row"><?php echo $count?></th>
          <td class='align-middle text-center'><?php echo $row["name"]?></td>
          <td class='align-middle'><?php echo $row["email"]?></td>
          <td class='align-middle text-center'><?php echo $row["phone"]?></td>
          <td class='align-middle'><?php echo $row["address"]?></td>
          <td class='align-middle text-center'><?php echo $row["updated_at"]?></td>
          <td class='align-middle'>    
            <div class="d-inline-flex">
            <!-- <a class="text-decoration-none btn btn-success text-light"><i class="fa-light fa-pen-to-square"></i></a>
            <a class="text-decoration-none btn btn-danger text-light"><i class="fa-light fa-trash-can"></i></a> -->
            <button type='button' class='btn-delete btn btn-danger m-1' data-bs-id='<?php echo $row['user_id'] ?>' data-bs-target='#Delete' data-bs-toggle='modal'><i class="fa-light fa-trash-can"></i></button>
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
    <div class="modal fade" id="Delete" tabindex="-1" role="dialog" aria-labelledby="Delete" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title">Xoá người dùng</h5>
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
$(".btn-delete").click(function (e) {
    const id = this.getAttribute('data-bs-id')
    $("#Delete input[name='id']").val(id);
    $('#Delete').modal('show');
});
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>