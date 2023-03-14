<!-- index.php -->
<?php include 'estrutural/backend.php'; ?>

<!DOCTYPE html>
<html lang="PT-Br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>INTRANET SULAMERICANA</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.js"></script>
</head>

<body>
  <?php include 'estrutural/navbar.php'; ?>

  <div class="ui container">
    <h1 class="ui header">Informativos</h1>

    <!-- Exemplo de informativo estático -->
    <div class="ui items">
      <div class="item">
        <div class="image">
          <img src="https://via.placeholder.com/150x150.png" alt="Imagem do Informativo">
        </div>
        <div class="content">
          <h2 class="header">Informativo Exemplo</h2>
          <div class="description">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla imperdiet semper nibh, quis vehicula lorem
            laoreet id. Sed elementum bibendum felis, ac efficitur nulla malesuada ut.
          </div>
        </div>
      </div>
    </div>


    <?php
    $informativos = index();
    if (!empty($informativos['imagem']) || !empty($informativos['titulo']) || !empty($informativos['descricao'])) {
      foreach ($informativos as $informativo) { ?>
        <div class="ui items">
          <div class="item">
            <div class="image">
              <img src="<?php echo $informativo['imagem']; ?>" alt="Imagem do Informativo">
            </div>
            <div class="content">
              <h2 class="header">
                <?php echo $informativo['titulo']; ?>
              </h2>
              <div class="description">
                <?php echo $informativo['descricao']; ?>
              </div>
            </div>
          </div>
        </div>
        <?php
      }
    }
    ?>

  </div>
</body>

</html>