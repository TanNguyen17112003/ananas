<?php
  session_start();
  ob_start();
  $rootPath = '/Lap_trinh_web/admin';
  if (!isset($_SESSION["email_ad"])) {
      header('location: ../login.php');
  }

  require_once '../../database/DB.php';

  $sqlShowContact = "SELECT * FROM contact";
  $contacts = $conn->query($sqlShowContact);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liên hệ</title>
    <link rel="stylesheet"  href="https://site-assets.fontawesome.com/releases/v6.1.2/css/all.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>
<body>
<?php
    require '../includes/header.php';
    require '../includes/navbar.php';
?>

<div class="container-fluid">
    <table class="table table-striped">
      <thead>
        <tr class="table-primary text-center">
          <th scope="col">STT</th>
          <th scope="col">Người gửi</th>
          <th scope="col">Email</th>
          <th scope="col">Tin nhắn</th>
          <th scope="col">Ngày gửi</th>
          <th scope="col">Trạng thái</th>
          <th scope="col"></th>
        </tr>
      </thead>
      <?php
        if ($contacts->num_rows>0) {
          $count = 1;
          while ($row = $contacts->fetch_assoc()) {
      ?>
      <tbody>
        <tr>
          <th class='align-middle' scope="row"><?php echo $count?></th>
          <td class='align-middle'><?php echo $row["username"]?></td>
          <td class='align-middle' id="test"><?php echo $row["email"]?></td>
          <td class='align-middle'><?php echo $row["message"]?></td>
          <td class='align-middle'><?php echo $row["created_at"]?></td>
          <td class='align-middle'>
            <?php
                if ($row["status"] == 0) {
                  echo "Chưa phản hồi";
                } else {
                  echo "Đã phản hồi";
                }
            ?>
         </td>
          <td class='align-middle'>
            <?php
            if ($row["status"] == 0) 
              echo "<button type='button' class='btn btn-primary m-1' onclick='sendMail(); return false'><i class='fa-regular fa-envelope'></i></button>";
            ?>    
          </td>
        </tr>
      </tbody>
      <?php
              $count++;
          };
        }
      ?>
    </table>
</div>

<?php
    require '../includes/footer.php';
?>

<script>
    function sendMail(email) {
    var link = "mailto:me@example.com"
             + "?cc=myCCaddress@example.com"
             + "&subject=" + encodeURIComponent("")
             + "&body=" + encodeURIComponent()
    ;
    window.location.href = link;
}
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>