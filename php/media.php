<?php
session_start();
if (!isset($_SESSION["user"])) {
    header('Location: ../index.php');
}
include 'connection.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="./javascript/javascript.js"></script>
    <link rel="stylesheet" href="../css/test.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <title>Media</title>
</head>
<body>
<?php
  if ($_SESSION['user'] == "admin@fje.edu") {
    ?>
    <div class="login-card center-mostrar">
        <div class="row custom-form-container container">
            <div class="responsive-img-center">
            <form action="./mostrar.php" method='post' style="text-align: right;">
            <button type="submit" name="Media" value="Media">Volver</button>
            </form>
            </div>
        </div>
    </div>
<?php
  }
?>
</body>
</html>