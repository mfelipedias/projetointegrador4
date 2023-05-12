<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bootstrap demo</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>

<body>
  <div class="card" style="width: 540px; margin-top: 10px;">
    <h6 class="card-header">Dados</h6>
    <div class="card-body">
      <?php
      include 'db.php';
      $sql = "SELECT * FROM `dados_sensor` ORDER BY registro DESC";

      $busca = mysqli_query($db, $sql);
      while ($array = mysqli_fetch_array($busca)) {
        $ph = $array['ph'];
        $temperatura = $array['temperatura'];
        $registro = $array['registro'];
      }
      ?>
      pH: <b>
        <?php echo $ph; ?>
      </b> / Temperatura: <b>
        <?php echo $temperatura; ?> / Registro:
        <?php echo $registro; ?>
      </b>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
    crossorigin="anonymous"></script>
</body>

</html>