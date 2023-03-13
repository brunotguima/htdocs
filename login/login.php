<?php include '../estrutural/backend.php'; ?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Login</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.js"></script>
  <style>
    .container {
      display: flex;
      flex-direction: column;
      justify-content: center;
    }

    .ui.raised.very.padded.text.container.segment {
      position: relative;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
    }
  </style>
</head>

<body>

  <?php include '../estrutural/navbar.php'; ?>

  <div class="container">
    <div class="ui centered stackable grid">
      <div class="six wide column">
        <div class="ui raised very padded text container segment">
          <h2 class="ui header">Login</h2>
          <?php if (isset($erro)) : ?>
            <div class="ui negative message">
              <i class="close icon"></i>
              <div class="header">
                Erro
              </div>
              <p><?= $erro ?></p>
            </div>
          <?php endif; ?>
          <form method="POST" action="<?= efetuaLogin(); ?>" class="ui form">
            <div class="field">
              <label for="email">E-mail</label>
              <input id="email" type="email" name="email" required>
            </div>
            <div class="field">
              <label for="senha">Senha</label>
              <input id="senha" type="password" name="senha" required>
            </div>
            <button class="ui primary button" type="submit" name="action">Entrar</button>
          </form>
        </div>
        <div class="ui centered stackable grid">
          <p>Não tem uma conta? <a href="cadastro.php">Cadastre-se</a>.</p>
        </div>
      </div>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.js"></script>
  <script>
    $('.message .close')
      .on('click', function() {
        $(this)
          .closest('.message')
          .transition('fade');
      });
  </script>
</body>

</html>