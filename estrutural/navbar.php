<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Descrição da página aqui">
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
  <style>
    .logo {
      max-width: 200px;
    }

    .custom-nav {
      background-color: #0B3B2E;
    }
  </style>
</head>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Login</title>

</head>

<body>
  <div class="ui inverted menu custom-nav">
    <a href="#" class="item">
      <img src="../imagens/Logo_Sulamericana_Sem_Fundo.png" alt="Logo" class="ui logo">
    </a>
    <a href="/" class="item" data-inverted="" data-tooltip="Página Inicial" data-position="bottom center"><i class="home icon"></i></a>

    <div class="ui dropdown item" data-inverted="" data-tooltip="Informativos" data-position="bottom center">
      <i class="newspaper outline icon"></i>
      <div class="menu">
        <a href="../informativos/cad_informativos.php" class="item" data-inverted="" data-tooltip="Cadastro de Informativos" data-position="bottom center"><i class="edit outline icon"></i>Cadastro de Informativos</a>
        <a href="#" class="item" data-inverted="" data-tooltip="Listar todos os informativos" data-position="bottom center"><i class="list icon"></i>Listar todos os informativos</a>
      </div>
    </div>

    <div class="ui dropdown item" data-inverted="" data-tooltip="Documentos" data-position="bottom center">
      <i class="file alternate outline icon"></i>
      <div class="menu">
        <a href="../aprov_docs/upload.php" class="item" data-inverted="" data-tooltip="Enviar Documento" data-position="bottom center"><i class="upload icon"></i>Enviar Documento</a>
        <a href="../aprov_docs/geral.php" class="item" data-inverted="" data-tooltip="Visualizar Documentos" data-position="bottom center"><i class="check icon"></i>Visualizar Documentos</a>
      </div>
    </div>

    <?php
    // Verifica se o usuário está logado
    $is_logged_in = verifica_login();
    if (isset($is_logged_in['usuario_nome'])) {
      echo '<a class="right item">' . $is_logged_in['usuario_nome'] . '</a>';
    }
    
    ?>

    <!-- Adiciona o atributo rel="noopener" para evitar ataques de phishing -->
    <a href="<?= $is_logged_in['url'] ?>" class="right item" rel="noopener"><?= $is_logged_in['text'] ?></a>
  </div>

  <div class="ui sidebar vertical menu" id="mobile-nav">
    <a href="/" class="item" data-inverted="" data-tooltip="Página Inicial" data-position="bottom center"><i class="home icon"></i>Página Inicial</a>

    <div class="ui dropdown item" data-inverted="" data-tooltip="Documentos" data-position="bottom center">
      <i class="file alternate outline icon"></i>
      <div class="menu">
        <a href="../aprov_docs/upload.php" class="item" data-inverted="" data-tooltip="Enviar Documento" data-position="bottom center"><i class="upload icon"></i>Enviar Documento</a>
        <a href="../aprov_docs/aprovar.php" class="item" data-inverted="" data-tooltip="Aprovar Documentos" data-position="bottom center"><i class="check icon"></i>Aprovar Documentos</a>
      </div>
    </div>
    <?php if ($is_logged_in) : ?>
      <a class="item">Olá, <?= $is_logged_in['usuario_nome'] ?>!</a>
    <?php endif; ?>

    <!-- Adiciona o atributo rel="noopener" para evitar ataques de phishing -->
    <a href="<?= $is_logged_in['url'] ?>" class="item" rel="noopener"><?= $is_logged_in['text'] ?></a>
  </div>
  <script>
    // Inicializa o menu dropdown
    $('.ui.dropdown').dropdown();
  </script>
</body>

</html>