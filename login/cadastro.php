<?php include '../estrutural/backend.php'; ?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Cadastro de Usuário</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css">
</head>

<body>
  <?php include '../estrutural/navbar.php'; ?>
  <div class="ui centered aligned grid">
    <div class="six wide column">
      <div class="ui card fluid">
        <div class="content">
          <div class="header">Cadastro de Usuário</div>
        </div>
        <div class="content">
          <?php
          if (isset($erroCadastro)) {
            echo '<div class="ui negative message">' . $erroCadastro . '</div>';
          }
          ?>
          <form method="POST" class="ui form">
            <div class="field">
              <label for="nome">Nome:</label>
              <input type="text" name="nome" placeholder="Digite apenas letras e espaços" required>
            </div>
            <div class="field">
              <label for="username">Username:</label>
              <input type="text" name="username" pattern="[a-zA-Z0-9]+" placeholder="Digite apenas letras e números" required>
            </div>
            <div class="field">
              <label for="email">E-mail:</label>
              <input type="email" name="email" placeholder="seu_email@sulamericanapapel.com.br" required>
            </div>
            <div class="field">
              <label for="senha">Senha:</label>
              <input type="password" name="senha" placeholder="********" required>
            </div>
            <button class="ui primary button" type="submit">Cadastrar</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.js"></script>
</body>

</html>
<?php
cadastrar_usuario();
?>